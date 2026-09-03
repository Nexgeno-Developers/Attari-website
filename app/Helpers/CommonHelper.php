<?php

use Illuminate\Support\Facades\Cache;
//use App\Models\Award;
//use App\Models\Blog;
//use App\Models\BlogCategory;
//use App\Models\BlogComment;
use App\Models\BusinessSetting;
use App\Models\ContactSetting;

use App\Models\Log;
//use App\Models\Contact;
//use App\Models\Faq;
//use App\Models\MediaCoverage;
//use App\Models\PracticeArea;
//use App\Models\Publication;
//use App\Models\Team;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

    if (!function_exists('getcmsCourses')) {
        function getcmsCourses()
        {
            $cmscacheKey = 'cms_courses';
    
            // return Cache::rememberForever($cmscacheKey, function () {
            //     return DB::table('cms')->where('status', 1)->where('zone', 0)->get(['menu_title', 'slug', 'status']);
            // });
    
            return Cache::rememberForever($cmscacheKey, function () {
                $courses = DB::table('cms')
                    ->where('status', 1)
                    ->where('zone', 0)
                    ->get(['course_id', 'menu_title', 'slug', 'status'])
                    ->toArray(); // Convert to array to manipulate indexes
    
                // Initialize indexes
                $index_9 = null;
                $index_11 = null;
    
                // Find indices of course_id 9 and 11
                foreach ($courses as $index => $course) {
                    if ($course->course_id == 9) {
                        $index_9 = $index;
                    }
                    if ($course->course_id == 11) {
                        $index_11 = $index;
                    }
                }
    
                // Swap the two if both exist
                if ($index_9 !== null && $index_11 !== null) {
                    $temp = $courses[$index_9];
                    $courses[$index_9] = $courses[$index_11];
                    $courses[$index_11] = $temp;
                }
    
                return $courses;
            });
        }
    }
    
    if (!function_exists('getCourses')) {
        function getCourses()
        {
            $coursecacheKey = 'courses';
    
            // return Cache::rememberForever($coursecacheKey, function () {
            //     return DB::table('courses')->get();
            // });
    
            return Cache::rememberForever($coursecacheKey, function () {
                $courses = DB::table('courses')
                    ->leftJoin('cms', function ($join) {
                        $join->on('cms.course_id', '=', 'courses.id')
                            ->where('cms.zone', 0);
                    })
                    ->select('courses.*', 'cms.menu_title')
                    ->get()
                    ->toArray(); // Convert to array
    
                // Initialize indexes
                $index_9 = null;
                $index_11 = null;
    
                // Find indices of course_id 9 and 11
                foreach ($courses as $index => $course) {
                    if ($course->id == 9) {
                        $index_9 = $index;
                    }
                    if ($course->id == 11) {
                        $index_11 = $index;
                    }
                }
    
                // Swap the two if both are found
                if ($index_9 !== null && $index_11 !== null) {
                    $temp = $courses[$index_9];
                    $courses[$index_9] = $courses[$index_11];
                    $courses[$index_11] = $temp;
                }
    
                return $courses;
            });
    
        }
    }

    if (!function_exists('datetimeFormatter')) {
        function datetimeFormatter($value)
        {
            return date('d M Y H:iA', strtotime($value));
        }
    }

    //sensSMS function for OTP
    if (!function_exists('get_settings')) {
        function get_settings($type)
        {
            $cacheKey = "business_setting_{$type}";
        
            // Check if the value is already in the cache
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }
        
            // If not in the cache, retrieve the value from the database
            $businessSetting = BusinessSetting::where('type', $type)->first();
        
            if ($businessSetting) {
                $value = $businessSetting->value;
        
                // Store the value in the cache with a specific lifetime (e.g., 60 minutes)
                Cache::put($cacheKey, $value, now()->addMinutes(60));
        
                return $value;
            }
        
            // Handle the case where no record is found
            return null; // or any default value or error handling you prefer
        }
    }

    if (!function_exists('get_contactpage')) {
        function get_contactpage($type)
        {
            $cacheKey = "contact_page_setting_{$type}";
        
            // Check if the value is already in the cache
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }
        
            // If not in the cache, retrieve the value from the database
            $ContactSetting = ContactSetting::where('type', $type)->first();
        
            if ($ContactSetting) {
                $value = $ContactSetting->value;
        
                // Store the value in the cache with a specific lifetime (e.g., 60 minutes)
                Cache::put($cacheKey, $value, now()->addMinutes(60));
        
                return $value;
            }
        
            // Handle the case where no record is found
            return null; // or any default value or error handling you prefer
        }
    }

    /*
    if(!function_exists('sendEmail')){
        function sendEmail($to, $subject, $body, $attachments = [], $replyTo = null)
        {

            
            return \Illuminate\Support\Facades\Mail::raw($body, function ($message) use ($to, $subject, $attachments, $replyTo) {
                $message->to($to)
                //$message->to('khanfaisal.makent@gmail.com')
                        ->subject($subject);
        
                // Attachments
                foreach ($attachments as $attachment) {
                    $message->attach($attachment['path'], ['as' => $attachment['name']]);
                }

                // Reply-To
                if ($replyTo) {
                    $message->replyTo($replyTo);
                }

            });
        }  
    } */


        /*if(!function_exists('sendEmail')){
            function sendEmail($to, $subject, $body, $replyTo = null)
            {
    return \Illuminate\Support\Facades\Mail::raw($body, function ($message) use ($to, $subject, $replyTo) {
        $message->to($to)
                ->subject($subject);
    
        // Reply-To
        if ($replyTo) {
            $message->replyTo($replyTo);
        }
    })->setSwiftOption('stream', [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ]);
            }  
        }*/
        
        
    if(!function_exists('sendEmail')){
        function sendEmail($to, $subject, $body, $replyTo = null)
        {
        // API endpoint
        $url = 'https://api.brevo.com/v3/smtp/email';
        
        // API key
        $apiKey = env('SENDINBLUE_API_KEY');
        
        // Data to be sent
        $data = array(
            "sender" => array(
                "name" => "Attari Classes",
                "email" => "info@attariclasses.in"
            ),
            "to" => array(
                array(
                    "email" => $to,
                    "name" => "Attari Classes"
                )
            ),
            "subject" => $subject,
            "htmlContent" => $body
        );
        
        // Check if a reply-to address is provided
        if ($replyTo) {
            $data['replyTo'] = array(
                "email" => $replyTo,
            );
        }
        
        // Convert data to JSON format
        $postData = json_encode($data);
        
        // Initialize cURL session
        $ch = curl_init($url);
        
        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'accept: application/json',
            'api-key: ' . $apiKey,
            'content-type: application/json'
        ));
        
        // Execute cURL session
        $response = curl_exec($ch);
        
        // Close cURL session
        curl_close($ch);
        
        return $response;
        
            }  
    }
    
    
    
    if(!function_exists('sendEmail_newsleeter')){
        function sendEmail_newsleeter($to, $subject, $body, $replyTo = null)
        {
        // API endpoint
        $url = 'https://api.brevo.com/v3/smtp/email';
        
        // API key
        $apiKey = env('SENDINBLUE_API_KEY');
        
        // Data to be sent
        $data = array(
            "sender" => array(
                "name" => "Attari Classes",
                "email" => "info@attariclasses.in"
            ),
            "to" => array(
                array(
                    "email" => $to,
                    "name" => "Attari Classes"
                )
            ),
            "bcc" => array(
                array(
                    "email" => "info@attariclasses.in",
                    "name" => "Attari Classes"
                )
            ), 
            "subject" => $subject,
            "htmlContent" => $body
        );
        
        // Check if a reply-to address is provided
        if ($replyTo) {
            $data['replyTo'] = array(
                "email" => $replyTo,
            );
        }
        
        // Convert data to JSON format
        $postData = json_encode($data);
        
        // Initialize cURL session
        $ch = curl_init($url);
        
        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'accept: application/json',
            'api-key: ' . $apiKey,
            'content-type: application/json'
        ));
        
        // Execute cURL session
        $response = curl_exec($ch);
        
        // Close cURL session
        curl_close($ch);
        
            }  
    }
    
    
    

    if (!function_exists('SendinBlueContact_lead')) {
        function SendinBlueContact_lead($email)
        {
            // Set your API key
            $api_key = env('SENDINBLUE_API_KEY');
    
            // Set the API endpoint
            $endpoint = 'https://api.sendinblue.com/v3/contacts';
    
            // Set the data to be sent
            $data = [
                'updateEnabled'=> true,
                'email' => $email,
                'listIds' => [14]
            ];
    
            // Initialize cURL session
            $ch = curl_init();
    
            // Set the cURL options
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'api-key: ' . $api_key
            ]);
    
            // Execute the cURL request
            $response = curl_exec($ch);
    
            // Check for errors
            if ($response === false) {
                $error = curl_error($ch);
                $result = 'cURL error: ' . $error;
            } else {
                // Print the response
                $result = $response;
            }
    
            // Close cURL session
            curl_close($ch);
    
            return $result;
        }
    }



    if(!function_exists('ip_info')){
        function ip_info(){
            
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'] ?  $_SERVER['REMOTE_ADDR'] : '';
            }
            $ip = explode(',', $ip);
            $ip = $ip[0];
            //$ip = '103.175.61.38';
            		
            //$info = file_get_contents("http://ipinfo.io/{$ip}/geo");
            
            $curl = curl_init();
            
            curl_setopt($curl, CURLOPT_URL, 'ipinfo.io/'.$ip.'?token='.env('IPINFO_API_TOKEN'));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_ENCODING, '');
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_TIMEOUT, 0);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            
            $info = curl_exec($curl);
            curl_close($curl);
            
            if(!empty($info)){
                return $info; //return in json
            }else{
                $info = '{ "ip": "none", "city": "none", "region": "none", "country": "none", "loc": "none", "postal": "none", "timezone": "none", "readme": "none" }';
                return $info; //return in json
            }
        }
    }

    if(!function_exists('customSlug')){
        function customSlug($value)
        {
            return preg_replace('/[^a-z0-9\/]/i', '-', Str::lower($value));
        }
    }


    if (!function_exists('ReplaceKeyword')) {
        function ReplaceKeyword($sentence, $replaceKeywordJson)
        {

            $replaceKeywords = json_decode($replaceKeywordJson, true);
    
            foreach ($replaceKeywords as $replacementArray) {
                foreach ($replacementArray as $original => $replacement) {
                    //$sentence = str_ireplace($original, $replacement, $sentence);
                    if ($replacement === null) {
                        $replacement = '';
                    }
                    $sentence = str_ireplace($original, $replacement, $sentence);                    
                }
            }

            $paragraph = html_entity_decode($sentence);
    
            return $paragraph;
    
        }
    }

    if (!function_exists('schema_ReplaceKeyword')) {
        function schema_ReplaceKeyword($sentence, $replaceKeywordJson)
        {

            $replaceKeywords = json_decode($replaceKeywordJson, true);
    
            foreach ($replaceKeywords as $replacementArray) {
                foreach ($replacementArray as $original => $replacement) {
                    //$sentence = str_ireplace($original, $replacement, $sentence);
                    if ($replacement === null) {
                        $replacement = '';
                    }
                    $sentence = str_ireplace($original, $replacement, $sentence);                    
                }
            }

            $paragraph = $sentence;
    
            return $paragraph;
    
        }
    }

    if (!function_exists('replace_lms_video_preview_markers')) {
        function replace_lms_video_preview_markers($content)
        {
            if (!is_string($content) || trim($content) === '') {
                return $content;
            }

            $pattern = '#(?:\/\/|\/\*)(?:\s|&nbsp;|<[^>]+>)*\{(?:\s|&nbsp;|<[^>]+>)*v(?:\s|&nbsp;|<[^>]+>)*=(?:\s|&nbsp;|<[^>]+>)*([A-Za-z0-9_-]{6,})(?:\s|&nbsp;|<[^>]+>)*\}(?:\s|&nbsp;|<[^>]+>)*(?:\/\/|\*\/)#i';

            return preg_replace_callback($pattern, static function ($matches) {
                $videoId = trim((string) ($matches[1] ?? ''));
                if ($videoId === '') {
                    return '';
                }

                return ' <a href="javascript:void(0)" class="lms-topic-preview-trigger" data-video-id="' . e($videoId) . '" aria-label="Preview video"><span class="lms-topic-preview-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></span><span class="lms-topic-preview-text">Preview</span></a>';
            }, $content);
        }
    }

    if (!function_exists('sanitize_lms_syllabus_html')) {
        function sanitize_lms_syllabus_html($content)
        {
            if (!is_string($content) || trim($content) === '') {
                return $content;
            }

            $content = html_entity_decode($content);
            $content = preg_replace('/\s+(?:style|class|face)="[^"]*"/i', '', $content);
            $content = preg_replace("/\s+(?:style|class|face)='[^']*'/i", '', $content);
            $content = preg_replace('#</?(?:font|span)\b[^>]*>#i', '', $content);
            $content = preg_replace('#<p>\s*(?:<br\s*/?>|\xc2\xa0|&nbsp;|\s)*</p>#i', '', $content);
            $content = preg_replace('#<li>\s*(?:<br\s*/?>|\xc2\xa0|&nbsp;|\s)*</li>#i', '', $content);
            $content = preg_replace('#<a([^>]*)>\s*</a>#i', '', $content);
            $content = preg_replace('#\s+</li>#i', '</li>', $content);
            $content = preg_replace('#<li>\s+#i', '<li>', $content);
            $content = preg_replace('/(?:\r\n|\r|\n){2,}/', "\n", $content);

            return $content;
        }
    }

    if (!function_exists('strip_lms_video_markers')) {
        function strip_lms_video_markers($content)
        {
            if (!is_string($content) || trim($content) === '') {
                return $content;
            }

            $patterns = [
                '#(?:\/\/|\/\*)(?:\s|&nbsp;|<[^>]+>)*\{(?:\s|&nbsp;|<[^>]+>)*v(?:\s|&nbsp;|<[^>]+>)*=(?:\s|&nbsp;|<[^>]+>)*[A-Za-z0-9_-]{6,}(?:\s|&nbsp;|<[^>]+>)*\}(?:\s|&nbsp;|<[^>]+>)*(?:\/\/|\*\/)#i',
                '#/\*(?:\s|&nbsp;|<[^>]+>)*\{.*?\}(?:\s|&nbsp;|<[^>]+>)*\*/#is',
            ];

            return preg_replace($patterns, '', $content);
        }
    }

    if (!function_exists('render_course_syllabus_content')) {
        function render_course_syllabus_content($sentence, $replaceKeywordJson, $isLmsSyllabus = false)
        {
            $content = ReplaceKeyword($sentence, $replaceKeywordJson);

            if ($isLmsSyllabus) {
                $content = sanitize_lms_syllabus_html($content);
            }

            return replace_lms_video_preview_markers($content);
        }
    }

    if (!function_exists('schema_course_syllabus_description')) {
        function schema_course_syllabus_description($sentence, $replaceKeywordJson)
        {
            $content = schema_ReplaceKeyword($sentence, $replaceKeywordJson);
            $content = strip_lms_video_markers((string) $content);
            $content = html_entity_decode((string) $content);
            $content = trim(preg_replace('/\s+/', ' ', strip_tags($content)));

            return $content;
        }
    }

    if (!function_exists('render_course_syllabus_pdf_content')) {
        function render_course_syllabus_pdf_content($sentence, $replaceKeywordJson, $isLmsSyllabus = false)
        {
            $content = ReplaceKeyword($sentence, $replaceKeywordJson);
            $content = strip_lms_video_markers((string) $content);

            if ($isLmsSyllabus) {
                $content = sanitize_lms_syllabus_html($content);
            }

            return $content;
        }
    }



    if (!function_exists('SendinBlueContact')) {
        function SendinBlueContact($email)
        {
            // Set your API key
            $api_key = env('SENDINBLUE_API_KEY');
    
            // Set the API endpoint
            $endpoint = 'https://api.sendinblue.com/v3/contacts';
    
            // Set the data to be sent
            $data = [
                'updateEnabled'=> true,
                'email' => $email,
                'listIds' => [15]
            ];
    
            // Initialize cURL session
            $ch = curl_init();
    
            // Set the cURL options
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'api-key: ' . $api_key
            ]);
    
            // Execute the cURL request
            $response = curl_exec($ch);
    
            // Check for errors
            if ($response === false) {
                $error = curl_error($ch);
                $result = 'cURL error: ' . $error;
            } else {
                // Print the response
                $result = $response;
            }
    
            // Close cURL session
            curl_close($ch);
    
            return $result;
        }
    }
    
    if (!function_exists('store_log')) {
        function store_log($sentence)
        {
            // Check if the user is authenticated
            if (auth()->check()) {
                $user = auth()->user()->name;
            } else {
                // If user is not authenticated, set the username to 'Guest' or handle it as needed
                $user = 'Guest';
            }
    
            // Create the log entry
            Log::create([
                'remark' => $sentence . ' ' . $user, // Add a space between sentence and username
            ]);
            
            return 1; // Assuming success, you may want to handle errors and return appropriate values
        }
    }

    if (!function_exists('store_audit_log')) {
        function store_audit_log(
            string $remark,
            $previousValue = null,
            $newValue = null,
            ?string $action = null,
            ?string $referenceType = null,
            $referenceId = null
        ) {
            $userName = auth()->check() ? auth()->user()->name : 'Guest';
            $details = [];
            $changedPrevious = [];
            $changedNew = [];

            if (is_array($previousValue) && is_array($newValue)) {
                $labels = [
                    'local' => 'Local',
                    'international' => 'International',
                ];

                foreach ($labels as $key => $label) {
                    $old = (string) ($previousValue[$key] ?? '');
                    $new = (string) ($newValue[$key] ?? '');

                    if ($old !== $new) {
                        $changedPrevious[] = $label . '=' . $old;
                        $changedNew[] = $label . '=' . $new;
                    }
                }
            } else {
                if (is_array($previousValue)) {
                    $changedPrevious[] = 'Local=' . ($previousValue['local'] ?? '');
                    $changedPrevious[] = 'International=' . ($previousValue['international'] ?? '');
                }

                if (is_array($newValue)) {
                    $changedNew[] = 'Local=' . ($newValue['local'] ?? '');
                    $changedNew[] = 'International=' . ($newValue['international'] ?? '');
                }
            }

            if (!empty($changedPrevious)) {
                $details[] = 'Previous: ' . implode(', ', $changedPrevious);
            }

            if (!empty($changedNew)) {
                $details[] = 'New: ' . implode(', ', $changedNew);
            }

            $fullRemark = $remark;

            if (!empty($details)) {
                $fullRemark .= ' | ' . implode(' | ', $details);
            }

            return Log::create([
                'remark' => $fullRemark . ' by ' . $userName,
            ]);
        }
    }

    if (!function_exists('dynamic_email_uploaded_image_relative_path')) {
        function dynamic_email_uploaded_image_relative_path(int $courseId, string $type): ?string
        {
            $prefix = 'dynamic_email/' . $courseId . '-' . $type . '.';

            foreach (Storage::disk('public')->files('dynamic_email') as $file) {
                if (str_starts_with($file, $prefix)) {
                    return $file;
                }
            }

            return null;
        }
    }

    if (!function_exists('dynamic_email_uploaded_image_url')) {
        function dynamic_email_uploaded_image_url(int $courseId, string $type, bool $cacheBust = true): ?string
        {
            $relativePath = dynamic_email_uploaded_image_relative_path($courseId, $type);

            if (!$relativePath) {
                return null;
            }

            $url = asset('storage/' . $relativePath);

            if (!$cacheBust) {
                return $url;
            }

            $absolutePath = storage_path('app/public/' . $relativePath);
            $version = file_exists($absolutePath) ? filemtime($absolutePath) : time();

            return $url . '?v=' . $version;
        }
    }

    if (!function_exists('dynamic_email_uploaded_youtube_image_relative_path')) {
        function dynamic_email_uploaded_youtube_image_relative_path(int $courseId, string $type): ?string
        {
            $prefix = 'dynamic_email/' . $courseId . '-' . $type . '-youtube.';

            foreach (Storage::disk('public')->files('dynamic_email') as $file) {
                if (str_starts_with($file, $prefix)) {
                    return $file;
                }
            }

            return null;
        }
    }

    if (!function_exists('dynamic_email_uploaded_youtube_image_url')) {
        function dynamic_email_uploaded_youtube_image_url(int $courseId, string $type, bool $cacheBust = true): ?string
        {
            $relativePath = dynamic_email_uploaded_youtube_image_relative_path($courseId, $type);

            if (!$relativePath) {
                return null;
            }

            $url = asset('storage/' . $relativePath);

            if (!$cacheBust) {
                return $url;
            }

            $absolutePath = storage_path('app/public/' . $relativePath);
            $version = file_exists($absolutePath) ? filemtime($absolutePath) : time();

            return $url . '?v=' . $version;
        }
    }

    if (!function_exists('dynamic_email_youtube_image_url')) {
        function dynamic_email_youtube_image_url(int $courseId, string $type, bool $cacheBust = true): string
        {
            $uploadedUrl = dynamic_email_uploaded_youtube_image_url($courseId, $type, $cacheBust);

            if (!empty($uploadedUrl)) {
                return $uploadedUrl;
            }

            $extensions = ['png', 'jpg', 'jpeg', 'webp'];

            foreach ($extensions as $extension) {
                $absolutePath = public_path('email-image/' . $courseId . '-' . $type . '.' . $extension);

                if (file_exists($absolutePath)) {
                    $url = asset('email-image/' . $courseId . '-' . $type . '.' . $extension);

                    if ($cacheBust) {
                        $url .= '?v=' . filemtime($absolutePath);
                    }

                    return $url;
                }
            }

            return asset('email-image/attari_logo.png');
        }
    }


    if(!function_exists('send_sms_through_2factor')){
        function send_sms_through_2factor($data){

            $api_key   = env("SMS_2FACTOR_API_KEY");
            $sender    = env("SMS_2FACTOR_CREDENTIAL");
            
            $url = 'https://2factor.in/API/V1/'.$api_key.'/SMS/'.$data['phone'].'/'.$data['otp'].'/'.$data['template'].'?var1='.$data['student_name'];
 

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);	    
                
        }
    }


    if(!function_exists('formatDate')){
        function formatDate($date) {
            // Convert the date to "DDth MONTH" format
            $formatted_date = date('jS F', strtotime($date));
            // Uppercase the month name
            $formatted_date = preg_replace_callback('/(\d{1,2})(st|nd|rd|th) (\w+)/', function($matches) {
                return $matches[1] . $matches[2] . ' ' . strtoupper($matches[3]);
            }, $formatted_date);
            return $formatted_date;
        }
    }

    if(!function_exists('masked_url')){
        function masked_url($data) {
            return Crypt::encryptString($data);
        }   
    }
    
    if(!function_exists('unmasked_url')){
        function unmasked_url($data) {
            return Crypt::decryptString($data);
        }   
    }
    
    function extractWords($title, $numWords = 3) {
        // Split the string into an array of words
        $words = explode(' ', $title);
    
        // Get the specified number of words
        $extractedWords = array_slice($words, 0, $numWords);
    
        // Combine them back into a string
        return implode(' ', $extractedWords);
    } 
    
    if (!function_exists('get_medium')) {
        function get_medium(string $part = 'value')
        {
            $medium = session('medium');

            if (is_array($medium)) {
                if (array_key_exists($part, $medium)) {
                    return $medium[$part];
                }

                return $part === 'key' ? ($medium['value'] ?? null) : ($medium['key'] ?? null);
            }

            return $medium ?: null;
        }
    }

    if (!function_exists('should_store_utm_term_for_medium')) {
        function should_store_utm_term_for_medium($medium): bool
        {
            $mediumValue = '';

            if (is_array($medium)) {
                $mediumValue = trim((string) ($medium['value'] ?? $medium['key'] ?? ''));
            } else {
                $mediumValue = trim((string) $medium);
            }

            $normalizedMedium = strtolower($mediumValue);

            return in_array($mediumValue, [
                'Google Group (GG)',
                'Google Ads Display (GAD)',
                'Google Ads Search (GAS)',
                'Google Ads YouTube (GAY)',
                'Google Ads (GA)',
                'Google (G)',
            ], true) || in_array($normalizedMedium, [
                'google',
                'www.google.com',
            ], true);
        }
    }

    if (!function_exists('is_medium_expired')) {
        function is_medium_expired(): bool
        {
            $expiresAt = session('medium_expires_at');

            if (empty($expiresAt)) {
                return true;
            }

            return time() >= (int) $expiresAt;
        }
    }

    if (!function_exists('marketing_session_ttl_seconds')) {
        function marketing_session_ttl_seconds(): int
        {
            // 2 hours (sliding expiry for medium/source inside the Laravel session lifetime)
            return 2 * 60 * 60;
        }
    }

    if (!function_exists('is_source_expired')) {
        function is_source_expired(): bool
        {
            $expiresAt = session('source_expires_at');

            if (empty($expiresAt)) {
                return true;
            }

            return time() >= (int) $expiresAt;
        }
    }

    if (!function_exists('medium_root_domain_label')) {
        function medium_root_domain_label(?string $host): ?string
        {
            if (empty($host)) {
                return null;
            }

            $host = strtolower($host);
            $parts = explode('.', $host);
            $count = count($parts);

            if ($count === 1) {
                return $parts[0];
            }

            $last = $parts[$count - 1];
            $secondLast = $parts[$count - 2];

            if (strlen($last) === 2 && strlen($secondLast) <= 3 && $count >= 3) {
                return $parts[$count - 3];
            }

            return $parts[$count - 2];
        }
    }

    if (!function_exists('resolve_external_referrer_url')) {
        function resolve_external_referrer_url(?string $referrerUrl, ?string $appUrl = null): ?string
        {
            if (empty($referrerUrl)) {
                return null;
            }

            $referrerHost = parse_url((string) $referrerUrl, PHP_URL_HOST);
            if (empty($referrerHost)) {
                return null;
            }

            $referrerHost = strtolower((string) $referrerHost);
            $referrerHost = preg_replace('/^www\./', '', $referrerHost);

            $appUrl = $appUrl ?: env('APP_URL');
            $appHost = parse_url((string) $appUrl, PHP_URL_HOST);
            if (!empty($appHost)) {
                $appHost = strtolower((string) $appHost);
                $appHost = preg_replace('/^www\./', '', $appHost);
                if ($referrerHost === $appHost) {
                    return null;
                }
            }

            return $referrerUrl;
        }
    }

    // if (!function_exists('resolve_medium_from_request')) {
    //     function resolve_medium_from_request($request): array
    //     {
    //         $currentUrl = strtolower($request->fullUrl());
    //         $referrerUrl = $request->headers->get('referer');
    //         $referrerUrlLower = strtolower((string) $referrerUrl);
    //         $mediumKey = null;
    //         $mediumValue = null;

    //         if (str_contains($currentUrl, 'chatgpt.com') || str_contains($referrerUrlLower, 'chatgpt.com')) {
    //             $mediumKey = 'C';
    //             $mediumValue = 'ChatGPT (C)';
    //         } elseif (str_contains($currentUrl, 'google_group')) {
    //             $mediumKey = 'GG';
    //             $mediumValue = 'Google Group (GG)';
    //         } elseif (str_contains($currentUrl, 'whatsapp_community')) {
    //             $mediumKey = 'WCM';
    //             $mediumValue = 'WhatsApp Community (WCM)';
                
    //         } elseif (
    //             (str_contains($currentUrl, 'gclid') || str_contains($currentUrl, 'gbraid') || str_contains($currentUrl, 'wbraid'))
    //             && (str_contains($currentUrl, 'utm_medium=display') || str_contains($currentUrl, 'display')) || (str_contains($currentUrl, 'safeframe.googlesyndication.com'))
    //         ) {
    //             $mediumKey = 'GAD';
    //             $mediumValue = 'Google Ads Display (GAD)';

    //         } elseif (str_contains($currentUrl, 'syndicatedsearch.goog')) {
    //             $mediumKey = 'GAS';
    //             $mediumValue = 'Google Ads Search (GAS)';

    //         } elseif (str_contains($currentUrl, 'youtube.com')) {
    //             $mediumKey = 'GAY';
    //             $mediumValue = 'Google Ads YouTube (GAY)';
                
    //         } elseif (str_contains($currentUrl, 'gclid') || str_contains($currentUrl, 'gbraid') || str_contains($currentUrl, 'wbraid')) {
    //             $mediumKey = 'GA';
    //             $mediumValue = 'Google Ads (GA)';
    //         } elseif (str_contains($currentUrl, 'linkedin_organic')) {
    //             $mediumKey = 'LO';
    //             $mediumValue = 'Linkedin Organic (LO)';
    //         } elseif (str_contains($currentUrl, 'youtube_organic')) {
    //             $mediumKey = 'YO';
    //             $mediumValue = 'Youtube Organic (YO)';
    //         } elseif (str_contains($currentUrl, 'facebook_organic')) {
    //             $mediumKey = 'FO';
    //             $mediumValue = 'Facebook Organic (FO)';
    //         } elseif (str_contains($currentUrl, 'fb_paid')) {
    //             $mediumKey = 'FA';
    //             $mediumValue = 'Facebook Ads (FA)';
    //         } elseif (str_contains($currentUrl, 'fbclid')) {
    //             $mediumKey = 'FO';
    //             $mediumValue = 'Facebook Organic (FO)';
    //         } elseif (str_contains($currentUrl, 'gmb_organic')) {
    //             $mediumKey = 'GMB';
    //             $mediumValue = 'GMB (GMB)';
    //         } elseif (str_contains($currentUrl, 'wati_mktg')) {
    //             $mediumKey = 'WM';
    //             $mediumValue = 'WATI Mktg (WM)';
    //         } elseif (str_contains($currentUrl, 'wa_channel')) {
    //             $mediumKey = 'WC';
    //             $mediumValue = 'WhatsApp Channel (WC)';
    //         } elseif (str_contains($currentUrl, 'sms_mktg')) {
    //             $mediumKey = 'S';
    //             $mediumValue = 'SMS (S)';
    //         } elseif (str_contains($currentUrl, 'rcs_mktg')) {
    //             $mediumKey = 'R';
    //             $mediumValue = 'RCS (R)';
    //         } elseif (str_contains($currentUrl, 'email_replied')) {
    //             $mediumKey = 'E';
    //             $mediumValue = 'EMAIL (E)';
    //         } elseif (str_contains($currentUrl, 'sbenrolled')) {
    //             $mediumKey = 'EM';
    //             $mediumValue = 'Email Marketing (EM)';
    //         } elseif (str_contains($currentUrl, 'insta_organic')) {
    //             $mediumKey = 'IO';
    //             $mediumValue = 'Instagram Organic (IO)';
    //         } elseif (str_contains($currentUrl, 'blog')) {
    //             $mediumKey = 'B';
    //             $mediumValue = 'blog (B)';
    //         } else {
    //             $appDomain = parse_url(env('APP_URL'), PHP_URL_HOST);
    //             $referrerDomain = parse_url((string) $referrerUrl, PHP_URL_HOST);

    //             if (!empty($referrerDomain)) {
    //                 $referrerDomain = strtolower($referrerDomain);
    //                 $referrerDomain = preg_replace('/^www\./', '', $referrerDomain);

    //                 if (!empty($appDomain) && $referrerDomain === strtolower($appDomain)) {
    //                     $referrerDomain = null;
    //                 }
    //             }

    //             if (!empty($referrerDomain)) {
    //                 $mediumKey = medium_root_domain_label($referrerDomain);
    //                 $mediumValue = $mediumKey;

    //                 // If not Google / AttariClasses, label as other search, but keep key as the domain label.
    //                 if (!empty($mediumKey) && $mediumKey !== 'google' && $mediumKey !== 'attariclasses') {
    //                     $mediumValue = 'Other search (' . $mediumKey . ')';
    //                 }
    //             }
    //         }

    //         if (empty($mediumKey)) {
    //             $mediumKey = 'Direct';
    //             $mediumValue = 'Direct';
    //         }

    //         return [
    //             'key' => $mediumKey,
    //             'value' => $mediumValue,
    //         ];
    //     }
    // }
    
    if (!function_exists('resolve_medium_from_request')) {
        function resolve_medium_from_request($request): array
        {
            $currentUrl = strtolower($request->fullUrl());
            $referrerUrl = $request->headers->get('referer');
            $referrerUrlLower = strtolower((string) $referrerUrl);
            $sourceUrl = strtolower(trim((string) ($request->input('source_url') ?? session('source_url'))));
            $urls = array_values(array_filter([
                $currentUrl,
                $referrerUrlLower,
                $sourceUrl,
            ], static function ($url) {
                return $url !== '';
            }));
            $haystack = implode(' ', $urls);
            $mediumKey = null;
            $mediumValue = null;
            $containsAny = static function (string $subject, array $needles): bool {
                foreach ($needles as $needle) {
                    if ($needle !== '' && str_contains($subject, $needle)) {
                        return true;
                    }
                }

                return false;
            };
            $mediumMarkerMap = [
                'C' => 'ChatGPT (C)',
                'GG' => 'Google Group (GG)',
                'WCM' => 'WhatsApp Community (WCM)',
                'GAD' => 'Google Ads Display (GAD)',
                'GAS' => 'Google Ads Search (GAS)',
                'GAY' => 'Google Ads YouTube (GAY)',
                'GA' => 'Google Ads (GA)',
                'LO' => 'Linkedin Organic (LO)',
                'YO' => 'Youtube Organic (YO)',
                'FO' => 'Facebook Organic (FO)',
                'FA' => 'Facebook Ads (FA)',
                'GMB' => 'GMB (GMB)',
                'WM' => 'WATI Mktg (WM)',
                'WC' => 'WhatsApp Channel (WC)',
                'S' => 'SMS (S)',
                'R' => 'RCS (R)',
                'E' => 'EMAIL (E)',
                'EM' => 'Email Marketing (EM)',
                'IO' => 'Instagram Organic (IO)',
                'B' => 'blog (B)',
                'G' => 'Google (G)',
                'L' => 'LinkedIn (L)',
            ];
            $explicitMediumMarker = static function (array $urlList, array $markerMap): ?array {
                foreach ($urlList as $url) {
                    $query = parse_url($url, PHP_URL_QUERY);

                    if (! is_string($query) || $query === '') {
                        continue;
                    }

                    foreach (explode('&', $query) as $segment) {
                        $segment = trim((string) $segment);

                        if ($segment === '') {
                            continue;
                        }

                        $key = strtoupper(trim(strtok($segment, '=')));

                        if ($key !== '' && isset($markerMap[$key])) {
                            return [
                                'key' => $key,
                                'value' => $markerMap[$key],
                            ];
                        }
                    }
                }

                return null;
            };
            $hasGclid = $containsAny($haystack, ['gclid', 'gbraid', 'wbraid', 'gad']);
            $hasYoutube = str_contains($haystack, 'youtube');
            $hasUtm = str_contains($haystack, 'utm_');

            if ($containsAny($haystack, ['chatgpt.com'])) {
                $mediumKey = 'C';
                $mediumValue = 'ChatGPT (C)';
            } elseif (str_contains($haystack, 'google_group')) {
                $mediumKey = 'GG';
                $mediumValue = 'Google Group (GG)';
            } elseif (str_contains($haystack, 'whatsapp_community')) {
                $mediumKey = 'WCM';
                $mediumValue = 'WhatsApp Community (WCM)';
            // } elseif ($containsAny($haystack, ['safeframe', 'display', 'remarketing'])) {
            } elseif ($containsAny($haystack, ['safeframe', 'display'])) {
                $mediumKey = 'GAD';
                $mediumValue = 'Google Ads Display (GAD)';
            } elseif (str_contains($haystack, 'syndicatedsearch.goog')) {
                $mediumKey = 'GAS';
                $mediumValue = 'Google Ads Search (GAS)';
            } elseif ($hasYoutube && $hasGclid) {
                $mediumKey = 'GAY';
                $mediumValue = 'Google Ads YouTube (GAY)';
            } elseif ($hasGclid) {
                $mediumKey = 'GA';
                $mediumValue = 'Google Ads (GA)';
            } elseif ($hasYoutube) {
                $mediumKey = 'YO';
                $mediumValue = 'Youtube Organic (YO)';
            } elseif (str_contains($haystack, 'blog')) {
                $mediumKey = 'B';
                $mediumValue = 'blog (B)';
            } elseif (str_contains($haystack, 'fbclid') && $hasUtm) {
                $mediumKey = 'FA';
                $mediumValue = 'Facebook Ads (FA)';
            } elseif (str_contains($haystack, 'fbclid')) {
                $mediumKey = 'FO';
                $mediumValue = 'Facebook Organic (FO)';
            } elseif (str_contains($haystack, 'linkedin_organic')) {
                $mediumKey = 'LO';
                $mediumValue = 'Linkedin Organic (LO)';
            } elseif (str_contains($haystack, 'facebook_organic')) {
                $mediumKey = 'FO';
                $mediumValue = 'Facebook Organic (FO)';
            } elseif (str_contains($haystack, 'fb_paid')) {
                $mediumKey = 'FA';
                $mediumValue = 'Facebook Ads (FA)';
            } elseif (str_contains($haystack, 'gmb_organic')) {
                $mediumKey = 'GMB';
                $mediumValue = 'GMB (GMB)';
            } elseif (str_contains($haystack, 'wati_mktg')) {
                $mediumKey = 'WM';
                $mediumValue = 'WATI Mktg (WM)';
            } elseif (str_contains($haystack, 'wa_channel')) {
                $mediumKey = 'WC';
                $mediumValue = 'WhatsApp Channel (WC)';
            } elseif (str_contains($haystack, 'sms_mktg')) {
                $mediumKey = 'S';
                $mediumValue = 'SMS (S)';
            } elseif (str_contains($haystack, 'rcs_mktg')) {
                $mediumKey = 'R';
                $mediumValue = 'RCS (R)';
            } elseif (str_contains($haystack, 'email_replied')) {
                $mediumKey = 'E';
                $mediumValue = 'EMAIL (E)';
            } elseif (str_contains($haystack, 'sbenrolled')) {
                $mediumKey = 'EM';
                $mediumValue = 'Email Marketing (EM)';
            } elseif (str_contains($haystack, 'insta_organic')) {
                $mediumKey = 'IO';
                $mediumValue = 'Instagram Organic (IO)';
            } elseif (str_contains($haystack, 'utm_source=google')) {
                $mediumKey = 'G';
                $mediumValue = 'Google (G)';
            } elseif (str_contains($haystack, 'utm_source=linkedin')) {
                $mediumKey = 'L';
                $mediumValue = 'LinkedIn (L)';
            } elseif (($explicitMarker = $explicitMediumMarker($urls, $mediumMarkerMap)) !== null) {
                $mediumKey = $explicitMarker['key'];
                $mediumValue = $explicitMarker['value'];
            } else {
                $appDomain = parse_url(env('APP_URL'), PHP_URL_HOST);
                $referrerDomain = parse_url((string) $referrerUrl, PHP_URL_HOST);

                if (!empty($referrerDomain)) {
                    $referrerDomain = strtolower($referrerDomain);
                    $referrerDomain = preg_replace('/^www\./', '', $referrerDomain);

                    if (!empty($appDomain) && $referrerDomain === strtolower($appDomain)) {
                        $referrerDomain = null;
                    }
                }

                if (!empty($referrerDomain)) {
                    $mediumKey = medium_root_domain_label($referrerDomain);
                    $mediumValue = $mediumKey;

                    // If not Google / AttariClasses, label as other search, but keep key as the domain label.
                    if (!empty($mediumKey) && $mediumKey !== 'google' && $mediumKey !== 'attariclasses') {
                        $mediumValue = 'Other search (' . $mediumKey . ')';
                    }
                }
            }

            if (empty($mediumKey)) {
                $mediumKey = 'Direct';
                $mediumValue = 'Direct';
            }

            return [
                'key' => $mediumKey,
                'value' => $mediumValue,
            ];
        }
    }

    if (!function_exists('resolve_medium_from_url_old_data')) {
        function resolve_medium_from_url_old_data(?string $currentUrl, ?string $referrerUrl = null, ?string $sourceUrl = null): array
        {
            $urls = [
                strtolower(trim((string) $currentUrl)),
                strtolower(trim((string) $referrerUrl)),
                strtolower(trim((string) $sourceUrl)),
            ];

            $urls = array_values(array_filter($urls, static function ($url) {
                return $url !== '';
            }));

            $haystack = implode(' ', $urls);
            $mediumKey = null;
            $mediumValue = null;

            $containsAny = static function (string $subject, array $needles): bool {
                foreach ($needles as $needle) {
                    if ($needle !== '' && str_contains($subject, $needle)) {
                        return true;
                    }
                }

                return false;
            };

            $hasGclid = $containsAny($haystack, ['gclid', 'gbraid', 'wbraid', 'gad']);
            $hasYoutube = str_contains($haystack, 'youtube');
            $hasUtm = str_contains($haystack, 'utm_');

            if ($containsAny($haystack, ['chatgpt.com'])) {
                $mediumKey = 'C';
                $mediumValue = 'ChatGPT (C)';
            } elseif (str_contains($haystack, 'google_group')) {
                $mediumKey = 'GG';
                $mediumValue = 'Google Group (GG)';
            } elseif (str_contains($haystack, 'whatsapp_community')) {
                $mediumKey = 'WCM';
                $mediumValue = 'WhatsApp Community (WCM)';
            // } elseif ($containsAny($haystack, ['safeframe', 'display', 'remarketing'])) {
            } elseif ($containsAny($haystack, ['safeframe', 'display'])) {
                $mediumKey = 'GAD';
                $mediumValue = 'Google Ads Display (GAD)';
            } elseif (str_contains($haystack, 'syndicatedsearch.goog')) {
                $mediumKey = 'GAS';
                $mediumValue = 'Google Ads Search (GAS)';
            } elseif ($hasYoutube && $hasGclid) {
                $mediumKey = 'GAY';
                $mediumValue = 'Google Ads YouTube (GAY)';
            } elseif ($hasGclid) {
                $mediumKey = 'GA';
                $mediumValue = 'Google Ads (GA)';
            } elseif ($hasYoutube) {
                $mediumKey = 'YO';
                $mediumValue = 'Youtube Organic (YO)';

            } elseif (str_contains($haystack, 'fbclid') && $hasUtm) {
                $mediumKey = 'FA';
                $mediumValue = 'Facebook Ads (FA)';
            } elseif (str_contains($haystack, 'fbclid')) {
                $mediumKey = 'FO';
                $mediumValue = 'Facebook Organic (FO)';

            } elseif (str_contains($haystack, 'linkedin_organic')) {
                $mediumKey = 'LO';
                $mediumValue = 'Linkedin Organic (LO)';
            } elseif (str_contains($haystack, 'facebook_organic')) {
                $mediumKey = 'FO';
                $mediumValue = 'Facebook Organic (FO)';

            } elseif (str_contains($haystack, 'fb_paid')) {
                $mediumKey = 'FA';
                $mediumValue = 'Facebook Ads (FA)';

            } elseif (str_contains($haystack, 'gmb_organic')) {
                $mediumKey = 'GMB';
                $mediumValue = 'GMB (GMB)';
            } elseif (str_contains($haystack, 'wati_mktg')) {
                $mediumKey = 'WM';
                $mediumValue = 'WATI Mktg (WM)';
            } elseif (str_contains($haystack, 'wa_channel')) {
                $mediumKey = 'WC';
                $mediumValue = 'WhatsApp Channel (WC)';
            } elseif (str_contains($haystack, 'sms_mktg')) {
                $mediumKey = 'S';
                $mediumValue = 'SMS (S)';
            } elseif (str_contains($haystack, 'rcs_mktg')) {
                $mediumKey = 'R';
                $mediumValue = 'RCS (R)';
            } elseif (str_contains($haystack, 'email_replied')) {
                $mediumKey = 'E';
                $mediumValue = 'EMAIL (E)';
            } elseif (str_contains($haystack, 'sbenrolled')) {
                $mediumKey = 'EM';
                $mediumValue = 'Email Marketing (EM)';
            } elseif (str_contains($haystack, 'insta_organic')) {
                $mediumKey = 'IO';
                $mediumValue = 'Instagram Organic (IO)';

            } elseif (str_contains($haystack, 'utm_source=google') || str_contains($haystack, 'google.com')) {
                $mediumKey = 'G';
                $mediumValue = 'Google (G)';

            } elseif (str_contains($haystack, 'utm_source=linkedin')) {
                $mediumKey = 'L';
                $mediumValue = 'LinkedIn (L)';

            } elseif (str_contains($haystack, 'bing.com')) {
                $mediumKey = 'OS';
                $mediumValue = 'Other Search (bing)';

            } elseif (str_contains($haystack, 'android-app://com.google.android.googlequicksearchbox') || str_contains($haystack, 'android-app://com.linkedin.android')) {
                $mediumKey = 'OS';
                $mediumValue = 'Other Search (Android App)';

            } elseif (str_contains($haystack, 'blog')) {
                $mediumKey = 'B';
                $mediumValue = 'blog (B)';

            } else {
                $appDomain = parse_url(env('APP_URL'), PHP_URL_HOST);

                foreach ($urls as $url) {
                    $domain = parse_url((string) $url, PHP_URL_HOST);

                    if (empty($domain)) {
                        continue;
                    }

                    $domain = strtolower((string) $domain);
                    $domain = preg_replace('/^www\./', '', $domain);

                    if (!empty($appDomain) && $domain === strtolower($appDomain)) {
                        continue;
                    }

                    $mediumKey = medium_root_domain_label($domain);
                    $mediumValue = $mediumKey;

                    if (!empty($mediumKey) && $mediumKey !== 'google' && $mediumKey !== 'attariclasses') {
                        $mediumValue = 'Other search (' . $mediumKey . ')';
                    }

                    break;
                }
            }

            if (empty($mediumKey)) {
                $mediumKey = 'Direct';
                $mediumValue = 'Direct';
            }


            return [
                'key' => $mediumKey,
                'value' => $mediumValue,
            ];
        }
    }

    if (!function_exists('resolve_medium_from_request_old_data')) {
        function resolve_medium_from_request_old_data($request): array
        {
            return resolve_medium_from_url_old_data(
                method_exists($request, 'fullUrl') ? $request->fullUrl() : null,
                $request->headers->get('referer'),
                null
            );
        }
    }

    if (!function_exists('ensure_marketing_tracking')) {
        function ensure_marketing_tracking($request): array
        {
            $referrerUrl = $request->headers->get('referer');
            $currentUrl = $request->fullUrl();
            $postedSourceUrl = trim((string) $request->input('source_url'));
            $extractUtmTerm = static function ($url): ?string {
                $url = trim((string) $url);

                if ($url === '' || $url === '-') {
                    return null;
                }

                $query = parse_url($url, PHP_URL_QUERY);

                if (! is_string($query) || $query === '') {
                    return null;
                }

                parse_str($query, $parameters);
                $value = $parameters['utm_term'] ?? null;

                return is_scalar($value) && trim((string) $value) !== ''
                    ? trim((string) $value)
                    : null;
            };

            $mediumExpired = is_medium_expired();
            $sourceExpired = is_source_expired();

            $existingMedium = session('medium');
            $resolvedMedium = resolve_medium_from_request($request);

            $existingKey = null;
            if (is_array($existingMedium)) {
                $existingKey = $existingMedium['key'] ?? null;
            } elseif (is_string($existingMedium)) {
                $existingKey = $existingMedium;
            }

            // Special case: if we previously stored Direct but now can resolve a non-Direct medium, upgrade it.
            if (empty($existingMedium) || $mediumExpired || (($existingKey === 'Direct' || $existingKey === null) && ($resolvedMedium['key'] ?? 'Direct') !== 'Direct')) {
                session(['medium' => $resolvedMedium]);
                $medium = $resolvedMedium;
            } else {
                $medium = $existingMedium;
            }

            // Sliding expiry for medium
            session(['medium_expires_at' => time() + marketing_session_ttl_seconds()]);

            // Source URL + Source (same sliding expiry pattern)
            if ($sourceExpired) {
                Session::forget(['source_url', 'source', 'utm_term', 'source_expires_at']);
            }

            $hasSourceUrl = (bool) session('source_url');
            $hasSource = (bool) session('source');

            if (!$hasSourceUrl || !$hasSource) {
                $candidateUrls = [
                    $referrerUrl,
                    $postedSourceUrl !== '-' ? $postedSourceUrl : null,
                    $currentUrl,
                ];

                $resolvedSourceUrl = null;
                $source = 'Direct';
                $utmTerm = null;

                foreach ($candidateUrls as $candidateUrl) {
                    $candidateUrl = trim((string) $candidateUrl);

                    if ($candidateUrl === '' || $candidateUrl === '-') {
                        continue;
                    }

                    $externalCandidateUrl = resolve_external_referrer_url($candidateUrl, env('APP_URL'));

                    if (empty($externalCandidateUrl)) {
                        continue;
                    }

                    $domain = parse_url((string) $externalCandidateUrl, PHP_URL_HOST);
                    $domain = !empty($domain) ? strtolower((string) $domain) : null;
                    $domain = !empty($domain) ? preg_replace('/^www\./', '', $domain) : null;

                    if (empty($domain)) {
                        continue;
                    }

                    $label = medium_root_domain_label($domain);
                    $resolvedSourceUrl = $externalCandidateUrl;
                    $source = (!empty($label) && $label !== '-') ? $label : 'Direct';
                    $utmTerm = $extractUtmTerm($candidateUrl);
                    break;
                }

                if ($utmTerm === null) {
                    foreach ($candidateUrls as $candidateUrl) {
                        $utmTerm = $extractUtmTerm($candidateUrl);

                        if ($utmTerm !== null) {
                            break;
                        }
                    }
                }

                $utmTermToStore = should_store_utm_term_for_medium($medium ?? $resolvedMedium)
                    ? ($utmTerm ?: '-')
                    : '-';

                session([
                    'source_url' => $resolvedSourceUrl ?: '-',
                    'source' => $source !== '-' ? $source : 'Direct',
                    'utm_term' => $utmTermToStore,
                    'source_expires_at' => time() + marketing_session_ttl_seconds(),
                ]);
            } elseif (session('source') === '-' || session('source') === '' || session('source') === null) {
                session(['source' => 'Direct']);
            }

            if (! should_store_utm_term_for_medium($medium ?? $resolvedMedium)) {
                session(['utm_term' => '-']);
            } elseif (session('utm_term') === '' || session('utm_term') === null || session('utm_term') === '-') {
                $fallbackUtmTerm = $extractUtmTerm($referrerUrl)
                    ?? $extractUtmTerm($postedSourceUrl)
                    ?? $extractUtmTerm($currentUrl)
                    ?? '-';

                session(['utm_term' => $fallbackUtmTerm]);
            }

            // Refresh expiry for active users who already have a source
            if (session('source_url') && session('source')) {
                session(['source_expires_at' => time() + marketing_session_ttl_seconds()]);
            }

            return [
                'medium' => session('medium'),
                'source_url' => session('source_url'),
                'source' => session('source'),
                'utm_term' => session('utm_term'),
                'referrerUrl' => $referrerUrl,
            ];
        }
    }

if (!function_exists('lms_api_parse_response')) {
    function lms_api_parse_response($responseBody, int $statusCode)
    {
        $decoded = json_decode($responseBody, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $errorMessage = 'Invalid LMS API response';
            if ($statusCode > 0) {
                $errorMessage = 'LMS API returned HTTP ' . $statusCode . ' with a non-JSON response';
            }

            return [
                'success' => false,
                'status' => $statusCode,
                'error' => $errorMessage,
                'raw' => $responseBody,
            ];
        }

        return [
            'success' => ($statusCode >= 200 && $statusCode < 300) && !empty($decoded['success']),
            'status' => $statusCode,
            'data' => $decoded['data'] ?? [],
            'error' => $decoded['error'] ?? null,
            'response' => $decoded,
        ];
    }
}

if (!function_exists('lms_api_is_cloudflare_challenge')) {
    function lms_api_is_cloudflare_challenge($responseBody, int $statusCode): bool
    {
        if ($statusCode !== 403 || !is_string($responseBody) || $responseBody === '') {
            return false;
        }

        $body = strtolower($responseBody);

        return str_contains($body, 'just a moment')
            || str_contains($body, 'challenges.cloudflare.com')
            || str_contains($body, 'enable javascript and cookies to continue');
    }
}

if (!function_exists('lms_api_use_system_curl_fallback')) {
    function lms_api_use_system_curl_fallback(): bool
    {
        $configured = env('LMS_API_USE_SYSTEM_CURL');
        if ($configured !== null) {
            return filter_var($configured, FILTER_VALIDATE_BOOLEAN);
        }

        return PHP_OS_FAMILY === 'Windows' && app()->environment('local');
    }
}

if (!function_exists('lms_api_request_via_system_curl')) {
    function lms_api_request_via_system_curl(string $url, string $token, string $origin, int $timeout): array
    {
        $commandParts = [
            'curl.exe',
            '-sS',
            '-L',
            '--max-time',
            (string) $timeout,
            '-A',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',
            '-H',
            'Accept: application/json,text/plain,*/*',
            '-H',
            'Accept-Language: en-US,en;q=0.9',
            '-H',
            'Cache-Control: no-cache',
            '-H',
            'Pragma: no-cache',
            '-H',
            'Authorization: ' . $token,
            '-H',
            'Origin: ' . $origin,
            '-H',
            'Referer: ' . rtrim($origin, '/') . '/',
            $url,
            '-w',
            '\n__LMS_HTTP_CODE__:%{http_code}',
        ];

        $escapedCommand = implode(' ', array_map('escapeshellarg', $commandParts)) . ' 2>&1';
        $output = shell_exec($escapedCommand);

        if (!is_string($output) || trim($output) === '') {
            return [
                'success' => false,
                'status' => 0,
                'error' => 'System curl fallback returned an empty response'
            ];
        }

        if (!preg_match('/__LMS_HTTP_CODE__:(\\d{3})\\s*$/', $output, $matches)) {
            $responseBody = preg_replace('/\\R__LMS_HTTP_CODE__:\s*\{http_code\}\s*$/', '', $output);
            $fallbackResponse = lms_api_parse_response(trim($responseBody), 200);

            if (array_key_exists('response', $fallbackResponse)) {
                return $fallbackResponse;
            }

            return [
                'success' => false,
                'status' => 0,
                'error' => 'Unable to detect LMS API status from system curl fallback',
                'raw' => $output,
            ];
        }

        $statusCode = (int) $matches[1];
        $responseBody = preg_replace('/\\n__LMS_HTTP_CODE__:\\d{3}\\s*$/', '', $output);

        return lms_api_parse_response($responseBody, $statusCode);
    }
}

if (!function_exists('lms_api_request')) {
    function lms_api_request(string $endpoint, array $query = [])
    {
        $baseUrl = rtrim((string) env('LMS_API_BASE_URL', 'https://lms.attariclasses.in'), '/');
        $token = trim((string) env('LMS_API_TOKEN', ''));
        $origin = trim((string) env('LMS_API_ORIGIN', config('app.url')));
        $timeout = (int) env('LMS_API_TIMEOUT', 20);

        if ($baseUrl === '' || $token === '') {
            return [
                'success' => false,
                'status' => 500,
                'error' => 'LMS API configuration is missing'
            ];
        }

        $url = $baseUrl . '/api/' . ltrim($endpoint, '/');
        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_HTTPGET => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => '',
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',
            CURLOPT_HTTPHEADER => [
                'Accept: application/json,text/plain,*/*',
                'Accept-Language: en-US,en;q=0.9',
                'Cache-Control: no-cache',
                'Pragma: no-cache',
                'Authorization: ' . $token,
                'Origin: ' . $origin,
                'Referer: ' . rtrim($origin, '/') . '/',
            ],
        ]);

        $responseBody = curl_exec($ch);
        $curlError = curl_error($ch);
        $statusCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($responseBody === false) {
            return [
                'success' => false,
                'status' => 0,
                'error' => $curlError !== '' ? $curlError : 'Unable to connect to LMS API'
            ];
        }

        if (lms_api_is_cloudflare_challenge($responseBody, $statusCode) && lms_api_use_system_curl_fallback()) {
            return lms_api_request_via_system_curl($url, $token, $origin, $timeout);
        }

        return lms_api_parse_response($responseBody, $statusCode);
    }
}

if (!function_exists('lms_publish_courses_api')) {
    function lms_publish_courses_api()
    {
        $cacheKey = 'lms_publish_courses_api_response';

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $response = lms_api_request('lms_publish_course');

        if (!empty($response['success'])) {
            Cache::put($cacheKey, $response, now()->addDay());
        }

        return $response;
    }
}

if (!function_exists('lms_topics_by_course_id_api')) {
    function lms_topics_by_course_id_api(int $courseId)
    {
        if ($courseId <= 0) {
            return [
                'success' => false,
                'status' => 422,
                'error' => 'Valid course ID is required'
            ];
        }

        return lms_api_request('lms_topic_as_course_id', [
            'course_id' => $courseId,
        ]);
    }
}




