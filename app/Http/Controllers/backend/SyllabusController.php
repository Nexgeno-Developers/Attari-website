<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Syllabus;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class SyllabusController extends Controller
{

    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'title_no' => 'required|numeric',
            'title' => 'required',
            'description' => 'required',
            'course_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all()
            ], 200);
        }     

        $syllabus = Syllabus::create([
            'title_no' => $request->input('title_no'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'course_id' => $request->input('course_id'),
        ]);
        
        Self::generate_curriculum_pdf($request->input('course_id'));

        store_log($sentence = 'Course Content ADD in Course Page by');

        $response = [
            'status' => true,
            'notification' => 'Syllabus added successfully!',
        ];
        
        return response()->json($response);
    }     

    public function edit($id) {
        $syllabus = Syllabus::find($id);
        return view('backend.pages.course.section.syllabus.edit', compact('syllabus'));
    }  
    
    public function delete($id) {
        
        $syllabus = Syllabus::find($id);
        if (!$syllabus) {
            $response = [
                'status' => false,
                'notification' => 'Record not found.!',
            ];
            return response()->json($response);
        }
        $syllabus->delete();
        
        Self::generate_curriculum_pdf($syllabus->course_id);

        store_log($sentence = 'Delete Course Content in Course Page by');

        $response = [
            'status' => true,
            'notification' => 'Syllabus deleted successfully!',
        ];

        return response()->json($response);
    }  
    
    public function status($id, $status) { 
        $syllabus = Syllabus::find($id);
        $syllabus->status = $status;
        $syllabus->save();
        
        Self::generate_curriculum_pdf($syllabus->course_id);

        store_log($sentence = 'Status Change Course Content in Course Page by');
    
        return redirect()->back()->with('success', 'Status Change successfully!');
    }  
    
    public function update(Request $request) {

        $validator = Validator::make($request->all(), [
            'title_no' => 'required|numeric',
            'title' => 'required',
            'description' => 'required',
            'course_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all()
            ], 200);
        }

        $id = $request->input('id');
        $syllabus = Syllabus::find($id);

        $syllabus->title_no = $request->input('title_no');
        $syllabus->title = $request->input('title');
        $syllabus->description = $request->input('description');

        $syllabus->save();
        
        Self::generate_curriculum_pdf($syllabus->course_id);

        store_log($sentence = 'Update Course Content in Course Page by');

        $response = [
            'status' => true,
            'notification' => 'Syllabus updated successfully!',
        ];

        return response()->json($response);
    }
    
    
    public function generate_curriculum_pdf($courseId)
    {
        //return true;
        $course = Course::where('id', $courseId)->first();
        
        // $all_courses = Course::all(); 
        $all_courses = getCourses();
        
        $usesLmsSyllabus = false;
        $courseSyllabus = Syllabus::where('course_id', $courseId)->where('status', 1)->orderBy('title_no', 'ASC')->get();

        if (!empty($course->lms_course_id)) {
            $lmsSyllabusResponse = lms_topics_by_course_id_api((int) $course->lms_course_id);

            if (!empty($lmsSyllabusResponse['success']) && !empty($lmsSyllabusResponse['data']) && is_array($lmsSyllabusResponse['data'])) {
                $usesLmsSyllabus = true;
                $courseSyllabus = collect($lmsSyllabusResponse['data'])
                    ->sort(function ($firstTopic, $secondTopic) {
                        return strnatcmp((string) ($firstTopic['lecture_no'] ?? ''), (string) ($secondTopic['lecture_no'] ?? ''));
                    })
                    ->values()
                    ->map(function ($topic, $index) use ($courseId) {
                        return (object) [
                            'id' => null,
                            'course_id' => $courseId,
                            'title_no' => (string) ($topic['lecture_no'] ?? (string) ($index + 1)),
                            'title' => trim((string) ($topic['topic_name'] ?? '')),
                            'description' => (string) ($topic['description'] ?? ''),
                            'status' => 1,
                        ];
                    });
            }
        }
        
        // Initialize mPDF
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => storage_path('app/mpdf_tmp'),
            'margin_top' => 10,
            'margin_bottom' => 0,
            'margin_left' => 0,
            'margin_right' => 0,
            'allow_file_access' => true,
            'fontDir' => [storage_path('app/mpdf_tmp')],
            'fontdata' => [
                'poppins' => [
                    'R' => 'Poppins-Regular.ttf',
                    'B' => 'Poppins-Bold.ttf',
                ]
            ],
            'default_font' => 'poppins'
        ]);

        $mpdf->SetHTMLHeader('
            <div class="margin30" style="text-align: center; position:fixed;top:10px; left:33%; z-index:999;">
                <img src="/assets/frontend/images/cropped-header-logo-1.png" width="220" alt="Attari Classes Logo">
            </div>
        ', '', true);   
        
        $mpdf->SetHTMLFooter('
            <div class="" style="position:fixed; top:-35px; right:0px; z-index:-1;">
                <img style="width:150px; opacity:0.3" src="/assets/frontend/images/syllabus-pdf-bg-1.png" width="220" alt="Background Image">
            </div>
            
            <div class="" style="position:fixed; bottom:-35px; left:0px;">
                <img style="width:150px; transform: rotate(180deg); z-index:0; position:relative; opacity:0.3" src="/assets/frontend/images/syllabus-pdf-bg-1.png" width="220" alt="Background Image">
            </div>
        ');          
        
        // HTML content
        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: sans-serif;
                    // background-image: url("https://i.ibb.co/QFWqSTb/Untitled-16.png");
                }                 
                .header { text-align: center; font-size: 18pt; font-weight: bold; }
                .book-demo { margin: 20px 0; font-size: 12pt; text-align: center; }
                .syllabus { margin: 20px 0; }
                .module { font-weight: bold; margin-top: 15px; }
                ul { margin-left: 0px; margin:0px !important; }
                    .discription_list
                {
                    margin-left:50px;
                    margin-right:30px;
                }
                .discription_list ul
                {
                    padding:0px;
                    margin:0px;
                }
                .discription_list ul li 
                {
                    color:#244460;
                    font-size:18px;
                    line-height:30px;
                    padding-bottom:5px;
                    margin-left:15px;
                }
                .discription_list  
                {
                    color:#244460;
                }
                .discription_list p
                {
                    color:#244460;
                    font-size:18px;
                    line-height:30px;
                    pading:0px;
                    margin:0px;
                    padding-bottom:5px;
                }
                .margin30
                {
                    margin-left:30px;
                    margin-right:30px;
                }
            </style>
        </head>
        <body>
            <div class="courses margin30">
                <h1 style="color:#154360; font-size:30px; font-style: italic; text-align:center;padding-top:95px;">We Offer Following Courses :</h1>';
        foreach ($all_courses as $index => $courseItem) {
            
            if($courseItem->id == 9){
                continue; // Skip the course mcse
            }
            
            $imagePath = asset('storage/' . $courseItem->thumbnail_2);
            $bgColor = ($index === 3) ? '' : '';
            $marginStyle = ($index === 3) ? 'margin-left:19%;' : 'margin-left:25px; margin-right:25px;';
        
            $html .= '
            <div class="courses_boxex" style="width:29%; float:left; ' . $marginStyle . ' background-color: ' . $bgColor . ';">
                <img src="' . $imagePath . '" alt="Course Image" style="width:95%; height:auto;">
                <h3 style="color:#154360; font-size:20px; text-align:center; padding:0px 0px; line-height:28px;">' . 
                    htmlspecialchars($courseItem->alias4) . 
                    ' <br><p style="margin-top:5px; color:#555; font-weight:regular; font-size:16px;"><img src="https://i.ibb.co/Fq7Tgjh/clock-img.png" alt="Attari Classes Logo" style="position:relative; top:40px; width:15px;" > 40+ Hours</p>
                </h3>
            </div>';
            
        }
        $html .= '</div>
        <div style="width:90%; margin-left:auto; margin-right:auto; background-color:#78d692; height:5x; border-radius:10px; margin-bottom:0%;"></div>
            <div class="margin:0px 20px; display:flex; gap:20px;">
            <div class="book-demo" style="width:40%; float:left; background-color:#78d692; font-size:24px; width:250px; margin-left:17%; margin-right:10%;  line-height:50px; height:50px; border-radius:10px; font-weight: bold;">
                <a style="text-decoration:none;" href="'.url($course->slug_url).'"><strong style="color:#154360;">BOOK FREE DEMO</strong></a><br> 
            </div>  
            <div class="book-demo" style="width:50%; text-align:left; padding-left:0%;">
            <div style="padding-left:5%;">
            <div style="width:10%; float:left; padding-top:3%;">
                <img style="width:30px; position:relative; top:10px;" src="https://i.ibb.co/vQrzmy7/globe-icons.png" />
            </div>
            <div style="width:77%; padding-left:5%; line-height:22px;">
            <span style="font-size:14px; color:#154360; padding:0px;" >Visit Us at</span> <br> <a style="color:#154360; font-size:20px; text-decoration:none; position:relative; top:-20px; font-weight:bold; padding-left:20px; padding:20px;" href="https://www.attariclasses.in"><i><strong>www.attariclasses.in</strong></i></a>
            </div>
            </div>
            </div>  
            </div>
            <div class="contact-info" style="background-color:#3f4c63; color:#78d692; padding:14px 10px; padding-left:16%; margin-top:0px;">
                    <div style="width:5%; float:left;position:relative; top:10px; padding-right:3%; padding-top:2.2%;">
                    <img style="width:30px; position:relative; top:10px;" src="https://i.ibb.co/gW44cwX/Untitled-16.png" />  
                    </div>
                    <div style="width:80%; text-align:left; ">
                    <div class="">
                    <div style="width:34%; float:left; padding-top:3%;">
                    <span style="font-size:18px; ">Call/Whatsapp:  </span>
                    </div>
                    <div style="width:58%; padding-left:1%">
                    <a style="color:#78d692; font-size:36px; text-decoration:none; font-weight:900; " href="https://api.whatsapp.com/send?phone=+917738375431&text=Hi%2C+I+am+contacting+you+through+your+website+from+desktop+view+https%3A%2F%2Fattariclasses.in%2F"><strong>+91-7738375431</strong></a>
                    </div>
                    </div>
                    </div>
            </div>
            ';
            
            $html .= '
            <div class="syllabus" style="padding-bottom:155px;">
                <h3 class="margin30" style="color:#154360; font-size:28px;"><strong>' . htmlspecialchars($course->alias4) . ' Training Syllabus</strong></h3>
            ';
            
            $mpdf->AddPage();
            $mpdf->SetHTMLHeader('');
        
        // Loop through the syllabus and add modules dynamically
        foreach ($courseSyllabus as $index => $module) {
            $moduleTitle = ReplaceKeyword($module->title, $course->replace_keyword ?? '[]');
            $moduleDescription = render_course_syllabus_pdf_content($module->description, $course->replace_keyword ?? '[]', $usesLmsSyllabus);

            $html .= '<div class="margin30" style="page-break-inside: avoid; margin-bottom:10px; background-color:#78d692; color:#fff; font-size:20px; font-weight:900; padding:7px 15px; border-radius:10px; display: block;"><strong>Module ' . ($index + 1) . ': ' . htmlspecialchars($moduleTitle) . '<br></strong></div>';
            $html .= '<div class="discription_list" style="margin-bottom:22px;">' . $moduleDescription . '</div>';
        }
    
        $html .= '</div></body></html>';
        
        // Write the HTML content to the PDF
        $mpdf->WriteHTML($html);
        
        $mpdf->SetHTMLFooter('
                           <div style="position:absolute; width:100%; top:99.554%;">
                       <div style="width:90%; margin-left:auto; margin-right:auto; background-color:#78d692; height:5x; border-radius:10px; margin-top:-21.4%;clear:both;"></div>
                       <div class="margin:0px 20px; display:flex; gap:20px; clear:both;">
                         <div class="book-demo" style="width:40%; float:left; background-color:#78d692; font-size:24px; width:250px; margin-left:17%; margin-right:10%;  line-height:50px; height:50px; border-radius:10px; font-weight: bold;">
                           <a style="text-decoration:none;" href="'.url($course->slug_url).'">
                             <strong style="color:#154360;">BOOK FREE DEMO</strong>
                           </a>
                           <br>
                         </div>
                         <div class="book-demo" style="width:50%; text-align:left; padding-left:0%;">
                           <div style="padding-left:5%;">
                             <div style="width:10%; float:left; padding-top:3%;">
                               <img style="width:30px; position:relative; top:10px;" src="https://i.ibb.co/vQrzmy7/globe-icons.png" />
                             </div>
                             <div style="width:77%; padding-left:5%; line-height:22px;">
                               <span style="font-size:14px; color:#154360; padding:0px;">Visit Us at</span>
                               <br>
                               <a style="color:#154360; font-size:20px; text-decoration:none; position:relative; top:-20px; font-weight:bold; padding-left:20px; padding:20px;" href="https://www.attariclasses.in">
                                 <i>
                                   <strong>www.attariclasses.in</strong>
                                 </i>
                               </a>
                             </div>
                           </div>
                         </div>
                       </div>
                       
                       
                       <div class="contact-info" style="background-color:#3f4c63; color:#78d692; padding:15px 10px; padding-left:16%; margin-top:21.6px;clear:both;">
                         <div style="width:5%; float:left;position:relative; top:10px; padding-right:3%; padding-top:2.2%;">
                           <img style="width:30px; position:relative; top:10px;" src="https://i.ibb.co/gW44cwX/Untitled-16.png" />
                         </div>
                         <div style="width:80%; text-align:left; ">
                           <div class="">
                             <div style="width:34%; float:left; padding-top:3%;">
                               <span style="font-size:18px; ">Call/Whatsapp: </span>
                             </div>
                             <div style="width:58%; padding-left:1%">
                               <a style="color:#78d692; font-size:36px; text-decoration:none; font-weight:900; " href="https://api.whatsapp.com/send?phone=+917738375431&text=Hi%2C+I+am+contacting+you+through+your+website+from+desktop+view+https%3A%2F%2Fattariclasses.in%2F">
                                 <strong>+91-7738375431</strong>
                               </a>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
    ', 'O', true);        
        
        // Sanitize course alias for the file name
        $sanitizedAlias = preg_replace('/[^\w\-]/', '-', $course->alias4); // Replace unwanted characters with hyphens
        $sanitizedAlias = preg_replace('/-+/', '-', $sanitizedAlias); // Replace multiple hyphens with a single hyphen
        $sanitizedAlias = trim($sanitizedAlias, '-'); // Trim leading/trailing hyphens        
        
        // Save the generated PDF to a file
        $filePath = 'assets/image/pdf/syllabus/' . time() . '_' . str_replace(' ', '-', $sanitizedAlias) . '.pdf';
        Storage::disk('public')->put($filePath, $mpdf->Output('', 'S'));     
        
        $course = Course::find($courseId);
        
        // Check if the file exists and delete it
        if (Storage::disk('public')->exists($course->curriculum_pdf)) {
            Storage::disk('public')->delete($course->curriculum_pdf);
        }        

        $course->curriculum_pdf = $filePath;
        $course->save();
        
        if(request()->display == true){
            $mpdf->Output('syllabus.pdf', 'I');
        }else{
            // Output the generated PDF to browser
            return true;            
        }
    }    
}
