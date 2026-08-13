<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\Course;
use App\Models\MktWatiTemplate;
use App\Models\Wati;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarketingController extends Controller
{

    public function getsyllabusonwhatsapp(Request $request) {
        
        $enquiry_id = $request->enquiry_id;
        $course = trim((string) $request->course);
        $ip_info = ip_info();
        $userIpData = json_decode($ip_info, true);
        $ip = $userIpData['ip'] ?? null;
        
        $source_url = session('source_url') ?? '-';
        $source = session('source') ?? '-';
        
        // If course_name is empty, retrieve the value from pagecourse
        if(empty($course)){
            $course = session('pagecourse');
        }
        $validator = Validator::make($request->all(), [
            'countrycode' => 'required',
            'countryphone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all()
            ], 200);
        }
        
        $countryCode = $request->input('countrycode') ;
        $phoneNumber = $request->input('countryphone') ;
        
        $courseDetails = $this->resolveWatiCourseDetails($course, $countryCode);
        $courseId = $courseDetails['course_id'];
        $template_name = $courseDetails['template_name'];
        $courseModel = $courseDetails['course'];

        if (!$courseId || !$courseModel || empty($template_name)) {
            return response()->json([
                'status' => false,
                'notification' => 'Please select a valid course.',
                'course' => $course,
            ], 422);
        }
        
        $courseNameTechnical = str_replace(" ", "-", (string) $courseModel->alias4);
        $courseSyllabus = $courseModel->curriculum_pdf;
        
        /*store record initially*/
        if(empty($enquiry_id)) {
            $enquiry_id = Wati::insertGetId([
                'name' => $request->name,
                'section' => 'Get Syllabus on WhatsApp - Course Page',
                'url' => $request->url,
                'ref_url' => $request->ref_url,
                
                'source_url' => $source_url,
                'source' => $source,
                
                'medium' => $request->medium ?? '-',
                
                'ip_data' => $ip_info,
                'services' => $course,
                'ip' => $ip,
                'ip_data' => $ip_info,
                'w_countrycode' => $countryCode,
                'w_phone' => $phoneNumber,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }else{
            $syllabus = Wati::where('id', $enquiry_id)
            ->update([
                'w_countrycode' => $countryCode,
                'w_phone' => $phoneNumber,
                'updated_at' => Carbon::now(),
            ]);            
        }        
        
        // Call the sendNotification method using class name
        $response = self::sendNotification($countryCode, $phoneNumber, $template_name);
        
        // Decode the JSON response
        $responseData = json_decode($response, true);
        
        // Check if the message was sent successfully
        if (isset($responseData['result']) && $responseData['result'] === true) {
            // If the message was successfully sent, update the database accordingly
            $w_syllabus = 1;
            $watiresponse = $responseData;
        } else {
            // If the message was not sent successfully, update the database accordingly
            $w_syllabus = 0;
            $watiresponse = $responseData;
        }

        // Update the Wati model
        if ($enquiry_id) {
            $syllabus = Wati::where('id', $enquiry_id)
            ->update([
                'w_syllabus' => $w_syllabus,
                'ip_data' => $ip_info,
                'w_countrycode' => $countryCode,
                'w_phone' => $phoneNumber,
                'wati_response' => json_encode($watiresponse),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Clear the session data
        $request->session()->forget('enquiry_id');
        $request->session()->forget('course_name');

        // Log the response from Wati API
        \Log::info('Wati API Response: ' . $response);

        $response = [
            'status' => true,
            'notification' => 'Syllabus sent on WhatsApp & pdf saved on your device',
            'course' => $courseNameTechnical,
            'course_id' => $courseId,
            'courseSyllabus' => asset('storage/' . $courseSyllabus)
        ];
        
        return response()->json($response);
        
    }     
    // Method to send WhatsApp notification
    /*public static function sendNotification($countryCode, $phoneNumber, $template_name)
    {
        // API endpoint for sending WhatsApp messages
        //$access_token = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJkNzE1Zjg3Yi1lYTJiLTQ1MDYtODhmNC1mZDdkZDUzZWEzMDEiLCJ1bmlxdWVfbmFtZSI6Im1zMTIyNTkyQGdtYWlsLmNvbSIsIm5hbWVpZCI6Im1zMTIyNTkyQGdtYWlsLmNvbSIsImVtYWlsIjoibXMxMjI1OTJAZ21haWwuY29tIiwiYXV0aF90aW1lIjoiMDYvMjYvMjAyMiAxNDowMDoyMiIsImRiX25hbWUiOiI5MzcyIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9yb2xlIjoiQURNSU5JU1RSQVRPUiIsImV4cCI6MjUzNDAyMzAwODAwLCJpc3MiOiJDbGFyZV9BSSIsImF1ZCI6IkNsYXJlX0FJIn0.UNmYti-RXvgn1PSXExv1YJ_Jdj-W61To-ppw8v2fP9Q'; 
        //$api_endpoint = 'live-server-9372.wati.io';
    
        // Generated @ codebeautify.org
        $ch = curl_init();
        
        //curl_setopt($ch, CURLOPT_URL, 'https://live-mt-server.wati.io/9372/api/v1/sendTemplateMessage?whatsappNumber=918433625599');
        curl_setopt($ch, CURLOPT_URL, 'https://live-mt-server.wati.io/9372/api/v1/sendTemplateMessage?whatsappNumber='.$countryCode.$phoneNumber);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, "\n{\n  \"broadcast_name\": \"$template_name\",\n  \"template_name\": \"$template_name\"\n}\n");
        
        $headers = array();
        $headers[] = 'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiI2MDQ2N2VmMC00YzU3LTQ5ZmMtOWIwNy0yYTNjZWQ2OWUzZTUiLCJ1bmlxdWVfbmFtZSI6Im1zMTIyNTkyQGdtYWlsLmNvbSIsIm5hbWVpZCI6Im1zMTIyNTkyQGdtYWlsLmNvbSIsImVtYWlsIjoibXMxMjI1OTJAZ21haWwuY29tIiwiYXV0aF90aW1lIjoiMDUvMTUvMjAyNCAwNzo1MjozOSIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJ0ZW5hbnRfaWQiOiI5MzcyIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9yb2xlIjoiQURNSU5JU1RSQVRPUiIsImV4cCI6MjUzNDAyMzAwODAwLCJpc3MiOiJDbGFyZV9BSSIsImF1ZCI6IkNsYXJlX0FJIn0.q3sSIyuK7EYs6ntcXUn0FopgUsVaBc6i_KWwH-Vri4A';
        $headers[] = 'Content-Type: text/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $response;
    }*/
    
    public function sendNotification($countryCode, $phoneNumber, $template_name) {
        $api_endpoin  = "live-server-9372.wati.io";
        $access_token = "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiI1NTdjY2JhMi0xNzkyLTQwZjktODIxZC1mMWRkMWVhYTE1NzgiLCJ1bmlxdWVfbmFtZSI6Im1zMTIyNTkyQGdtYWlsLmNvbSIsIm5hbWVpZCI6Im1zMTIyNTkyQGdtYWlsLmNvbSIsImVtYWlsIjoibXMxMjI1OTJAZ21haWwuY29tIiwiYXV0aF90aW1lIjoiMDkvMTIvMjAyNCAwNzoyNzozOCIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJ0ZW5hbnRfaWQiOiI5MzcyIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9yb2xlIjoiQURNSU5JU1RSQVRPUiIsImV4cCI6MjUzNDAyMzAwODAwLCJpc3MiOiJDbGFyZV9BSSIsImF1ZCI6IkNsYXJlX0FJIn0.Ng_lb4myixVDJLOBDPkn9NU63CsJkOJDzktew9lS_vI";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          //CURLOPT_URL => 'https://'.$api_endpoin.'/api/v1/sendTemplateMessage?whatsappNumber='.$countryCode.$phoneNumber.'',
          CURLOPT_URL => "https://live-mt-server.wati.io/9372/api/v1/sendTemplateMessage?whatsappNumber=$countryCode$phoneNumber",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'
        {
            "parameters": [],
            "broadcast_name": "'.$template_name.'",
            "template_name":  "'.$template_name.'"
        }
        ',
          CURLOPT_HTTPHEADER => array(
            'Authorization: '.$access_token.'',
            'Content-Type: text/json'
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);     
        return $response;
    }

    private function resolveWatiCourseDetails(string $course, string $countryCode): array
    {
        $cms = Cms::query()
            ->where('status', 1)
            ->where('zone', 0)
            ->where(function ($query) use ($course) {
                $query->where('menu_title', $course);
                    // ->orWhere('menu_title', 'like', $course)
                    // ->orWhere('menu_title', 'like', '%' . $course . '%');
            })
            ->select('course_id', 'menu_title')
            ->first();

        if (!$cms) {
            $cmsCourses = collect(getcmsCourses());

            $cms = $cmsCourses->first(function ($row) use ($course) {
                return isset($row->menu_title) && strcasecmp(trim((string) $row->menu_title), trim($course)) === 0;
            });
        }

        $courseId = $cms->course_id ?? null;

        if (!$courseId) {
            return [
                'course_id' => null,
                'template_name' => null,
                'course' => null,
            ];
        }

        $courseModel = Course::find($courseId);
        $templateName = $this->resolveWatiTemplateName((int) $courseId, $countryCode);

        return [
            'course_id' => (int) $courseId,
            'template_name' => $templateName,
            'course' => $courseModel,
        ];
    }

    private function resolveWatiTemplateName(int $courseId, string $countryCode): ?string
    {
        $template = MktWatiTemplate::where('course_id', $courseId)->first();

        if (!$template) {
            return null;
        }

        $config = $template->config;

        if (is_string($config) && $config !== '') {
            $config = json_decode($config, true);
        }

        if (!is_array($config)) {
            return null;
        }

        $key = $countryCode === '+91' ? 'local' : 'international';
        $value = trim((string) ($config[$key] ?? ''));

        return $value !== '' ? $value : null;
    }     

}