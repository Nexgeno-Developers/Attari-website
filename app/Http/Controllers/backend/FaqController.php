<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Faq;

class FaqController extends Controller
{
    public function list(Request $request, Course $course)
    {
        $zone = $this->normalizeZoneFilter($request->input('zone'));
        $faqs = $this->faqQuery($course->id, $zone)->get();

        return response()->json([
            'status' => true,
            'html' => view('backend.pages.course.section.faq._rows', compact('faqs'))->render(),
        ]);
    }

    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
            'course_id' => 'required|exists:courses,id',
            'title_no'  => 'required|integer|min:0',
            'zone' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all()
            ], 200);
        }     

        $faq = Faq::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'zone' => $request->input('zone'),
            'course_id' => $request->input('course_id'),
            'title_no' => $request->input('title_no'),
        ]);

        store_log($sentence = 'Create a New Faq in Course Page by');

        $response = [
            'status' => true,
            'notification' => 'Faq added successfully!',
            'faq' => $this->faqPayload($faq),
            'row_html' => $this->renderRow($faq),
        ];
        
        return response()->json($response);
    }     

    public function edit($id) {
        $faq = Faq::find($id);

        if (!$faq) {
            abort(404);
        }

        return view('backend.pages.course.section.faq.edit', compact('faq'));
    }  
    
    public function delete($id) {
        
        $faq = Faq::find($id);
        if (!$faq) {
            $response = [
                'status' => false,
                'notification' => 'Record not found.!',
            ];
            return response()->json($response);
        }
        $faq->delete();

        $response = [
            'status' => true,
            'notification' => 'Faq deleted successfully!',
            'deleted_id' => $id,
        ];

        return response()->json($response);
    }  
    
    public function status($id, $status) { 
        $faq = Faq::find($id);
        if (!$faq || !in_array((string) $status, ['0', '1'], true)) {
            if (request()->ajax()) {
                return response()->json([
                    'status' => false,
                    'notification' => 'Record not found.!',
                ], 404);
            }

            return redirect()->back()->with('error', 'Record not found.');
        }

        $faq->status = $status;
        $faq->save();

        if (request()->ajax()) {
            return response()->json([
                'status' => true,
                'notification' => 'Status changed successfully!',
                'faq' => $this->faqPayload($faq),
                'row_html' => $this->renderRow($faq),
            ]);
        }

        return redirect()->back()->with('success', 'Status Change successfully!');
    }  
    
    public function update(Request $request) {

        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
            'zone' => 'required|in:0,1',
            'course_id' => 'required|exists:courses,id',
            'title_no' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all()
            ], 200);
        }

        $id = $request->input('id');
        $faq = Faq::find($id);
        if (!$faq) {
            return response()->json([
                'status' => false,
                'notification' => 'Record not found.!',
            ], 404);
        }

        $faq->question = $request->input('question');
        $faq->answer = $request->input('answer');
        $faq->zone = $request->input('zone');
        $faq->course_id = $request->input('course_id');
        $faq->title_no = $request->input('title_no');
        $faq->save();

        store_log($sentence = 'Update a Faq in Course Page by');

        $response = [
            'status' => true,
            'notification' => 'Faq updated successfully!',
            'faq' => $this->faqPayload($faq),
            'row_html' => $this->renderRow($faq),
        ];

        return response()->json($response);
    }

    private function faqQuery(int $courseId, ?string $zone = null)
    {
        return Faq::query()
            ->where('course_id', $courseId)
            ->when($zone !== null, function ($query) use ($zone) {
                $query->where('zone', $zone);
            })
            ->orderBy('title_no')
            ->orderBy('id');
    }

    private function renderRow(Faq $faq): string
    {
        return view('backend.pages.course.section.faq._row', [
            'faq' => $faq->fresh(),
        ])->render();
    }

    private function faqPayload(Faq $faq): array
    {
        return [
            'id' => $faq->id,
            'course_id' => $faq->course_id,
            'title_no' => (int) $faq->title_no,
            'zone' => (string) $faq->zone,
            'status' => (int) $faq->status,
        ];
    }

    private function normalizeZoneFilter($zone): ?string
    {
        return in_array((string) $zone, ['0', '1'], true) ? (string) $zone : null;
    }
}