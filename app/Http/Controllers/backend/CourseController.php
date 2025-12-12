<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index() {
        $course = Course::orderBy('id', 'ASC')->get();
        return view('backend.pages.course.index', compact('course'));
    }

    public function add() {
        //$course = Course::where('status', 1)->get();
        //return view('backend.pages.course.add', compact('course'));
        return view('backend.pages.course.add');
    }  
    
    public function create(Request $request) {
        // Validate form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            //'description' => 'required',
            'thumbnail' => 'image',
            'course_overview' => 'required',
            'overview_section_heading' => 'required',
            'key_title' => 'required',

            'rating' => 'required',
            'total_review' => 'required',

            'slug_url' => 'required|unique:courses',
            'meta_title' => 'required',
            'meta_description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all()
            ], 200);
        } 
        
        // slug_url
        $slug_url = customSlug($request->input('slug_url'));
    
        // Upload image
        
        if ($request->hasFile('thumbnail')) {
            $imagePath = $request->file('thumbnail')->store('assets/image/course', 'public');
        } else {
            $imagePath = null;
        }

        if ($request->hasFile('other_thumbnail')) {
            $imagePath1 = $request->file('other_thumbnail')->store('assets/image/course', 'public');
        } else {
            $imagePath1 = null;
        }

        // Extract and handle FAQ data
        $faq = $request->input('faq');
        $faq_description = $request->input('faq_description');
    
        if (!empty($faq[0])) {
            $faqs = [];
            for ($j = 0; $j < count($faq); $j++) {
                $faqs[] = [
                    $faq[$j] => $faq_description[$j],
                ];
            }
            $data['faq'] = json_encode($faqs);
        } else {
            $data['faq'] = '[]';
        }
    
        // Remove the 'faq_description' key as it's not needed anymore
        unset($data['faq_description']);
        
        // Create the Course record with 'Course_category_ids' included
        Course::create([
            'name' => $request->input('name'),
            //'description' => $request->input('description'),
            'url' => $request->input('url'),
            'thumbnail' => $imagePath,
            'other_thumbnail' => $imagePath1,

            'rating' => $request->input('rating'),
            'total_review' => $request->input('total_review'),
            'key_title' => $request->input('key_title'),

            'course_overview' => $request->input('course_overview'),
            'faq' => $data['faq'],
            'overview_section_heading' => $request->input('overview_section_heading'),

            'slug_url' => $slug_url,
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
        ]);

        store_log($sentence = 'Create a New Course Page by');
    
        $response = [
            'status' => true,
            'notification' => 'Course added successfully!',
        ];
    
        return response()->json($response);
    }   

    public function edit($id) {
        $course = Course::find($id);
        return view('backend.pages.course.edit', compact('course'));
    }
        
    public function delete($id) {
        
        $course = Course::find($id);
        $course->delete();

        store_log($sentence = 'Delete a Course Page by');

        $response = [
            'status' => true,
            'notification' => 'Course deleted successfully!',
        ];

        return response()->json($response);
    }  
    
    public function status($id, $status) { 
        $course = Course::find($id);
        $course->status = $status;
        $course->save();

        store_log($sentence = 'Status Change a Course Page by');
    
        return redirect(route('course.index'))->with('success', 'Status changed successfully!');
    }  
    
    public function update(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            //'description' => 'required',
            'thumbnail' => 'image',
            'course_overview' => 'required',
            'overview_section_heading' => 'required',
            'key_title' => 'required',
            
            'rating' => 'required',
            'total_review' => 'required',


            'slug_url' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all()
            ], 200);
        }

        $slug_url = customSlug($request->input('slug_url'));

        $id = $request->input('id');
        $course = Course::find($id);
    
        if ($request->hasFile('thumbnail')) {
            // Update the image if a new one is uploaded
            $imagePath = $request->file('thumbnail')->store('assets/image/course', 'public');
            $course->thumbnail = $imagePath;
        }else{
            if($request->has('thumbnail_check') && $course->thumbnail){
                Storage::disk('public')->delete($course->thumbnail);
                $course->thumbnail = null;
            }
        }

        if ($request->hasFile('other_thumbnail')) {
            // Update the image if a new one is uploaded
            $imagePath1 = $request->file('other_thumbnail')->store('assets/image/course', 'public');
            $course->other_thumbnail = $imagePath1;
        }else{
            if($request->has('other_thumbnail_check') && $course->other_thumbnail){
                Storage::disk('public')->delete($course->other_thumbnail);
                $course->other_thumbnail = null;
            }
        }
        
        if ($request->hasFile('thumbnail_1')) {
            // Update the image if a new one is uploaded
            $img = $request->file('thumbnail_1')->store('assets/image/course', 'public');
            $course->thumbnail_1 = $img;
        }else{
            if($request->has('thumbnail_1_check') && $course->thumbnail_1){
                Storage::disk('public')->delete($course->thumbnail_1);
                $course->thumbnail_1 = null;
            }
        }
        
        if ($request->hasFile('thumbnail_2')) {
            // Update the image if a new one is uploaded
            $img = $request->file('thumbnail_2')->store('assets/image/course', 'public');
            $course->thumbnail_2 = $img;
        }else{
            if($request->has('thumbnail_2_check') && $course->thumbnail_2){
                Storage::disk('public')->delete($course->thumbnail_2);
                $course->thumbnail_2 = null;
            }
        }        

        // Extract and handle FAQ data
        $faq = $request->input('faq');
        $faq_description = $request->input('faq_description');
    
        if (!empty($faq[0])) {
            $faqs = [];
            for ($j = 0; $j < count($faq); $j++) {
                $faqs[] = [
                    $faq[$j] => $faq_description[$j],    
                ];
            }
            $data['faq'] = json_encode($faqs);
        } else {
            $data['faq'] = '[]';
        }
    
        // Remove the 'faq_description' key as it's not needed anymore
        unset($data['faq_description']);

        $course->name = $request->input('name');
        $course->alias4 = $request->input('alias4');
        $course->url = $request->input('url');
        $course->course_overview = $request->input('course_overview');
        $course->faq = $data['faq'];
        $course->overview_section_heading = $request->input('overview_section_heading');

        $course->rating = $request->input('rating');
        $course->total_review = $request->input('total_review');
        $course->key_title = $request->input('key_title');


        $course->slug_url = $slug_url;
        $course->meta_title = $request->input('meta_title');
        $course->meta_description = $request->input('meta_description');

        $course->save();

        

        store_log($sentence = 'Update a Course Page by');

        $response = [
            'status' => true,
            'notification' => 'Course updated successfully!',
        ];

        return response()->json($response);
    }
    
    
    public function update_heading(Request $request) {
        $validator = Validator::make($request->all(), [
            'heading' => 'required|max:191',
            'curriculum_pdf' => 'nullable|mimetypes:application/pdf,application/msword',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => 'Something Went Wrong',
            ]);
        }
    
        $id = $request->input('course_id');
        $course = Course::find($id);
    
        if (!$course) {
            return response()->json([
                'status' => false,
                'notification' => 'Course not found',
            ]);
        }

        if ($request->hasFile('curriculum_pdf')) {
            $course->curriculum_pdf = $request->file('curriculum_pdf')->store('assets/image/pdf', 'public');
        } else {
            if($request->has('pdf_check') && $course->curriculum_pdf){
                Storage::disk('public')->delete($course->curriculum_pdf);
                $course->curriculum_pdf = null;
            }
        }
    
        $section = $request->input('section');
        $course->{$section . '_section_heading'} = $request->input('heading');
    
        $course->save();

        store_log($sentence = ucfirst($section) . ' Section Heading is Update Course Page by');
    
        $response = [
            'status' => true,
            'notification' => ucfirst($section) . ' Heading updated successfully!',
        ];
    
        return response()->json($response);
    }



    public function update_schema(Request $request) {
        $validator = Validator::make($request->all(), [
            'section_schema' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => 'Something Went Wrong',
            ]);
        }
    
        $id = $request->input('course_id');
        $course = Course::find($id);
    
        if (!$course) {
            return response()->json([
                'status' => false,
                'notification' => 'Course not found',
            ]);
        }
    
        $section = $request->input('section');
        $course->{$section . '_section_schema'} = $request->input('section_schema');
    
        $course->save();

        store_log($sentence = ucfirst($section) . ' Section Schema is Update Course Page by');
    
        $response = [
            'status' => true,
            'notification' => ucfirst($section) . ' Schema updated successfully!',
        ];
    
        return response()->json($response);
    }


    // ------------------------- Aditional Seo Section ------------------------- //

    public function seo_update(Request $request) {
        // Validate form data
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|max:255',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all()
            ], 200);
        } 

        // Update the SEO fields
        $id = $request->input('id');
        $course = Course::find($id);

        $course->seo_label = !empty($request->input('title')) ? $request->input('title') : null;
        $course->seo_description = !empty($request->input('description')) ? $request->input('description') : null;

        $course->save();

        store_log($sentence = 'Updated Additional SEO Details by Course ' . $course->name);

        $response = [
            'status' => true,
            'notification' => 'SEO Details updated successfully!',
        ];
    
        return response()->json($response);
    }   
        





}
