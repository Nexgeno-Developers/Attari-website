<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;

use App\Models\Faq;
use App\Models\Contact;
use App\Models\BlogComment;

use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

use App\Models\Newsletter;
use App\Models\Cms;
use App\Models\Course;
use App\Models\Batch;
use App\Models\TextReview;
use App\Models\ImagesReview;
use App\Models\VideoReview;
use App\Models\Syllabus;
use App\Models\ProjectCovered;
use App\Models\Certificate;
use Illuminate\Support\Facades\Validator;
use App\Models\Learnings;
use DB;


class IndexController extends Controller
{
    public function index(){
        return view('frontend.pages.home.index');
    }
    public function form() {
        $section = request('section');
        $title = request('title');    
        $course_name = request('course_name');    
        $Headingclassname = request('Headingclassname');    
        $msgfield = request('msgfield');
        $param1 = request('param1');    
        $param2 = request('param2');    
        $param3 = request('param3');    
        return view('frontend.component.common_form', compact('section', 'title', 'course_name','Headingclassname', 'msgfield', 'param1', 'param2', 'param3'));
    }
    

//--------------=============================== Blog  ================================------------------------------

    public function blog(Request $request){
        $blog = Blog::where('status', 1)->where('invisible', 0)->whereJsonContains('blog_category_ids', '3')->orderBy('updated_at', 'desc')->paginate(6);

        return view('frontend.pages.blog.index', compact('blog'));
    }

    //  category filter post
    public function blog_course($course, Request $request)
    {
        // Fetch the course based on the provided alias
        $course_id = Course::where('status', 1)->where('alias', $course)->value('id');

        // Check if the course is found
        if ($course_id) {
            // Fetch blogs related to the course
            $blog = Blog::where('status', 1)->where('invisible', 0)
                ->whereJsonContains('blog_category_ids', '3') // Assuming '3' is the category ID for blogs related to this course
                ->where('course_id', $course_id)
                ->orderBy('featured', 'desc')
                ->orderBy('updated_at', 'desc')
                ->paginate(6);
    
            return view('frontend.pages.blog.index', compact('blog'));
        } else {
            return view('frontend.pages.404.index');

        }
        
    }
    

    public function blog_data(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 6;
    
        $blog = Blog::where('status', 1)
            ->whereJsonContains('blog_category_ids', '3')
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
    
        if ($request->ajax()) {
            $view = view('frontend.component.blog_list_card', compact('blog'))->render();
    
            return response()->json(['html' => $view]);
        }
    
        return view('frontend.pages.blog.index', compact('blog'));
    }

    public function blog_detail($category, $slug)
    {
        $designation = null;
        // Check if the user is authenticated and if the user has a designation
        if (auth()->check() && isset(auth()->user()->designation)) {
            $designation = auth()->user()->designation;
        }
    
        $isSuperAdmin = ($designation === 'SuperAdmin' || $designation === 'seo' );
    
        // Check if the URL contains the preview=true parameter
        $isPreview = request()->has('preview') && request()->input('preview') === 'true';
        
        $category_id = BlogCategory::where('slug', $category)->first();
        
        if ($isSuperAdmin && $isPreview) {
            $detail = Blog::where('slug', $slug)->first(); // Fetch blog details regardless of status
        } else {
            $detail = Blog::where('slug', $slug)->where('status', 1)->first(); // Fetch only active blog details
        }
    
        // $detail = Blog::where('slug', $slug)->where('status', 1)->first();        
        // $course = Course::where('status', 1)->where('id', $detail->course_id)->first(['id', 'name', 'alias']);
    
        if ($detail) {
            $course = Course::where('status', 1)->where('id', $detail->course_id)->first(['id', 'name', 'alias']);
            $blog_category_ids = json_decode($detail->blog_category_ids);
            $first_category_id = $blog_category_ids[0];

            if ($first_category_id == $category_id->id) {
                $author = json_decode($detail->user_id, true);


            $blogQuery = Blog::query();
            
            // if (!$isSuperAdmin && !$isPreview) {
            //     // If the user is not a SuperAdmin and it's not in preview mode, add a condition to fetch only active blogs
            //     $blogQuery->where('status', 1);
            // }
            
            // Continue building your query
                $blog = $blogQuery->whereJsonContains('blog_category_ids', json_decode($detail->blog_category_ids))
                        ->where('id', '!=', $detail->id)
                        ->where('course_id',$detail->course_id)
                        ->where('status', 1)
                        ->where('invisible', 0)
                        ->orderBy('featured', 'desc')
                        ->orderBy('updated_at', 'desc')
                        ->limit(4)
                        ->get();
                /*
                $blog = $blogQuery->whereJsonContains('blog_category_ids', json_decode($detail->blog_category_ids))
                                ->whereJsonContains('blog_category_ids', '' . $category_id->id . '')
                                ->where('id', '!=', $detail->id)->where('status', 1)->where('invisible', 0)->limit(4)
                                ->orderBy('id', 'desc')
                                ->get();
                */
                                
                //$blog = Blog::where('status', 1)->whereJsonContains('blog_category_ids', ''.$category_id->id.'')->where('id', '!=', $detail->id)->limit(3)->orderBy('id', 'desc')->get();

                // $blog = Blog::where('status', 1)
                //     ->whereJsonContains('blog_category_ids', json_decode($detail->blog_category_ids))
                //     ->whereJsonContains('blog_category_ids', '' . $category_id->id . '')
                //     ->where('id', '!=', $detail->id)->limit(4)
                //     ->orderBy('id', 'desc')
                //     ->get();

                /*
                $current_id = $detail->id;

                $previous = Blog::where('status', 1)
                    ->whereJsonContains('blog_category_ids', '' . $category_id->id . '')
                    ->where('id', '<', $current_id)
                    ->orderBy('id', 'desc')
                    ->first();

                $next = Blog::where('status', 1)
                    ->whereJsonContains('blog_category_ids', '' . $category_id->id . '')
                    ->where('id', '>', $current_id)
                    ->orderBy('id', 'asc')
                    ->first();

                $previous_slug = $previous ? $previous->slug : null;
                $next_slug = $next ? $next->slug : null;

                return view('frontend.pages.blog.detail', compact('detail', 'author', 'blog', 'previous_slug', 'next_slug', 'course'));
                */

                return view('frontend.pages.blog.detail', compact('detail', 'author', 'blog', 'course'));
            }
        }
        return view('frontend.pages.404.index');

    }

//--------------=============================== Blog end ================================------------------------------


//--------------=============================== other ================================------------------------------

    public function not_found(){

        return view('frontend.pages.404.index');
    }
    public function thank_you(){

        return view('frontend.pages.thankyou.index');
    }

    public function cookie_policy(){

        return view('frontend.pages.cookiePolicy.index');
    }

//--------------=============================== other ================================------------------------------

//--------------=============================== Pages ================================------------------------------

    public function contact_us(){
        return view('frontend.pages.contact.index');
    }

    public function career(){
        return view('frontend.pages.career.index');
    }

    public function faq(){
        $faq = Faq::where('status', 1)->get();
        return view('frontend.pages.faq.index', compact('faq'));
    }

    public function about_us(){
        return view('frontend.pages.about.index');
    }

    public function privacy_policy(){
        return view('frontend.pages.privacypolice.index');
    }

//--------------=============================== Pages ================================------------------------------

//--------------=============================== contact form save ===========================------------------------------

    public function contact_save(Request $request)
    {
        $appHost = parse_url(config('app.url') ?: url('/'), PHP_URL_HOST);
        $appHost = strtolower((string) preg_replace('/^www\./', '', (string) $appHost));

        $originHost = parse_url((string) $request->headers->get('origin'), PHP_URL_HOST);
        $originHost = strtolower((string) preg_replace('/^www\./', '', (string) $originHost));

        $refererHost = parse_url((string) $request->headers->get('referer'), PHP_URL_HOST);
        $refererHost = strtolower((string) preg_replace('/^www\./', '', (string) $refererHost));

        if (empty($appHost) || (($originHost && $originHost !== $appHost) || ($refererHost && $refererHost !== $appHost)) || (!$originHost && !$refererHost)) {
            return response()->json([
                'status' => false,
                'notification' => [
                    'request' => ['Invalid request source.'],
                ],
            ], 403);
        }

        $allowedServices = collect(getCourses())
            ->pluck('menu_title')
            ->filter()
            ->map(fn ($service) => trim((string) $service))
            ->unique()
            ->values()
            ->all();

        $rules = [
            'name' => ['required', 'string', 'min:1', 'max:50', 'regex:/^[\pL\s\.\'\-]+$/u'],
            'email' => ['required', 'email:rfc', 'max:50'],
            'country' => ['required', 'string', 'min:2', 'max:50',  'regex:/^[\pL\d\s\.\'\-]+$/u'],
            'services' => ['required', Rule::in($allowedServices)],
            'phone' => ['required', 'string', 'min:7', 'max:20', 'regex:/^\+?[0-9][0-9\s\-\(\)]{6,19}$/'],
            'description' => ['nullable', 'string', 'max:200'],
        ];
    
        $validator = Validator::make($request->all(), $rules, [
            'name.regex' => 'The full name format is invalid.',
            'country.regex' => 'The country name format is invalid.',
            'services.required' => 'Please select a course.',
            'services.in' => 'Please select a valid course.',
            'phone.regex' => 'Please enter a valid mobile number with country code.',
        ], [
            'name' => 'full name',
            'email' => 'email address',
            'country' => 'country',
            'phone' => 'mobile number',
            'services' => 'course',
            'description' => 'message',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors(),
            ]);
        }
        
        //----- new ip --------
        $ip = ip_info();
        $ip_data = $ip;
        $user_ip = json_decode($ip, true);
        //----- new ip --------
        
        // Create the contact record, including 'cv' if provided
        $contactData = $request->all();
        
        //----- new ip --------
        $contactData['ip'] = isset($user_ip["ip"]) ? $user_ip["ip"] : ' - ';
        //----- new ip --------

        $email = isset($contactData["email"]) ? $contactData["email"] : ' - ';

        $services = isset($contactData["services"]) ? $contactData["services"] : ' - ';

        $ref_url = isset($contactData["ref_url"]) ? $contactData["ref_url"] : ' - ';


        $request->session()->put('course_name', $services);
        
        $contactData['ref_url'] = $ref_url;
        
        //----- new ip --------
        $contactData['ip_data'] = $ip_data;
        //----- new ip --------

        $honeypotFieldName = trim((string) $request->input('honeypot_field_name', ''));
        $honeypotValue = '';

        if ($honeypotFieldName !== '') {
            $honeypotValue = trim((string) $request->input($honeypotFieldName, ''));
        }

        $contactData['honeypot_value'] = $honeypotValue !== '' ? $honeypotValue : null;
        
        
        // set source_url and source from session
        $contactData['source_url'] = session('source_url') ?? '-';
        $contactData['source'] = session('source') ?? '-';
        
        // Create the contact record
        $contact = Contact::create($contactData);
        $insertId = $contact->id;
        $request->session()->put('enquiry_id', $insertId);

        SendinBlueContact_lead($email);

        $response = [
            'status' => true,
            'notification' => 'Thank you, Attari Classes support desk will get in touch with you',
            'data' => ['course' => $services, 'enquiry_id' => $insertId]
        ];
    
        return response()->json($response);
    }
   //--------------=============================== contact form save ===========================--------------------------
   
   //--------------=============================== newsleatter ==========================================-------------------------

    public function newsletter_save(Request $request)
    {
        exit();
        $rules = [
            'email' => 'required|email',
        ];
    
        $validator = Validator::make($request->all(), $rules); // Pass $request->all() as the first argument
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors(),
            ]);
        }
    

        // Create the contact record, including 'cv' if provided
        $newsletterData = $request->all();
        
        $services = $newsletterData['services'];
        
        if(stripos(strtolower($services), "vmware") !== false){
            $course = $services;
            $link = "https://attariclasses.in/vmware-training-certification-online";
            $photo = url("/storage/assets/image/course/xmruajQeRWE5VfgYek1gsclqGYuL5Vb83vPl1tGF.jpg");
            
            $detail = Course::where('id', 5)->first(['other_thumbnail', 'url']);
            
            if (strpos($detail->url, 'embed/') === false) {
                $videoID = basename($detail->url);
                $youtube_url_detail = 'https://www.youtube.com/watch?v=iTGqlC2X-CQ';
            } else {
                $youtube_url_detail = 'https://www.youtube.com/watch?v=iTGqlC2X-CQ'; 
            }
            
           $thumbnail = url("/storage/assets/image/course/vmware_imagewithicon.jpg");
            
        } elseif(stripos(strtolower($services), "aws") !== false) {
            $course = $services;
            $link = "https://attariclasses.in/aws-certification-training-online";
            $photo = url("/storage/assets/image/course/vyO14UddKZbtWfLUjqEG24DDjOEHwH1idurI8uP6.jpg");
            
            $detail = Course::where('id', 7)->first(['other_thumbnail', 'url']);
            
            if (strpos($detail->url, 'embed/') === false) {
                $videoID = basename($detail->url);
                $youtube_url_detail = 'https://www.youtube.com/watch?v=6m_MUXX880w';
            } else {
                $youtube_url_detail = 'https://www.youtube.com/watch?v=6m_MUXX880w'; 
            }
            
            $thumbnail = url("/storage/assets/image/course/aws_imagewithicon.jpg");
            
        } elseif(stripos(strtolower($services), "azure") !== false) {
            $course = $services;
            $link = "https://attariclasses.in/microsoft-azure-certification-training-online";
            $photo = url("/storage/assets/image/course/9TbEDgoGvFUZbEZAiiEtouTyhMlNEwVxvQcBy0WV.jpg");
            
            $detail = Course::where('id', 8)->first(['other_thumbnail', 'url']);
            
            if (strpos($detail->url, 'embed/') === false) {
                $videoID = basename($detail->url);
                $youtube_url_detail = 'https://www.youtube.com/watch?v=awIpvRh91g4';
            } else {
                $youtube_url_detail = 'https://www.youtube.com/watch?v=awIpvRh91g4'; 
            }
            
            $thumbnail = url("/storage/assets/image/course/azure_imagewithicon.jpg");
            
        } elseif(stripos(strtolower($services), "mcse") !== false) {
            $course = $services;
            $link = "https://attariclasses.in/mcsa-mcse-windows-server-training-online";
            $photo = url("/storage/assets/image/course/6Rcaoaj1ZJ01xZLd3HCCNGWIvSzezrdfOWEphjD5.jpg");
            
            $detail = Course::where('id', 9)->first(['other_thumbnail', 'url']);
            
            if (strpos($detail->url, 'embed/') === false) {
                $videoID = basename($detail->url);
                $youtube_url_detail = 'https://www.youtube.com/watch?v=fPnLmybCTNI';
            } else {
                $youtube_url_detail = 'https://www.youtube.com/watch?v=fPnLmybCTNI'; 
            }
            
            $thumbnail = url("/storage/assets/image/course/mcse_imagewithicon.jpg");
            
        } elseif(stripos(strtolower($services), "ccna") !== false) {
            $course = $services;
            $link = "https://attariclasses.in/ccna-training-certification-online";
            $photo = url("/storage/assets/image/course/gfmy7QsoXhJpvBNmrSDswBSoGBaA4oDj43hzAdNQ.jpg");
            
            $detail = Course::where('id', 10)->first(['other_thumbnail', 'url']);
            
            if (strpos($detail->url, 'embed/') === false) {
                $videoID = basename($detail->url);
                $youtube_url_detail = 'https://www.youtube.com/watch?v=rtoJAZPC4Fc';
            } else {
                $youtube_url_detail = 'https://www.youtube.com/watch?v=rtoJAZPC4Fc'; 
            }
            
            $thumbnail = url("/storage/assets/image/course/ccna_imagewithicon.jpg");
            
        } else {
            $course = " ";
        }
        
        $email = isset($newsletterData["email"]) ? $newsletterData["email"] : ' - ';


        SendinBlueContact($email);

        // Create the contact record
        Newsletter::create($newsletterData);

        // Send email if $cvPath is not null
       
        $recipient = ''.$email.''; 
        $subject  =  'Thanks for subscribing to Attari Classes Newsletter!';
     
        $body = '
<div dir="ltr"><div dir="ltr"><div dir="ltr">
    <div style="background-color:rgb(245,245,245)">
       
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tbody><tr>
                <td valign="top" align="center" style="vertical-align:top">
                    <table bgcolor="#ffffff" style="margin:30px auto" align="center" id="m_-1949506833382230800m_-7264147416499442627m_-3993252541518334385gmail-brick_container" cellspacing="0" cellpadding="0" border="0" width="600">
                        <tbody><tr>
                            <td width="600" style="min-width:600px;vertical-align:top">
                                <table cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr><td width="600" align="center" style="height:1619px;vertical-align:top">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tbody><tr>
                                                <td width="100%" style="vertical-align:top">
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody><tr>
                                                            <td width="100%" align="center" style="padding-left:24px;padding-right:24px;vertical-align:top" bgcolor="#ffffff">
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody><tr>
                                                                        <td height="24" style="height:24px;min-height:24px;line-height:24px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" style="vertical-align:top">
                                                                            <table cellspacing="0" cellpadding="0" border="0">
                                                                                <tbody><tr>
                                                                                    <td width="196" align="center" style="vertical-align:top"><a href="https://attariclasses.in/" style="text-decoration-line:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://attariclasses.in/&amp;source=gmail&amp;ust=1715157928863000&amp;usg=AOvVaw0buYTiOp8Jw3TUHIZ2NReB"><img src="https://ci4.googleusercontent.com/proxy/MOXN0LjaIvydKx1Rd5WFFz4FZxhoDJ_EQhyUATgx1ZAjsAnmRhiHRCjMvtZStBsKkqOiOlcQtfT7Ad34vQ34bYxUCNZixd9-IlmrWDxKLKPLBZ1zyZRgzEaqXyc5orAOvQ=s0-d-e1-ft#https://plugin.markaimg.com/public/9f9bf90f/efWEjjSX30V1hNCWsM9yIGtML8dlRA.png" width="196" border="0" style="min-width:196px;width:196px;height:auto;display:block" class="gmail_canned_response_image"></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="24" style="height:24px;min-height:24px;line-height:24px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                </tbody></table>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%" style="vertical-align:top">
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody><tr>
                                                            <td width="100%" align="center" style="padding-left:24px;padding-right:24px;vertical-align:top" bgcolor="#ffffff">
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody><tr>
                                                                        <td height="24" style="height:24px;min-height:24px;line-height:24px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="100%" style="vertical-align:top">
                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                <tbody><tr>
                                                                                    <td width="100%" align="center" style="vertical-align:top" bgcolor="#ffffff">
                                                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                                            <tbody><tr>
                                                                                                <td align="center" style="vertical-align:top">
                                                                                                    <div style="line-height:normal;text-align:left"><span style="color:rgb(0,0,0);font-weight:600;font-family:Inter,Arial,sans-serif;font-size:25px;line-height:normal">Hi,</span></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody></table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="24" style="height:24px;min-height:24px;line-height:24px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="100%" style="vertical-align:top">
                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                <tbody><tr>
                                                                                    <td width="100%" align="right" style="vertical-align:top" bgcolor="#ffffff">
                                                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                                            <tbody><tr>
                                                                                                <td width="100%" style="vertical-align:top">
                                                                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                        <tbody><tr>
                                                                                                            <td width="100%" align="center" style="vertical-align:top" bgcolor="#ffffff">
                                                                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                                                                    <tbody><tr>
                                                                                                                        <td align="center" style="vertical-align:top">
                                                                                                                            <div style="text-align:left">
                                                                                                                                <span style="color:#333;font-family:Inter,Arial,sans-serif;font-size:18px;line-height:150%">You\'ve just taken an amazing step towards your learning journey by subscribing to the Attari Classes Newsletter. <br> <br> Thank you for joining our community!

</span>
                                                                                                                            </div>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody></table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody></table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody></table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="30" style="height:35px;min-height:24px;line-height:24px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="100%" style="vertical-align:top">
                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                <tbody><tr>
                                                                                    <td width="100%" align="right" style="vertical-align:top" bgcolor="#ffffff">
                                                                                        <table border="0" cellpadding="0" cellspacing="0">
                                                                                            <tbody><tr>
                                                                                                <td width="600" style="vertical-align:top">
                                                                                                    <table cellspacing="0" cellpadding="0" border="0">
                                                                                                        <tbody><tr>
                                                                                                            <td width="600" align="center" style="vertical-align:top" bgcolor="#ffffff">
                                                                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                                                                    <tbody><tr>
                                                                                                                        <td align="center" style="vertical-align:top">
                                                                                                                            <div style="line-height:normal;text-align:center">
                                                                                                                                <span style="color:#333;font-weight:600;font-family:Inter,Arial,sans-serif;font-size:18px;line-height:normal">For
                                                                                                                                    '.$course.'
                                                                                                                                    Batch
                                                                                                                                    and
                                                                                                                                    Course
                                                                                                                                    details
                                                                                                                                </span>
                                                                                                                            </div>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody></table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody></table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody></table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="24" style="height:24px;min-height:24px;line-height:24px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" style="vertical-align:top">
                                                                            <table cellspacing="0" cellpadding="0" border="0">
                                                                                <tbody><tr>
                                                                                    <td align="center" style="vertical-align:top">
                                                                                        <div>
                                                                                           
                                                                                            <a href="'.$link.'" style="background-color:rgb(54,58,87);border-radius:15px;display:inline-block;color:rgb(255,255,255);font-weight:700;font-family:Arial,Arial,sans-serif;font-size:18px;line-height:45px;width:204px;text-decoration-line:none" target="_blank">Visit
                                                                                                Website</a>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="24" style="height:24px;min-height:24px;line-height:24px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                </tbody></table>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%" style="vertical-align:top">
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody><tr>
                                                            <td width="100%" align="center" style="padding-left:32px;padding-right:32px;vertical-align:top" bgcolor="#ffffff">
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody><tr>
                                                                        <td height="25" style="height:25px;min-height:25px;line-height:25px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="400" align="center" style="vertical-align:top"><a href="'.$link.'" style="text-decoration-line:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://wa.me/917738375431?text%3DHi%252C%2520I%2520am%2520contacting%2520you%2520through%2520your%2520email&amp;source=gmail&amp;ust=1715157928863000&amp;usg=AOvVaw0NM8Yqym5QuVZwr9DFcajJ"><img src="'.$photo.'" width="350" border="0" style="max-width:350px;width:100%;height:auto;display:block" class="gmail_canned_response_image"></a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="25" style="height:25px;min-height:25px;line-height:25px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                </tbody></table>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%" style="vertical-align:top">
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody><tr>
                                                            <td width="100%" align="center" style="padding-left:24px;padding-right:24px;vertical-align:top" bgcolor="#ffffff">
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody><tr>
                                                                        <td height="24" style="height:24px;min-height:24px;line-height:24px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="100%" style="vertical-align:top">
                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                <tbody><tr>
                                                                                    <td width="100%" style="vertical-align:top" bgcolor="#ffffff">
                                                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                                            <tbody><tr>
                                                                                                <td width="100%" style="vertical-align:top">
                                                                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                        <tbody><tr>
                                                                                                            <td width="100%" align="center" style="vertical-align:top" bgcolor="#ffffff">
                                                                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                                                                    <tbody><tr>
                                                                                                                        <td align="center" style="vertical-align:top">
                                                                                                                            <div style="text-align:center">
                                                                                                                                <span style="color:#333;font-weight:600;font-family:Inter,Arial,sans-serif;font-size:18px;line-height:180%">The
                                                                                                                                    first
                                                                                                                                    lecture
                                                                                                                                    will
                                                                                                                                    be
                                                                                                                                    a
                                                                                                                                    Demo
                                                                                                                                    lecture. To
                                                                                                                                    block
                                                                                                                                    your
                                                                                                                                    seat,
                                                                                                                                    Please
                                                                                                                                    call the Support Desk at the number below.</span>
                                                                                                                            </div>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody></table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody></table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody></table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="40" style="height:40px;min-height:40px;line-height:40px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" style="vertical-align:top">
                                                                            <table cellspacing="0" cellpadding="0" border="0">
                                                                                <tbody><tr>
                                                                                    <td align="center" style="vertical-align:top"><a href="tel:%20+917738375431" style="text-decoration-line:none" target="_blank"><img src="https://ci4.googleusercontent.com/proxy/A0iWNm7fqJxmZGeB03DBKTQ3OpmeOx3p86H3LNZvi74gXKc5gUUxeMueXymxUHSVBjT8qgkkJQXeIrxnqFbwviEcsaS5qKyn2QP3nJNZ2P8cjA3wIHKZ7Hcgg5nctCVt4g=s0-d-e1-ft#https://plugin.markaimg.com/public/9f9bf90f/YmfsLeDKMgwMiVHmxjg3mGumapI2YX.png" width="300" border="0" style="border-radius:20px;max-width:300px;width:100%;height:auto;display:block" class="gmail_canned_response_image"></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="24" style="height:24px;min-height:24px;line-height:24px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                </tbody></table>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%" style="vertical-align:top">
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody><tr>
                                                            <td width="100%" align="center" style="height:521px;padding-left:24px;padding-right:24px;vertical-align:top" bgcolor="#ffffff">
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody><tr>
                                                                        <td height="20" style="height:20px;min-height:20px;line-height:20px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="100%" style="vertical-align:top">
                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                <tbody><tr>
                                                                                    <td width="100%" style="vertical-align:top" bgcolor="#ffffff">
                                                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                                            <tbody><tr>
                                                                                                <td width="100%" style="vertical-align:top">
                                                                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                        <tbody><tr>
                                                                                                            <td width="100%" align="center" style="vertical-align:top" bgcolor="#ffffff">
                                                                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                                                                    <tbody><tr>
                                                                                                                        <td align="center" style="vertical-align:top">
                                                                                                                            <div style="text-align:center">
                                                                                                                                <span style="color:#333;font-family:Inter,Arial,sans-serif;font-size:18px;line-height:180%">You
                                                                                                                                    may
                                                                                                                                    also
                                                                                                                                    reach
                                                                                                                                    The
                                                                                                                                    Support
                                                                                                                                    Desk <br>
                                                                                                                                    on
                                                                                                                                </span><span style="color:#333;font-family:Inter,Arial,sans-serif;font-size:18px;line-height:180%">WhatsApp</span><span style="color:#333;font-family:Inter,Arial,sans-serif;font-size:18px;line-height:180%">
                                                                                                                                    by
                                                                                                                                    Clicking
                                                                                                                                    here</span>
                                                                                                                            </div>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody></table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody></table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody></table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="40" style="height:40px;min-height:40px;line-height:40px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" style="vertical-align:top">
                                                                            <table cellspacing="0" cellpadding="0" border="0">
                                                                                <tbody><tr>
                                                                                    <td align="center" style="vertical-align:top"><a href="https://wa.me/917738375431?text=Hi%2C%20I%20am%20contacting%20you%20through%20your%20email" style="text-decoration-line:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://wa.me/917738375431?text%3DHi%252C%2520I%2520am%2520contacting%2520you%2520through%2520your%2520email&amp;source=gmail&amp;ust=1715157928863000&amp;usg=AOvVaw0NM8Yqym5QuVZwr9DFcajJ"><img src="https://ci6.googleusercontent.com/proxy/7LOzLrf_A8QNTznimIvPqcgWDxI3GQ1aGpRENCcJLXdxwpJVGyOt1kMXAMMXlK74K3lX1zyJUSjGi0m6Klc6zoaHThR5uLmMNxEJlF3f6PiUEcXEVa8yxwVNec4JvVrZng=s0-d-e1-ft#https://plugin.markaimg.com/public/9f9bf90f/V994AqLIQ2ZVi16YJ6jqOTxOQGqXQ5.png" width="350" border="0" style="border-radius:20px;max-width:350px;width:100%;height:auto;display:block" class="gmail_canned_response_image"></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="40" style="height:40px;min-height:40px;line-height:40px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="100%" style="vertical-align:top">
                                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                <tbody><tr>
                                                                                    <td width="100%" align="center" style="height:302px;padding-left:32px;padding-right:32px;vertical-align:top" bgcolor="#ffffff">
                                                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                                            <tbody><tr>
                                                                                                <td height="20" style="height:20px;min-height:20px;line-height:20px;vertical-align:top">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td width="100%" align="center" style="vertical-align:top">
                                                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                                                        <tbody><tr>
                                                                                                            <td align="center" style="vertical-align:top">
                                                                                                                <div style="line-height:normal">
                                                                                                                    <span style="color:rgb(0,0,0);font-weight:600;font-family:Inter,Arial,sans-serif;font-size:20px;line-height:normal">Watch
                                                                                                                        Overview
                                                                                                                        of
                                                                                                                        '.$course.'
                                                                                                                        Training
                                                                                                                        at
                                                                                                                        Attari
                                                                                                                        Classes</span>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody></table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td height="40" style="height:40px;min-height:40px;line-height:40px;vertical-align:top">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="center" style="vertical-align:top">
                                                                                                    <table cellspacing="0" cellpadding="0" border="0">
                                                                                                        <tbody><tr>
                                                                                                            <td width="405" align="center" style="vertical-align:top">
                                                                                                                <a href="'.$youtube_url_detail.'" style="text-decoration-line:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://youtu.be/6m_MUXX880w&amp;source=gmail&amp;ust=1715157928863000&amp;usg=AOvVaw22g_E6V2cGyGdpPTKRfmH_">
                                                                                                                    <img src="'.$thumbnail.'" width="405" border="0" style="max-width:405px;width:100%;height:auto;display:block" class="gmail_canned_response_image"></a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody></table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td height="20" style="height:20px;min-height:20px;line-height:20px;vertical-align:top">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody></table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="24" style="height:24px;min-height:24px;line-height:24px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                </tbody></table>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%" style="vertical-align:top">
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody><tr>
                                                            <td width="100%" align="center" style="padding-left:24px;padding-right:24px;vertical-align:top" bgcolor="#ffffff">
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody><tr>
                                                                        <td height="24" style="height:24px;min-height:24px;line-height:24px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center" style="vertical-align:top">
                                                                            <table cellspacing="0" cellpadding="0" border="0">
                                                                                <tbody><tr>
                                                                                    <td style="vertical-align:top">
                                                                                        <table cellspacing="0" cellpadding="0" border="0">
                                                                                            <tbody><tr>
                                                                                                <td style="vertical-align:middle" bgcolor="#ffffff">
                                                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                                                        <tbody><tr>
                                                                                                            <td style="vertical-align:middle" width="32">
                                                                                                                <a href="https://bit.ly/3j4pDPK" style="text-decoration-line:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://bit.ly/3j4pDPK&amp;source=gmail&amp;ust=1715157928864000&amp;usg=AOvVaw2OR4-wZ1Yp44_2lnheReL6">
                                                                                                                    <img src="https://ci3.googleusercontent.com/proxy/QbdbVtVodB4pugqTBhQZYwSuq2o3NGO5OoO4KjGJPqmW0dadBDQZ70Vi4a3eh1dR4sIgPSz8U8hF8XfkkQzSqaqZlh-H_OK3GfyzK9ZUwjVFus_Y-ihii1H1mu-AJlG4ow=s0-d-e1-ft#https://plugin.markaimg.com/public/9f9bf90f/Jq1G9WN2cpUKLChvi9kdVncXoqa7J2.png" width="32" border="0" style="min-width:32px;width:32px;height:auto;display:block" class="gmail_canned_response_image"></a>
                                                                                                            </td>
                                                                                                            <td style="width:24px;min-width:24px;vertical-align:top" width="24">
                                                                                                            </td>
                                                                                                            <td style="vertical-align:middle" width="32">
                                                                                                                <a href="https://instagram.com/attari.classes?igshid=erxn4axxk9uw" style="text-decoration-line:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://instagram.com/attari.classes?igshid%3Derxn4axxk9uw&amp;source=gmail&amp;ust=1715157928864000&amp;usg=AOvVaw2OKoiTugQ9Aw310ZMHP4eM">
                                                                                                                    <img src="https://ci5.googleusercontent.com/proxy/pDC1hfzemIKha_Q6dKZ1icSzqhlcZ-S7p9EK6qgXT4ApvLdp2F09i_0ko-PpSw1kTOR9qPpnkOqpqr3RRfAlUzu4Q4prEzJadJmuazcmidpEjisJCkN9fcKSlPRCFCv5gw=s0-d-e1-ft#https://plugin.markaimg.com/public/9f9bf90f/jJjGqWB9ebAfA8Q4DeD2QlcKN76lxC.png" width="32" border="0" style="min-width:32px;width:32px;height:auto;display:block" class="gmail_canned_response_image"></a>
                                                                                                            </td>
                                                                                                            <td style="width:24px;min-width:24px;vertical-align:top" width="24">
                                                                                                            </td>
                                                                                                            <td style="vertical-align:middle" width="32">
                                                                                                                <a href="https://www.linkedin.com/company/attari-classes-vmware-aws-azure-mcsa-ccna-training-in-mumbai/" style="text-decoration-line:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.linkedin.com/company/attari-classes-vmware-aws-azure-mcsa-ccna-training-in-mumbai/&amp;source=gmail&amp;ust=1715157928864000&amp;usg=AOvVaw0ORozIwINQDWiSN0ikgYyS">
                                                                                                                    <img src="https://ci3.googleusercontent.com/proxy/5j4KpXgUBrvOnXEpxm1h9oexjyBovs-tGckgtIk1RhQglWVLHq1AT3GjoC42KEM8dspP2o2ctAnxmDEIKc92NWQn-hvHNNfANXCaDZr_5a0DtUXm82Sw-C07-BPtMSzuqg=s0-d-e1-ft#https://plugin.markaimg.com/public/9f9bf90f/lFHfIkOEhG2LEeepCtd1fjOnVF0mcy.png" width="32" border="0" style="min-width:32px;width:32px;height:auto;display:block" class="gmail_canned_response_image"></a>
                                                                                                            </td>
                                                                                                            <td style="width:24px;min-width:24px;vertical-align:top" width="24">
                                                                                                            </td>
                                                                                                            <td style="vertical-align:middle" width="32">
                                                                                                                <a href="https://www.youtube.com/c/AttariClasses-IT-Trainings" style="text-decoration-line:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.youtube.com/c/AttariClasses-IT-Trainings&amp;source=gmail&amp;ust=1715157928864000&amp;usg=AOvVaw0H86ClN28d8uMCb2wawEuq">
                                                                                                                    <img src="https://ci4.googleusercontent.com/proxy/3yOjRwKyr4khD7dvIPwW8u-cuh-cablMXZB7OxwOfcdYsA0b1lNIffWCSDSmPXQPwckaHTXPhDSuiI_3cqk8UXlyF6kYyJ6RcqPGmWHQnRr7EMVWvX15H9YC4ZjlOIabpQ=s0-d-e1-ft#https://plugin.markaimg.com/public/9f9bf90f/FrKmUP0cPPTQFUON887hA5KO4oPOMS.png" width="32" border="0" style="min-width:32px;width:32px;height:auto;display:block" class="gmail_canned_response_image"></a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody></table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody></table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="24" style="height:24px;min-height:24px;line-height:24px;vertical-align:top">
                                                                        </td>
                                                                    </tr>
                                                                </tbody></table>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr></tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
        </tbody></table>
    </div>


</div></div></div>';
        
        $replyToEmail = 'info@vmwareclassmumbai.com';
        
        sendEmail_newsleeter($recipient, $subject, $body, $replyToEmail);
        
        $response = [
            'status' => true,
            'notification' => 'NewsLetter Subscribe successfully!',
        ];
    
        return response()->json($response);

    }

//--------------=============================== newsleatter ==========================================-------------------------


//--------------=============================== other feature ====================================---------------------
    /*
    public function search(Request $request){

        $query = $request->input('query');

        $blogs = Blog::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('title', 'like', "%$query%")
                ->orWhere('short_description', 'like', "%$query%")
                ->orWhere('content', 'like', "%$query%");
        })->where('status', 1)->get();
        
        $practiceAreas = PracticeArea::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('title', 'like', "%$query%")
                ->orWhere('short_description', 'like', "%$query%")
                ->orWhere('content', 'like', "%$query%");
        })->where('status', 1)->get();

        return view('frontend.pages.search.index', compact('blogs','practiceAreas'));
    }
    */

    public function comment_save(Request $request)
    {
        $commentData = $request->all();
    
        // Create the contact record
        BlogComment::create($commentData);
    
        $response = [
            'status' => true,
            'notification' => 'Comment added successfully!',
        ];
    
        return response()->json($response);
    }

// =====================--------------- Privacy Policy -------------====================

    public function terms_page(){
        return view('frontend.pages.terms.index');
    }

    public function refund_policy(){
        return view('frontend.pages.refund_policy.index');
    }

// =================--------------------- NEW ---------------------=========================

    public function course_detail($slug){
        $cms = Cms::where('slug', $slug)
            ->where('status', 1)
            ->first();

        if (!$cms) {
            return redirect()->route('error_page');
        }

        $detail = Course::where('id', $cms->course_id)
            ->where('status', 1)
            ->first();

        if (!$detail) {
            return redirect()->route('error_page');
        }

        $cms->menu_title = Cms::where('course_id', $cms->course_id)
            ->where('zone', 0)
            ->value('menu_title');

        $batch = Batch::where('course_id', $cms->course_id)->where('status', 1)->first();
        $text_review = TextReview::where('course_id', $cms->course_id)->where('status', 1)->orderBy('id', 'DESC')->limit(10)->get();
        //$image_review= ImagesReview::where('course_id', $cms->course_id)->where('status', 1)->get();
        $video_review = VideoReview::where('course_id', $cms->course_id)->where('status', 1)->orderBy('id', 'DESC')->limit(8)->get();
        
        $faq = Faq::where('course_id', $cms->course_id)
        ->where('status', 1)
        ->where(function ($query) use ($cms) {
            if ($cms->zone == 1 || $cms->zone == 2) {
                $query->where('zone', 1);
            } else {
                $query->where('zone', 0);
            }
        })
        ->orderBy('title_no', 'ASC')        
        ->get();

        $syllabus = Syllabus::where('course_id', $cms->course_id)->where('status', 1)->orderBy('title_no', 'ASC')->get();
        $project_covered = ProjectCovered::where('course_id', $cms->course_id)->where('status', 1)->orderBy('title_no', 'ASC')->get();
        $certificate = Certificate::where('course_id', $cms->course_id)->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('frontend.pages.courses.index', compact('cms','detail','batch','text_review','video_review','faq','syllabus','project_covered','certificate'));
    }

    public function success_stories(){
        return view('frontend.pages.success_stories.index');
    }

    public function reviews(){
        return view('frontend.pages.reviews.index');
    }

    public function batch(){
        return view('frontend.pages.batch.index');
    }

    public function training_option(){
        return view('frontend.pages.training_option.index');
    }



    public function photo_gallery(){
        return view('frontend.pages.photo_gallery.index');
    }

    public function learning(){
        return view('frontend.pages.learning.index');
    }

    // public function learning_detail($slug){
    //     $learning = Learnings::where('slug', $slug)->where('status', 1)->first();
    //     return view('frontend.pages.learning.detail', compact('learning'));
    // }
    public function learning_detail($slug){
        $learning = Learnings::where('slug', $slug)->where('status', 1)->first();
        $alias = null;
        if ($learning) {
            $course_id = $learning->course_id;
            $course = Course::where('id', $course_id)->first();
            if ($course) {
                $alias = $course->alias;
            }
        }
        return view('frontend.pages.learning.detail', compact('learning', 'alias'));
    }
    
    public function loadSuccessStories(Request $request)
    {
        $images = DB::table('images_reviews')->where("status", 1)->orderBy("date", "desc")->orderBy("id", "desc")->paginate(6); // Fetch 8 images at a time
        return response()->json($images);
    }    

}
