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
            $courses = DB::table('courses')->get()->toArray(); // Convert to array

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
        $apiKey = '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';
        
        // Data to be sent
        $data = array(
            "sender" => array(
                "name" => "Attari Classes",
                "email" => "info@vmwareclassmumbai.com"
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
        $apiKey = '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';
        
        // Data to be sent
        $data = array(
            "sender" => array(
                "name" => "Attari Classes",
                "email" => "info@vmwareclassmumbai.com"
            ),
            "to" => array(
                array(
                    "email" => $to,
                    "name" => "Attari Classes"
                )
            ),
            "bcc" => array(
                array(
                    "email" => "info@vmwareclassmumbai.com",
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