<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\Cms;
use App\Models\MktWatiTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BusinessSettingController extends Controller
{
    public function index() {
        return view('backend.pages.setting.index');
    }

    public function privacy_policy() {
        return view('backend.pages.privacy.index');
    }

    public function terms() {
        return view('backend.pages.terms.index');
    }

    public function refund_policy() {
        return view('backend.pages.refund_policy.index');
    }

    public function wati_templet()
    {
        $courses = collect(getCourses())->values();
        $templates = MktWatiTemplate::get()
            ->keyBy('course_id');

        return view('backend.pages.website_setting.wati_templet', compact('courses', 'templates'));
    }

    public function email_templet(Request $request)
    {
        $courses = Cms::query()
            ->where('zone', 0)
            ->where('status', 1)
            ->where('course_id', '!=', 9)
            ->orderBy('course_id', 'asc')
            ->get(['course_id', 'menu_title', 'breadcrumb_title']);

        $selectedCourseId = old('course_id', $request->query('course_id'));
        $selectedType = old('type', $request->query('type'));
        $selectedWebsiteUrl = old('website_url', $request->query('website_url'));
        $selectedYoutubeUrl = old('youtube_url', $request->query('youtube_url'));
        $previewHtml = null;

        if ($selectedCourseId && $selectedType) {
            $previewHtml = $this->buildDynamicEmailPreview(
                (int) $selectedCourseId,
                (string) $selectedType,
                [
                    'website_url' => $selectedWebsiteUrl,
                    'youtube_url' => $selectedYoutubeUrl,
                ]
            );
        }

        return view('backend.pages.website_setting.email_templet', compact(
            'courses',
            'selectedCourseId',
            'selectedType',
            'selectedWebsiteUrl',
            'selectedYoutubeUrl',
            'previewHtml'
        ));
    }
      
    public function update(Request $request) {
        // Assuming the request data is in key-value pairs
    
        // Get all the data from the request
        $requestData = $request->all();
        /*
        foreach ($requestData as $key => $value) {
            if($key != '_token'){
                BusinessSetting::where('type', $key)->update(['value' => $value]);
            }
        } */

        foreach ($requestData as $key => $value) {
            if ($key !== '_token' && $value !== null) {
                if ($key === 'Banner_1' || $key === 'Banner_2' || $key === 'Banner_3' || $key === 'Banner_4') {
                    // Handle image update here
                    $type = $key;
                    
                    $imagePath = $value->store('assets/image/banner', 'public');
                    BusinessSetting::where('type', $type)->update(['value' => $imagePath]);
                } else {
                    BusinessSetting::where('type', $key)->update(['value' => $value]);


                    $transformedSentence = ucwords(str_replace('_', ' ', $key));

                    store_log($sentence = $transformedSentence .' Update by');
                }
            }
        }

        $response = [
            'status' => true,
            'notification' => 'Data updated successfully!',
        ];

        return response()->json($response);
    }

    public function update_wati_templet(Request $request)
    {
        $courseMap = collect(getCourses())->keyBy('id');

        $validator = Validator::make($request->all(), [
            'course_ids' => 'required|array|min:1',
            'course_ids.*' => 'required|integer|exists:courses,id',
            'local' => 'nullable|array',
            'local.*' => 'nullable|string|max:255',
            'international' => 'nullable|array',
            'international.*' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all(),
            ], 200);
        }

        $courseIds = collect($request->input('course_ids', []))
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();
        $localValues = $request->input('local', []);
        $internationalValues = $request->input('international', []);

        DB::beginTransaction();

        try {
            $existingTemplates = MktWatiTemplate::whereIn('course_id', $courseIds)->get()->keyBy('course_id');
            $updatedCount = 0;

            foreach ($courseIds as $courseId) {
                $course = $courseMap->get($courseId);

                if (!$course) {
                    continue;
                }

                $courseTitle = $course->menu_title ?: $course->name;
                $template = $existingTemplates->get($courseId);
                $previousConfig = $this->normalizeWatiConfig(optional($template)->config);
                $newConfig = [
                    'local' => trim((string) data_get($localValues, $courseId, '')),
                    'international' => trim((string) data_get($internationalValues, $courseId, '')),
                ];

                if ($previousConfig === $newConfig) {
                    continue;
                }

                $savedTemplate = MktWatiTemplate::updateOrCreate(
                    ['course_id' => $courseId],
                    [
                        'config' => $newConfig,
                        'description' => $courseTitle,
                    ]
                );

                $action = $template ? 'wati_template_update' : 'wati_template_add';
                $remark = ($template ? 'Updated' : 'Added') . ' WATI template for course ' . $courseTitle;

                store_audit_log(
                    $remark,
                    $previousConfig,
                    $newConfig,
                    $action,
                    'mkt_wati_template',
                    $savedTemplate->id
                );

                $updatedCount++;
            }

            if ($updatedCount === 0) {
                DB::commit();

                return response()->json([
                    'status' => true,
                    'notification' => 'No course template changes were found.',
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'notification' => 'WATI template updated successfully for ' . $updatedCount . ' course(s).',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'notification' => 'Unable to update WATI template.',
            ], 200);
        }
    }

    public function generate_email_templet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer',
            'type' => 'required|in:local,international',
            'website_url' => 'required|url',
            'youtube_url' => 'required|url',
            'image' => 'nullable|image|max:5120',
            'youtube_image' => 'nullable|image|max:5120',
        ]);

        $cms = Cms::query()
            ->where('zone', 0)
            ->where('status', 1)
            ->where('course_id', $request->input('course_id'))
            ->first(['course_id', 'menu_title', 'breadcrumb_title']);

        if (!$cms) {
            $validator->after(function ($validator) {
                $validator->errors()->add('course_id', 'Selected course is not available in CMS zone 0.');
            });
        }

        if ($validator->fails()) {
            return redirect()
                ->route('website_setting.email_templet')
                ->withErrors($validator)
                ->withInput();
        }

        $courseId = (int) $request->input('course_id');
        $type = (string) $request->input('type');

        if ($request->hasFile('image')) {
            $this->replaceDynamicEmailAsset($courseId, $type, 'hero', $request->file('image'));
        }

        if ($request->hasFile('youtube_image')) {
            $this->replaceDynamicEmailAsset($courseId, $type, 'youtube', $request->file('youtube_image'));
        }

        $previewHtml = $this->buildDynamicEmailPreview($courseId, $type, [
            'website_url' => (string) $request->input('website_url'),
            'youtube_url' => (string) $request->input('youtube_url'),
            'menu_title' => (string) $cms->menu_title,
            'breadcrumb_title' => (string) $cms->breadcrumb_title,
        ]);

        $courses = Cms::query()
            ->where('zone', 0)
            ->where('status', 1)
            ->where('course_id', '!=', 9)
            ->orderBy('course_id', 'asc')
            ->get(['course_id', 'menu_title', 'breadcrumb_title']);

        return view('backend.pages.website_setting.email_templet', [
            'courses' => $courses,
            'selectedCourseId' => $courseId,
            'selectedType' => $type,
            'selectedWebsiteUrl' => (string) $request->input('website_url'),
            'selectedYoutubeUrl' => (string) $request->input('youtube_url'),
            'previewHtml' => $previewHtml,
            'generated' => true,
        ])->with('success', 'Email template generated successfully.');
    }

    private function normalizeWatiConfig($config): array
    {
        if (is_string($config) && $config !== '') {
            $decoded = json_decode($config, true);
            $config = is_array($decoded) ? $decoded : [];
        }

        if (!is_array($config)) {
            $config = [];
        }

        return [
            'local' => (string) ($config['local'] ?? ''),
            'international' => (string) ($config['international'] ?? ''),
        ];
    }

    private function replaceDynamicEmailAsset(int $courseId, string $type, string $assetType, $image): void
    {
        $disk = Storage::disk('public');
        $prefix = $this->dynamicEmailAssetPrefix($courseId, $type, $assetType);

        foreach ($disk->files('dynamic_email') as $file) {
            if (str_starts_with($file, $prefix . '.')) {
                $disk->delete($file);
            }
        }

        $extension = strtolower($image->getClientOriginalExtension() ?: $image->extension() ?: 'png');
        $image->storeAs('dynamic_email', basename($prefix) . '.' . $extension, 'public');
    }

    private function dynamicEmailAssetPrefix(int $courseId, string $type, string $assetType): string
    {
        if ($assetType === 'youtube') {
            return 'dynamic_email/' . $courseId . '-' . $type . '-youtube';
        }

        return 'dynamic_email/' . $courseId . '-' . $type;
    }

    private function buildDynamicEmailPreview(int $courseId, string $type, array $overrides = []): ?string
    {
        $cms = Cms::query()
            ->where('zone', 0)
            ->where('status', 1)
            ->where('course_id', $courseId)
            ->first(['course_id', 'menu_title', 'breadcrumb_title']);

        if (!$cms) {
            return null;
        }

        $viewName = 'frontend.dynamic_email.' . $courseId . '-' . $type;

        if (!view()->exists($viewName)) {
            return null;
        }

        $emailTemplateData = [
            'course_id' => $courseId,
            'type' => $type,
            'menu_title' => $overrides['menu_title'] ?? (string) $cms->menu_title,
            'breadcrumb_title' => $overrides['breadcrumb_title'] ?? (string) $cms->breadcrumb_title,
            'website_url' => $overrides['website_url'] ?? '',
            'youtube_url' => $overrides['youtube_url'] ?? '',
        ];

        return view($viewName, compact('emailTemplateData'))->render();
    }
}
