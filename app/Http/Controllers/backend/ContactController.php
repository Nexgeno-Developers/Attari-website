<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;


class ContactController extends Controller
{
    private const ATTRIBUTION_BATCH_LIMIT = 100;
    /*public function index() {
        //$contact = Contact::orderBy('id', 'desc')->get();
        $contacts = Contact::orderBy('id', 'desc')->paginate(10);
        
        return view('backend.pages.contact.index', compact('contacts'));
    }*/ 
    
    private const PER_PAGE_OPTIONS = [10, 25, 50, 100, 250, 500, 1000];

    public function index(Request $request)
    {
        $filters = $this->validatedFilters($request);
        $perPage = $this->resolvePerPage($request->input('per_page'));

        $contacts = $this->buildFilteredQuery($filters)
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->appends($request->query());

        $uniqueCourses = Contact::query()
            ->select('services')
            ->whereNotNull('services')
            ->where('services', '!=', '')
            ->distinct()
            ->orderBy('services')
            ->pluck('services');

        $sources = Contact::query()
            ->select('source')
            ->whereNotNull('source')
            ->where('source', '!=', '')
            ->distinct()
            ->orderBy('source')
            ->pluck('source');

        $media = Contact::query()
            ->select('medium')
            ->whereNotNull('medium')
            ->where('medium', '!=', '')
            ->distinct()
            ->orderBy('medium')
            ->pluck('medium');

        return view('backend.pages.contact.index', compact(
            'contacts',
            'uniqueCourses',
            'sources',
            'media',
            'perPage'
        ));
    }

    public function export(Request $request): StreamedResponse
    {
        $filters = $this->validatedFilters($request);
        $fileName = 'contacts-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () use ($filters) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'Name',
                'Email',
                'Phone No',
                'Course',
                'Medium',
                'Source',
                'Page',
                'Referral URL',
                'source_url',
                'Section',
                'gad_campaignid',
                'gclid',
                'Country Code',
                'Country Phone',
                'Syllabus Status',
                'Email Status',
                'IP',
                'Date',
            ]);

            foreach ($this->buildFilteredQuery($filters)->orderByDesc('created_at')->cursor() as $contact) {
                fputcsv($handle, [
                    $contact->name,
                    $contact->email,
                    $contact->phone,
                    $contact->services,
                    $contact->medium,
                    $contact->source,
                    $contact->url,
                    $contact->ref_url,
                    $contact->source_url,
                    $contact->section,
                    $contact->gad_campaign_id,
                    $contact->gclid,
                    $contact->w_countrycode,
                    $contact->w_phone,
                    (string) $contact->w_syllabus === '1' ? 'SENT' : 'FAILED',
                    (int) $contact->email_sent === 1 ? 'SENT' : 'PENDING',
                    $contact->ip,
                    optional($contact->created_at)->format('d M Y h:iA'),
                ]);
            }

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
    

    public function view($id) {
        $contact = Contact::find($id);
        return view('backend.pages.contact.view', compact('contact'));
    }  
    
    public function delete($id) {
        
        $contact = Contact::find($id);
        if (!$contact) {
            $response = [
                'status' => false,
                'notification' => 'Record not found.!',
            ];
            return response()->json($response);
        }
        $contact->delete();

        $response = [
            'status' => true,
            'notification' => 'Contact Deleted successfully!',
        ];

        return response()->json($response);
    }

    public function rebuildSourceMedium(Request $request)
    {
        $validated = $request->validate([
            'after_id' => ['nullable', 'integer', 'min:0'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:' . self::ATTRIBUTION_BATCH_LIMIT],
            'auto_continue' => ['nullable', 'boolean'],
        ]);

        $afterId = (int) ($validated['after_id'] ?? 0);
        $limit = (int) ($validated['limit'] ?? self::ATTRIBUTION_BATCH_LIMIT);
        $autoContinue = (bool) ($validated['auto_continue'] ?? false);

        $contacts = Contact::query()
            ->select(['id', 'url', 'ref_url', 'source_url', 'source', 'medium'])
            ->where('id', '>', $afterId)
            ->orderBy('id')
            ->limit($limit)
            ->get();

        $processed = 0;
        $updated = 0;
        $lastProcessedId = $afterId;
        $rows = [];

        foreach ($contacts as $contact) {
            $processed++;
            $lastProcessedId = (int) $contact->id;

            $resolved = $this->resolveContactAttribution($contact);

            $payload = [];
            if ((string) $contact->medium !== $resolved['medium']) {
                $payload['medium'] = $resolved['medium'];
            }
            if ((string) $contact->source !== $resolved['source']) {
                $payload['source'] = $resolved['source'];
            }

            if ($payload !== []) {
                Contact::query()->whereKey($contact->id)->update($payload);
                $updated++;
            }

            $rows[] = [
                'id' => $contact->id,
                'matched_from' => $resolved['matched_from'],
                'medium' => $resolved['medium'],
                'source' => $resolved['source'],
                'updated' => $payload !== [],
            ];
        }

        $hasMore = $processed === $limit
            && Contact::query()->where('id', '>', $lastProcessedId)->exists();

        return response(
            $this->renderRebuildSourceMediumResponse(
                $rows,
                $afterId,
                $lastProcessedId,
                $processed,
                $updated,
                $hasMore,
                $limit,
                $autoContinue
            ),
            200,
            ['Content-Type' => 'text/html; charset=UTF-8']
        );
    }

    private function buildFilteredQuery(array $filters)
    {
        return Contact::query()
            ->when($filters['course'] ?? null, function ($query, $course) {
                $query->where('services', 'like', '%' . $course . '%');
            })
            ->when($filters['source'] ?? null, function ($query, $source) {
                $query->where('source', $source);
            })
            ->when($filters['medium'] ?? null, function ($query, $medium) {
                $query->where('medium', $medium);
            })
            ->when($filters['from_date'] ?? null, function ($query, $fromDate) {
                $query->whereDate('created_at', '>=', $fromDate);
            })
            ->when($filters['to_date'] ?? null, function ($query, $toDate) {
                $query->whereDate('created_at', '<=', $toDate);
            });
    }

    private function validatedFilters(Request $request): array
    {
        return $request->validate([
            'course' => ['nullable', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:255'],
            'medium' => ['nullable', 'string', 'max:255'],
            'from_date' => ['nullable', 'date'],
            'to_date' => ['nullable', 'date', 'after_or_equal:from_date'],
        ]);
    }

    private function resolvePerPage($perPage): int
    {
        $perPage = (int) $perPage;

        return in_array($perPage, self::PER_PAGE_OPTIONS, true) ? $perPage : 10;
    }

    private function resolveContactAttribution(Contact $contact): array
    {
        $candidates = [
            'url' => $this->normalizeAttributionUrl($contact->url),
            'ref_url' => $this->normalizeAttributionUrl($contact->ref_url),
            'source_url' => $this->normalizeAttributionUrl($contact->source_url),
        ];
        $source = $this->deriveSourceFromRefUrl($contact->ref_url);
        $resolved = resolve_medium_from_url_old_data(
            $candidates['url'],
            $candidates['ref_url'],
            $candidates['source_url']
        );
        $mediumValue = trim((string) ($resolved['value'] ?? 'Direct'));

        return [
            'medium' => $mediumValue !== '' ? $mediumValue : 'Direct',
            'source' => $source,
            'matched_from' => $this->resolveMatchedFromField($candidates, $mediumValue, $source),
        ];
    }

    private function normalizeAttributionUrl($value): ?string
    {
        if (! is_scalar($value)) {
            return null;
        }

        $url = trim((string) $value);

        return $url !== '' ? $url : null;
    }

    private function deriveSourceFromRefUrl($refUrl): string
    {
        if (! is_scalar($refUrl)) {
            return 'Direct';
        }

        $externalReferrerUrl = resolve_external_referrer_url(trim((string) $refUrl), env('APP_URL'));
        if ($externalReferrerUrl === null || $externalReferrerUrl === '') {
            return 'Direct';
        }

        $host = parse_url($externalReferrerUrl, PHP_URL_HOST);

        if (! is_string($host) || trim($host) === '') {
            return 'Direct';
        }

        $label = medium_root_domain_label($host);

        return $label ?: 'Direct';
    }

    private function resolveMatchedFromField(array $candidates, string $mediumValue, string $source): string
    {
        foreach (['url', 'ref_url', 'source_url'] as $field) {
            $candidate = $candidates[$field] ?? null;

            if ($candidate === null) {
                continue;
            }

            $resolved = resolve_medium_from_url_old_data($candidate);
            $candidateMedium = trim((string) ($resolved['value'] ?? 'Direct'));

            if ($candidateMedium !== '' && strcasecmp($candidateMedium, $mediumValue) === 0) {
                return $field;
            }
        }

        if (strcasecmp($mediumValue, 'Direct') !== 0) {
            return 'combined';
        }

        return $source !== 'Direct' ? 'ref_url' : 'none';
    }

    private function renderRebuildSourceMediumResponse(
        array $rows,
        int $afterId,
        int $lastProcessedId,
        int $processed,
        int $updated,
        bool $hasMore,
        int $limit,
        bool $autoContinue
    ): string {
        $lines = [];
        $lines[] = 'Contact Source/Medium Batch Update';
        $lines[] = 'Started after ID: ' . $afterId;
        $lines[] = 'Processed in this batch: ' . $processed;
        $lines[] = 'Updated in this batch: ' . $updated;
        $lines[] = 'Skipped in this batch: ' . max($processed - $updated, 0);
        $lines[] = 'Last processed ID: ' . $lastProcessedId;
        $lines[] = 'Status: ' . ($hasMore ? 'IN PROGRESS' : 'COMPLETED');
        $lines[] = str_repeat('-', 110);

        foreach ($rows as $row) {
            $lines[] = sprintf(
                '#%d | matched_from=%s | medium=%s | source=%s | updated=%s',
                $row['id'],
                $row['matched_from'],
                $row['medium'],
                $row['source'],
                $row['updated'] ? 'yes' : 'no'
            );
        }

        $nextUrl = route('contact.rebuild_source_medium', [
            'after_id' => $lastProcessedId,
            'limit' => $limit,
            'auto_continue' => $autoContinue ? 1 : 0,
        ]);

        $lines[] = str_repeat('-', 110);

        if ($hasMore) {
            $lines[] = 'Next batch URL: ' . $nextUrl;
            $lines[] = 'Run next batch to continue updating the next ' . $limit . ' records.';
        } else {
            $lines[] = 'All eligible records have been processed.';
        }

        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8">';

        if ($hasMore && $autoContinue) {
            $html .= '<meta http-equiv="refresh" content="1;url=' . e($nextUrl) . '">';
        }

        $html .= '<title>Contact Source Medium Update</title></head><body>';
        $html .= '<pre style="font-family: Consolas, monospace; white-space: pre-wrap;">' . e(implode(PHP_EOL, $lines)) . '</pre>';

        if ($hasMore) {
            $html .= '<p><a href="' . e($nextUrl) . '">Run Next Batch</a></p>';
        }

        if ($hasMore && ! $autoContinue) {
            $autoUrl = route('contact.rebuild_source_medium', [
                'after_id' => $lastProcessedId,
                'limit' => $limit,
                'auto_continue' => 1,
            ]);

            $html .= '<p><a href="' . e($autoUrl) . '">Run Remaining Batches Automatically</a></p>';
        }

        $html .= '</body></html>';

        return $html;
    }
    /*
    public function status($id, $status) { 
        $contact = Contact::find($id);
        $contact->status = $status;
        $contact->save();
    
        return redirect(route('Contact.index'))->with('success', 'Status Change successfully!');
    }  
    
    public function update(Request $request) {
        $id = $request->input('id');
        $contact = Contact::find($id);
        $contact->update($request->all());

        $response = [
            'status' => true,
            'notification' => 'Contact Update successfully!',
        ];

        return response()->json($response);
    } */   
}
