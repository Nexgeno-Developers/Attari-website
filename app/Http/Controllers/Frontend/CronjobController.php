<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Wati;
use App\Models\Contact;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CronjobController extends Controller
{

     public function get_unsent_email_enquiry()
    {
        // Retrieve all contacts where email_sent is 0
        $contacts = Contact::where('email_sent', 0)->get()->all(); //->where('email', '!=', null)
        //var_dump($contacts);
        //exit();

        foreach ($contacts as $contact) {
            try {
                
                $enquiryDate = $contact->created_at; //2024-05-21 12:30:05
                $newTimestamp = strtotime($enquiryDate . ' +2 minutes');
                $checkableEnquiryDate = date('Y-m-d H:i:s', $newTimestamp);                
                $currentDate = date('Y-m-d H:i:s');     
                 echo '<br>';
                 echo $checkableEnquiryDate;
                 echo '<br>';
                 echo $currentDate;
                 echo '<br>';
                if($checkableEnquiryDate < $currentDate) {
                echo "True ".$contact->id;

                
                // Prepare email data
                $name = $contact->name ?? '';
                $email = $contact->email ?? '';
                $phone = $contact->phone ?? '';
                $services = $contact->services ?? '';
                $description = $contact->description ?? '';
                $country = $contact->country ?? '';
                $url = $contact->url ?? '';
                $section = $contact->section ?? '';
                $cvPath = $contact->cv ?? '';
                $ip = $contact->ip ?? '';
                $ref_url = $contact->ref_url ?? '';
                
                $source_url = $contact->source_url ?? '-';
                $source = $contact->source ?? '-';
                $utm_term = $contact->utm_term ?? '-';
                $honeypotValue = trim((string) ($contact->honeypot_value ?? ''));
                
                $w_countrycode = $contact->w_countrycode ?? '';
                $w_phone = $contact->w_phone ?? '';
                $w_syllabus = ($contact->w_syllabus == 1) ? "Sent" : "Failed";
                $submitted_date = isset($contact->created_at) ? $contact->created_at->format('Y-m-d H:iA') : '';
                $user_data = json_decode($contact->ip_data, true) ?? [];
                
                 // Determine email subject
                if (!empty($email)) {
                    $subject = ($services ?? ' - '). " Course Enquiry";
                }else {
                    $subject = "WhatsApp Enquiry - " . ($services ?? ' - ');
                }


                        $body = '<table>';
                        

                        //name
                        if (!empty($name)) {
                        $body .= '<tr><td style="width: 150px;"><strong>Full Name :</strong></td><td>' . $name . '</td></tr>' . "\n";
                        }                         
                        
                        //email
                        if (!empty($email)) {
                        $body .= '<tr><td style="width: 150px;"><strong>Email Address :</strong></td><td>' . $email . '</td></tr>' . "\n";
                        } 
                        
                        //course requested
                        if (!empty($services)) {
                            $body .= '<tr><td style="width: 150px;"><strong>Course Requested :</strong></td><td>' . ($services ?? 'Not provided') . '</td></tr>' . "\n";
                        }  
                        
                        //message
                        if (!empty($description)) {
                            $body .= '<tr><td style="width: 150px;"><strong>Message :</strong></td><td>' . ($description ?? 'Not provided') . '</td></tr>' . "\n\n";
                        }                        
                        
                        //phone
                        if (!empty($phone)) {
                        $body .= '<tr><td style="width: 150px;"><strong>Phone Number :</strong></td><td>' . $phone . '</td></tr>' . "\n";
                        }
                        
                        //whatsapp country
                        if (!empty($w_countrycode)) {
                                $body .= '<tr><td style="width: 200px;"><strong style="color: #b3261e;" >WhatsApp Country Code :</strong></td><td>' . $w_countrycode . '</td></tr>';
                        }  
                        
                        //whatsapp phone
                        if (!empty($w_phone)) {
                            $body .= '<tr><td style="width: 150px;"><strong style="color: #b3261e;" >WhatsApp Phone :</strong></td><td>' . $w_phone . '</td></tr>';
                        } 
                        
                        //whatsapp phone
                        if (!empty($w_phone) && !empty($w_syllabus) && !empty($w_countrycode)) {
                            $body .= '<tr><td style="width: 150px;"><strong style="color: #b3261e;" >Syllabus :</strong></td><td>' . $w_syllabus . '</td></tr>';
                        } 
                        
                        $body .= '</table>';
                        
                        //*********
                        $body .= '<p style="margin: 10px 0px">******************************************************************</p>';
                        
                        $body .= '<table>';
                        
                        //country
                        if (!empty($country)) {
                        $body .= '<tr><td style="width: 150px;"><strong>Country :</strong></td><td>' . $country . '</td></tr>' . "\n";
                        } 
                        
                        //user location
                        /*$body .= '<tr><td style="width: 150px;"><strong>User Location :</strong></td><td>' . 
                                ($user_data['city'] ? $user_data['city'].',' : 'none') . ' ' . 
                                ($user_data['region'] ? $user_data['region'].',' : 'none') . ' ' . 
                                ($user_data['country'] ?? 'none') . 
                            '</td></tr>' . "\n";*/  

                        if (isset($user_data['city']) && isset($user_data['region']) && isset($user_data['country'])) {
                            $body .= '<tr><td style="width: 150px;"><strong>User Location :</strong></td><td>' . 
                                    ($user_data['city'] ? $user_data['city'].',' : 'none') . ' ' . 
                                    ($user_data['region'] ? $user_data['region'].',' : 'none') . ' ' . 
                                    ($user_data['country'] ?? 'none') . 
                                '</td></tr>' . "\n";  
                        }  
                            
                        $body .= '</table>';    
                            
                        //*********
                        $body .= '<p style="margin: 10px 0px">******************************************************************</p>'; 
                        
                        $body .= '<table>';
                        
                        //form name
                        if (!empty($section)) {
                        $body .= '<tr><td style="width: 150px;"><strong>Form Name :</strong></td><td>' . $section . '</td></tr>' . "\n";
                        }   
                        
                        //url
                        if (!empty($url)) {
                        $body .= '<tr><td style="width: 150px;"><strong>Page URL :</strong></td><td>' . $url . '</td></tr>' . "\n\n";
                        }
                        
                        //ref url
                        if (!empty($ref_url)) {
                        $body .= '<tr><td style="width: 150px;"><strong>Referrer URL :</strong></td><td>' . $ref_url . '</td></tr>' . "\n";
                        }
                        
                        //source url
                        if (!empty($source_url)) {
                        $body .= '<tr><td style="width: 150px;"><strong>Source URL :</strong></td><td>' . $source_url . '</td></tr>' . "\n";
                        } 

                        // //source
                        // if (!empty($source)) {
                        // $body .= '<tr><td style="width: 150px;"><strong>Source :</strong></td><td>' . $source . '</td></tr>' . "\n";
                        // } 

                        //medium
                        if (!empty($contact->medium)) {
                        $body .= '<tr><td style="width: 150px;"><strong>Medium :</strong></td><td>' . $contact->medium . '</td></tr>' . "\n";
                        }

                        if (!empty($utm_term) && $utm_term !== '-') {
                        $body .= '<tr><td style="width: 150px;"><strong>Search term :</strong></td><td>' . $utm_term . '</td></tr>' . "\n";
                        }

                        if ($honeypotValue !== '') {
                            $body .= '<tr>';
                            $body .= '<td style="width: 150px; background: #b3261e; color: #ffffff; padding: 8px;"><strong>Bot :</strong></td>';
                            $body .= '<td style="background: #fde8e8; color: #b3261e; padding: 8px;">' . e($honeypotValue) . '</td>';
                            $body .= '</tr>' . "\n";
                        }

                        
                        //ip
                        $body .= '<tr><td style="width: 150px;"><strong>Ip :</strong></td><td>' . $ip . '</td></tr>' . "\n";
                        
                        //date
                        if (!empty($submitted_date)) {
                        $body .= '<tr><td style="width: 150px;"><strong>Submitted Date :</strong></td><td>' . $submitted_date . '</td></tr>' . "\n";
                        }                        
                        

                        $body .= '</table>';
                        
                        //*********
                        $body .= '<p style="margin: 10px 0px">******************************************************************</p>';

                $replyToEmail = $email ? $email : null;
                $recipient = get_settings('recive_email');

                // Check if there is a CV to attach
                if ($contact->cv !== null) {
                    $attachments = [
                        [
                            'path' => storage_path("app/public/{$contact->cv}"),
                            'name' => $name . '.pdf',
                        ],
                    ];
                    if(!empty($replyToEmail)){
                        $messageId = sendEmail($recipient, $subject, $body, $replyToEmail); // Send email with attachment
                    }else{
                        $messageId = sendEmail($recipient, $subject, $body, $replyToEmail); // Send email with attachment
                    }
                } else {
                    $messageId = sendEmail($recipient, $subject, $body, $replyToEmail); // Send email without attachment
                }

                // Update the contact record to mark the email as sent
                if (isset($messageId) && !empty($messageId)) {
                    $contact->email_sent = 1;
                }
                $contact->save();
                
            }else{
                echo "False ".$contact->id;
            }
            } catch (\Exception $e) {
                // Log any errors
                Log::error('Error sending email for contact ID ' . $contact->id . ': ' . $e->getMessage());
            }
        }

        /*$filePath = public_path('cronjob/'.date('y-m-d@H-iA').'-file.txt');
        $content = "Hello, this is a test file.";    
        file_put_contents($filePath, $content);*/         
    }
}