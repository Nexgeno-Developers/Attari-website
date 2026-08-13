<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use DB;
use App\Models\Syllabus;
use App\Models\Course;

class SitemapController extends Controller
{
    
    public function newSitemap(Request $request, $page) {
        if($page == 'others'):
          $data = $this->generateOtherSitemap();  
        elseif($page == 'blogs'):
          $data = $this->generateBlogSitemap();   
        elseif($page == 'courses'):
          $data = $this->generateCourseSitemap();
        endif; 

        //generate
        $directory = public_path('sitemap');
        $my_file = $directory . '/'.$data['name'].'.xml';
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        $handle = fopen($my_file, 'w+');
        $sitemapContent = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemapContent .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        foreach ($data['url'] as $url) {
            $priority = ($url == url('')) ? '1' : '0.8';
            $sitemapContent .= '
            <url>
                <loc>'.$url.'</loc>
                <lastmod>'.date('Y-m-d').'</lastmod>
                <changefreq>weekly</changefreq>
                <priority>'.$priority.'</priority>
            </url>';
        }
        $sitemapContent .= '</urlset>';
        fwrite($handle, $sitemapContent);
        fclose($handle);
        echo '<h2>'.ucfirst($data["name"]).' sitemap has been updated</h2>';
        echo '<br>';
        echo 'Access at <a target="_blank" href="'.url('sitemap/'.$data["name"].'.xml?'.time()).'">'.url('sitemap/'.$data["name"].'.xml').'</a>';
    }
    
    public function generateOtherSitemap(){
        $otherUrls = [
            url(''),
            url('/contact-us'),
            url('/success-stories'),
            url('/reviews'),
            url('/about-us'),
            url('/batch'),
            url('/training-option-attari-classes'),
            url('/privacy-policy'),
            url('/terms-of-service'),
            url('/refunds-cancellations'),
            url('/photo-gallery'),
        ]; 
        
        return ['url' => $otherUrls, 'name' => 'others'];
    }
    public function generateBlogSitemap(){
        $categoryUrls = [
            url('blog'),
            url('category/vmware'),
            url('category/aws'),
            url('category/azure'),
            url('category/mcse'),
            url('category/ccna'),
        ];
        $categories = DB::table('blogs')->where('status',1)->get();

        foreach ($categories as $category) {
            $categoryUrls[] = url('blog/'.$category->slug);
        }

        return ['url' => $categoryUrls, 'name' => 'blogs'];
    }
    
    public function generateCourseSitemap() {
        $courseUrls = [
            url('learning'),
            url('learning/vmware-practice-test'),
            url('learning/vmware-books-guides'),
            url('learning/aws-practice-test'),
            url('learning/aws-books-guides'),
            url('learning/azure-practice-test'),            
            url('learning/azure-books-guides'),            
            url('learning/mcse-practice-test'),            
            url('learning/mcse-books-guides'),            
            url('learning/ccna-practice-test'),            
            url('learning/ccna-books-guides'),            
        ];
        $courses = DB::table('cms')->get();

        foreach ($courses as $course) {
            $courseUrls[] = url($course->slug);
        }

        return ['url' => $courseUrls, 'name' => 'courses'];
    }   
    
    public function cmsonlineclean(Request $request){
        $courses = DB::table('cms')->where('zone', '!=', '0')->get();
        foreach ($courses as $course) {
            $newSlug =  str_replace('-online', '', $course->slug);
            DB::table('cms')->where('id', $course->id)->update([
                'slug' => $newSlug
            ]);
            
            echo $course->slug.'<br>';
        }
    }
    
    public function generate_curriculum_pdf($courseId)
    {
        //$courseId = 5;
        $course = Course::where('id', $courseId)->first();
        $all_courses = Course::all(); 
        $courseSyllabus = Syllabus::where('course_id', $courseId)->where('status', 1)->orderBy('title_no', 'ASC')->get();
        
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
            <div class="syllabus" style="padding-bottom:150px;">
                <h3 class="margin30" style="color:#154360; font-size:28px;"><strong>' . htmlspecialchars($course->alias4) . ' Training Syllabus</strong></h3>
            ';
            
            $mpdf->AddPage();
            $mpdf->SetHTMLHeader('');
        
        // Loop through the syllabus and add modules dynamically
        foreach ($courseSyllabus as $index => $module) {
            if($index >= 5)
            {
                break;
            }
            $html .= '<div class="margin30" style="page-break-inside: avoid; margin-bottom:10px; background-color:#78d692; color:#fff; font-size:20px; font-weight:900; padding:7px 15px; border-radius:10px; display: block;"><strong>Module ' . ($index + 1) . ': ' . htmlspecialchars($module->title) . '<br></strong></div>';
            $html .= '<div class="discription_list" style="margin-bottom:22px;">' . $module->description . '</div>';
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
        
        $mpdf->Output('syllabus.pdf', 'I');
    }    
    
}
