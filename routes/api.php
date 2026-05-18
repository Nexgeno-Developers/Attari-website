<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test-utm', function (\Illuminate\Http\Request $request) {
    dd( url()->previous() );
    return $request->getQueryString() ? $request->url().'?'.$request->getQueryString() : $request->url();
});

Route::get('/test-email', function (\Illuminate\Http\Request $request) {
    //$messageId = sendEmail("rashid.makent@gmail.com", "Test", "Hello world", $replyTo = null);
    if (isset($messageId) && !empty($messageId)) {
        return true;
    }else{
        return false;
    }
});

Route::get('/test', function (Request $request) {
    $countryCode  = "+91";
    $phoneNumber  = "7972440135";
    $api_endpoin  = "live-server-9372.wati.io";
    $template_name = "mcse_plocal";
    $access_token = "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiI2MDQ2N2VmMC00YzU3LTQ5ZmMtOWIwNy0yYTNjZWQ2OWUzZTUiLCJ1bmlxdWVfbmFtZSI6Im1zMTIyNTkyQGdtYWlsLmNvbSIsIm5hbWVpZCI6Im1zMTIyNTkyQGdtYWlsLmNvbSIsImVtYWlsIjoibXMxMjI1OTJAZ21haWwuY29tIiwiYXV0aF90aW1lIjoiMDUvMTUvMjAyNCAwNzo1MjozOSIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJ0ZW5hbnRfaWQiOiI5MzcyIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9yb2xlIjoiQURNSU5JU1RSQVRPUiIsImV4cCI6MjUzNDAyMzAwODAwLCJpc3MiOiJDbGFyZV9BSSIsImF1ZCI6IkNsYXJlX0FJIn0.q3sSIyuK7EYs6ntcXUn0FopgUsVaBc6i_KWwH-Vri4A";
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://'.$api_endpoin.'/api/v1/sendTemplateMessage?whatsappNumber='.$countryCode.$phoneNumber.'',
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
});

Route::get('/test2', function (Request $request) {
    $countryCode  = "+91";
    $phoneNumber  = "7972440135";
    $api_endpoin  = "live-server-9372.wati.io";
    $template_name = "mcse_plocal";
    $access_token = "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiI2MDQ2N2VmMC00YzU3LTQ5ZmMtOWIwNy0yYTNjZWQ2OWUzZTUiLCJ1bmlxdWVfbmFtZSI6Im1zMTIyNTkyQGdtYWlsLmNvbSIsIm5hbWVpZCI6Im1zMTIyNTkyQGdtYWlsLmNvbSIsImVtYWlsIjoibXMxMjI1OTJAZ21haWwuY29tIiwiYXV0aF90aW1lIjoiMDUvMTUvMjAyNCAwNzo1MjozOSIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJ0ZW5hbnRfaWQiOiI5MzcyIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9yb2xlIjoiQURNSU5JU1RSQVRPUiIsImV4cCI6MjUzNDAyMzAwODAwLCJpc3MiOiJDbGFyZV9BSSIsImF1ZCI6IkNsYXJlX0FJIn0.q3sSIyuK7EYs6ntcXUn0FopgUsVaBc6i_KWwH-Vri4A";
    //return 'https://live-mt-server.wati.io/9372/api/v1/sendTemplateMessage?whatsappNumber='.$countryCode.$phoneNumber;
    return 'https://live-mt-server.wati.io/9372/api/v1/sendTemplateMessage?whatsappNumber='.$countryCode.$phoneNumber;
    $ch = curl_init();
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
});

//URL::forceScheme('https');