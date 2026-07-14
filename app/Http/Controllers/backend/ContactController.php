<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
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
                'ID',
                'IP',
                'Name',
                'Email',
                'Phone No',
                'Course',
                'Source',
                'Medium',
                'gad_campaignid',
                'gclid',
                'Page',
                'Section',
                'Country Code',
                'Country Phone',
                'Syllabus Status',
                'Email Status',
                'Created At',
            ]);

            foreach ($this->buildFilteredQuery($filters)->orderByDesc('created_at')->cursor() as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->ip,
                    $contact->name,
                    $contact->email,
                    $contact->phone,
                    $contact->services,
                    $contact->source,
                    $contact->medium,
                    $contact->gad_campaign_id,
                    $contact->gclid,
                    $contact->url,
                    $contact->section,
                    $contact->w_countrycode,
                    $contact->w_phone,
                    (string) $contact->w_syllabus === '1' ? 'SENT' : 'FAILED',
                    (int) $contact->email_sent === 1 ? 'SENT' : 'PENDING',
                    optional($contact->created_at)->format('Y-m-d H:i:s'),
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
