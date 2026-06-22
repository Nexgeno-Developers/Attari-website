@php
    $fallbackHeroImage = 'https://attariclasses.in/email-image/AWSlocal.jpg';
    $uploadedHeroImageUrl = dynamic_email_uploaded_image_url(
        (int) $emailTemplateData['course_id'],
        (string) $emailTemplateData['type']
    );
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AWS Course Enquiry</title>
</head>
<body style="margin:0; padding:0; background-color:#f5f5f5; font-family: 'Inter', Arial, sans-serif;">
    <div style="display:none; max-height:0px; overflow:hidden; font-size:1px; line-height:1px; color:#ffffff; opacity:0;">
        Reserve your seat for AWS training at Attari Classes. First lecture is a FREE demo.
    </div>
    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f5f5f5">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table bgcolor="#ffffff" width="600" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto; border-radius: 8px; overflow: hidden;">
                    <tr>
                        <td align="center" style="padding:24px;">
                            <a href="https://attariclasses.in/aws-certification-training-online/e" target="_blank">
                                <img src="https://attariclasses.in/email-image/attari_logo.png" alt="Attari Classes Logo" width="196" style="display:block; border:0;">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 24px;">
                            <p style="margin:0; font-size:25px; font-weight:600; color:#000000;">Hi,</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px;">
                            <p style="margin:0; font-size:18px; line-height:150%; color:#777777;">
                                Thank you for showing interest in our <strong>{{ $emailTemplateData['breadcrumb_title'] }}</strong>. We are glad to know that you are considering us for your learning journey.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:0 24px 24px 24px;">
                            <p style="margin:0 0 20px 0; font-size:20px; line-height:150%; color:#000000; font-weight:600;">
                                For <strong>{{ $emailTemplateData['menu_title'] }}</strong> batch and course details
                            </p>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#363a57" style="border-radius:15px;">
                                        <a href="{{ $emailTemplateData['website_url'] }}" target="_blank" style="display:inline-block; padding:12px 32px; font-size:18px; color:#ffffff; font-weight:700; text-decoration:none;">Visit Website</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:0 32px 24px 32px;">
                            <a href="https://api.whatsapp.com/send/?phone=917738375431&text=Hi,+I+am+contacting+you+through+your+email" target="_blank">
                                <img src="{{ $uploadedHeroImageUrl ?: $fallbackHeroImage }}" alt="Windows Server Hybrid Training Banner" width="460" style="width:100%; max-width:460px; border-radius:8px; display:block;">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 24px 24px 24px;">
                            <p style="margin:0; font-size:18px; line-height:150%; color:#333; font-weight:600;">
                                Your <strong>first lecture will be a FREE demo</strong>. Reserve your seat now by calling our Support Desk.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:0 24px 24px 24px;">
                            <a href="tel:+917738375431" style="text-decoration:none; margin-bottom: 20px; display: block;">
                                <img src="https://attariclasses.in/email-image/call_icon.png" alt="Call Support" width="300" style="width:100%; max-width:300px; border-radius:20px;">
                            </a>
                            <p style="margin:10px 0; color:#777777; font-size:18px;">You may also reach us on <span style="color:#4cbe19; font-weight:bold;">WhatsApp</span>:</p>
                            <a href="https://api.whatsapp.com/send/?phone=917738375431&text=Hi,+I+am+contacting+you+through+your+email" target="_blank">
                                <img src="https://attariclasses.in/email-image/whatsapp_icon.png" alt="Chat on WhatsApp" width="350" style="width:100%; max-width:350px; border-radius:20px;">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:12px; background-color: #fff;">
                            <p style="margin:0 0 15px 0; font-size:20px; font-weight:600; color:#000000;">Watch Course Overview</p>
                            <a href="{{ $emailTemplateData['youtube_url'] }}" target="_blank">
                                <img src="{{ dynamic_email_youtube_image_url($emailTemplateData['course_id'], $emailTemplateData['type']) }}" alt="Video Thumbnail" width="405" style="width:100%; max-width:405px; border-radius:10px;">
                            </a>
                        </td>
                    </tr>
					
					<tr>
                        <td align="center" style="padding:16px 24px 6px 24px; background-color:#ffffff; width:100%;">
                            <p style="margin:0 0 12px 0; font-size:20px; font-weight:700; color:#111111; text-align:center;">Training Key Features</p>
        

                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate; width:100%;">
                                <tr>
                                    <td style="padding:0;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate; width:100%; background-color:#f9f9f9; border:1px solid #eee; border-radius:12px; padding-right:85px;">
                                            <tr>
                                                <td style="padding:14px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
                                                        <tr>
                                                            <td width="52" valign="middle" style="padding:0 12px 0 0;">
                                                                <table cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate;">
                                                                    <tr>
                                                                        <td align="center" valign="middle" bgcolor="#363a57 " style="width:40px; height:40px; border-radius:20px; font-size:18px; line-height:40px; color:#ffffff; font-weight:700;">
                                                                            <img src="https://attariclasses.in/email-image/training_icon.png" width="22" alt="Google Reviews" style="display:block; border:0;">
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td valign="middle" style="padding:0;">
                                                                <p style="margin:0; font-size:16px; line-height:22px; color:#111111; font-weight:700;">Instructor led live Training</p>
                                                                 </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px 0 0 0;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate; width:100%; background-color:#f9f9f9; border:1px solid #eee; border-radius:12px; padding-right:78px;">
                                            <tr>
                                                <td style="padding:14px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
                                                        <tr>
                                                            <td width="52" valign="middle" style="padding:0 12px 0 0;">
                                                                <table cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate;">
                                                                    <tr>
                                                                        <td align="center" valign="middle" bgcolor="#363a57 " style="width:40px; height:40px; border-radius:20px; font-size:18px; line-height:40px; color:#ffffff; font-weight:700;">
                                                                            <img src="https://attariclasses.in/email-image/cash-on-delivery-1.png" width="22" alt="Google Reviews" style="display:block; border:0;">
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td valign="middle" style="padding:0;">
                                                                <p style="margin:0; font-size:16px; line-height:22px; color:#111111; font-weight:700;">Hands-on Practical Training</p>
                                                               </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px 0 0 0;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate; width:100%; background-color:#f9f9f9; border:1px solid #eee; border-radius:12px; padding-right:70px;">
                                            <tr>
                                                <td style="padding:14px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
                                                        <tr>
                                                            <td width="52" valign="middle" style="padding:0 12px 0 0;">
                                                                <table cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate;">
                                                                    <tr>
                                                                        <td align="center" valign="middle" bgcolor="#363a57 " style="width:40px; height:40px; border-radius:20px; font-size:18px; line-height:40px; color:#ffffff; font-weight:700;">
                                                                            <img src="https://attariclasses.in/email-image/call-center_icon.png" width="25" alt="Google Reviews" style="display:block; border:0;">
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td valign="middle" style="padding:0;">
                                                                <p style="margin:0; font-size:16px; line-height:22px; color:#111111; font-weight:700;">Trainer Support on WhatsApp</p>
                                                               </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px 0 0 0;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate; width:100%; background-color:#f9f9f9; border:1px solid #eee; border-radius:12px; padding-right:85px;">
                                            <tr>
                                                <td style="padding:14px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
                                                        <tr>
                                                            <td width="52" valign="middle" style="padding:0 12px 0 0;">
                                                                <table cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate;">
                                                                    <tr>
                                                                        <td align="center" valign="middle" bgcolor="#363a57 " style="width:40px; height:40px; border-radius:20px; font-size:18px; line-height:40px; color:#ffffff; font-weight:700;">
                                                                            <img src="https://attariclasses.in/email-image/lms_icon.png" width="25" alt="Google Reviews" style="display:block; border:0;">
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td valign="middle" style="padding:0;">
                                                                <p style="margin:0; font-size:16px; line-height:22px; color:#111111; font-weight:700;">Recorded lectures on LMS</p>
                                                             </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                 

                    <tr>
                        <td style="padding:0 24px; background-color:#ffffff; text-align:center;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
                                <tr>
                                    <td style="padding:18px 0 13px 0; text-align:center;">
                                        <p style="margin:0; font-size:20px; font-weight:600; color:#000000; text-align:center;">Google Review</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                   
					
					<tr>
                        <td style="padding:0 24px 18px 24px; background-color:#ffffff;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate; background-color:#f9f9f9; border:1px solid #eeeeee; border-radius:10px;">
                                <tr>
                                    <td style="padding:16px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
                                            <tr>
                                                <td width="56" valign="top" style="padding:0 12px 0 0;">
                                                    <img src="https://attariclasses.in/storage/assets/image/text_review/dfY5mutiFQvh5t7V4ASYAXpQFF2GshIF5inQJgDj.jpg" width="56" height="56" alt="Reviewer" style="display:block; width:56px; height:56px; border-radius:28px; border:0;">
                                                </td>
                                                <td valign="top" style="padding:0;">
                                                    <p style="margin:0; font-size:16px; line-height:22px; color:#000000; font-weight:700;">
                                                        Vishal Jadhav
                                                    </p>
                                                    <p style="margin:4px 0 0 0; font-size:14px; line-height:20px; color:#FBBC04;">
                                                        ★★★★★
                                                    </p>
                                                </td>
                                                <td width="70" align="right" valign="top" style="padding:0 0 0 12px;">
                                                    <a href="https://attariclasses.in/reviews/e" target="_blank" style="text-decoration:none;">
                                                        <img src="https://attariclasses.in/email-image/google_reviews.png" width="30" alt="Google Reviews" style="display:block; border:0;">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="padding:10px 0 0 0;">
                                                    <p style="margin:0; font-size:14px; line-height:22px; color:#333333;">
                                                        
 I hv done AWS solution architect course from Attari Classes. Great training experience. Trainer Maqsood is having best knowledge AWS giving perfect example that can help to understood topic properly. Syllabus and Training pattern is also best. The new thing they hv provide LMS(Learning Management system) In which they hv uploaded all lectures recording is very helpful to do practice and for revision of any topic at any time. Thanks Maqsood Sir and Attari Classes for great training for my career growth.
 - <a href="https://attariclasses.in/reviews/e" target="_blank" style="font-size:14px; line-height:18px; color:#000; font-weight:700; text-decoration:none;">
    View More Reviews
</a>                                                  
</p>
                                                   
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
					
					
					<tr>
                        <td style="padding:0 24px 18px 24px; background-color:#ffffff;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate; background-color:#f9f9f9; border:1px solid #eeeeee; border-radius:10px;">
                                <tr>
                                    <td style="padding:16px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
                                            <tr>
                                                <td width="56" valign="top" style="padding:0 12px 0 0;">
                                                    <img src="https://attariclasses.in/storage/assets/image/text_review/1lwo7aXYnJnLEdyaY073w9Moyo2dPkmpwBGVJwFS.jpg" width="56" height="56" alt="Reviewer" style="display:block; width:56px; height:56px; border-radius:28px; border:0;">
                                                </td>
                                                <td valign="top" style="padding:0;">
                                                    <p style="margin:0; font-size:16px; line-height:22px; color:#000000; font-weight:700;">
                                                        Mahesh Jadhav
                                                    </p>
                                                    <p style="margin:4px 0 0 0; font-size:14px; line-height:20px; color:#FBBC04;">
                                                        ★★★★★
                                                    </p>
                                                </td>
                                                <td width="70" align="right" valign="top" style="padding:0 0 0 12px;">
                                                    <a href="https://attariclasses.in/reviews/e" target="_blank" style="text-decoration:none;">
                                                        <img src="https://attariclasses.in/email-image/google_reviews.png" width="30" alt="Google Reviews" style="display:block; border:0;">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="padding:10px 0 0 0;">
                                                    <p style="margin:0; font-size:14px; line-height:22px; color:#333333;">
                                                        

If you want to be more accurate and professional in your IT Journey, this is the best place to come. I have attended Online Training of AWS from Attari Classes and I am more clear about the concepts in the cloud. The best thing is even the training is online, the Trainer Maqsood Sir, is very pro-efficient to reach out at each and every participant in the training session to get the all things done PRACTICALLY by every student. If any student fail to do the practical or misunderstood he use to take remote and make him understand the concept. Apart from the session if any concept is not clear then their is Learning Mangement System (LMS) where we can find all recorded lectures. Trainer is available even after the training session on WhatsAap.
 - <a href="https://attariclasses.in/reviews/e" target="_blank" style="font-size:14px; line-height:18px; color:#000; font-weight:700; text-decoration:none;">
    View More Reviews
</a>                                                  
</p>
                                                   
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 24px 18px 24px; background-color:#ffffff;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate; background-color:#f9f9f9; border:1px solid #eeeeee; border-radius:10px;">
                                <tr>
                                   
                                    <td style="padding:16px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
                                           
                                                <tr>
                                                <td width="56" valign="top" style="padding:0 12px 0 0;">
                                                    <img src="https://attariclasses.in/storage/assets/image/text_review/rA1USofPeeOdxCHPNymA3VHqkBodjbjNRZvlQmcU.png" width="56" height="56" alt="Reviewer" style="display:block; width:56px; height:56px; border-radius:28px; border:0;">
                                                </td>
                                                <td valign="top" style="padding:0;">
                                                    <p style="margin:0; font-size:16px; line-height:22px; color:#000000; font-weight:700;">
                                                        
                                                Ansari Atif
                                                    </p>
                                                    <p style="margin:4px 0 0 0; font-size:14px; line-height:20px; color:#FBBC04;">
                                                        ★★★★★
                                                    </p>
                                                </td>
                                                <td width="70" align="right" valign="top" style="padding:0 0 0 12px;">
                                                    <a href="https://attariclasses.in/reviews/e" target="_blank" style="text-decoration:none;">
                                                        <img src="https://attariclasses.in/email-image/google_reviews.png" width="30" alt="Google Reviews" style="display:block; border:0;">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="padding:10px 0 0 0;">
                                                    <p style="margin:0; font-size:14px; line-height:22px; color:#333333;">
                                                      Recently i have attended AWS course from Attari Classes, 1st time i have experienced online training and it is very good way of training on during this tough time and specially Thanks to Maqsood Sir for such a wonderful way of teaching he explained each and every topic with example for understanding and also they have Provide LMS feature for revision in the LMS Recorded Videos is there of Trainer, it is a very good to clear your doubt. I am Satisfied from Attari classes and Strongly recommend to Join Attari Classes.
<a href="https://attariclasses.in/reviews/e" target="_blank" style="font-size:14px; line-height:18px; color:#000; font-weight:700; text-decoration:none;">
    View More Reviews
</a>
                                                    </p>
                                                   
                                                    
                                                    
                                                </td>
                                            </tr>
                                        
                                        </table>
                                    </td>
                                
                                </tr>
                            </table>
                        </td>
                    </tr>
					
					<tr>
                        <td style="padding:0 24px 18px 24px; background-color:#ffffff;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate; background-color:#f9f9f9; border:1px solid #eeeeee; border-radius:10px;">
                                <tr>
                                   
                                    <td style="padding:16px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
                                           
                                                <tr>
                                                <td width="56" valign="top" style="padding:0 12px 0 0;">
                                                    <img src="https://lh3.googleusercontent.com/a-/ALV-UjUrryG60nnI3nfRlgrFRkbf3uOgM9AgSeKfyyfG2EPjckIJHcjw=w72-h72-p-rp-mo-br100" width="56" height="56" alt="Reviewer" style="display:block; width:56px; height:56px; border-radius:28px; border:0;">
                                                </td>
                                                <td valign="top" style="padding:0;">
                                                    <p style="margin:0; font-size:16px; line-height:22px; color:#000000; font-weight:700;">
                                                        Mahesh Jadhav
Somnath Swain
                                                    </p>
                                                    <p style="margin:4px 0 0 0; font-size:14px; line-height:20px; color:#FBBC04;">
                                                        ★★★★★
                                                    </p>
                                                </td>
                                                <td width="70" align="right" valign="top" style="padding:0 0 0 12px;">
                                                    <a href="https://attariclasses.in/reviews/e" target="_blank" style="text-decoration:none;">
                                                        <img src="https://attariclasses.in/email-image/google_reviews.png" width="30" alt="Google Reviews" style="display:block; border:0;">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="padding:10px 0 0 0;">
                                                    <p style="margin:0; font-size:14px; line-height:22px; color:#333333;">
                                                  
If you want to be more accurate and professional in your IT Journey, this is the best place to come.
I have attended Online Training of AWS from Attari Classes and I am more clear about the concepts in the cloud.
The best thing is even the training is online, the Trainer Maqsood Sir, is very pro-efficient to reach out at each and every participant in the training session to get the all things done PRACTICALLY by every student.
If any student fail to do the practical or misunderstood he use to take remote and make him understand the concept.
Apart from the session if any concept is not clear then their is Learning Mangement System (LMS) where we can find all recorded lectures. Trainer is available even after the training session on WhatsAap.
I give 5 star to Trainer - Mr. Maqsood Sir and Attari Classes
<a href="https://attariclasses.in/reviews/e" target="_blank" style="font-size:14px; line-height:18px; color:#000; font-weight:700; text-decoration:none;">
    View More Reviews
</a>
                                                    </p>
                                                   
                                                    
                                                    
                                                </td>
                                            </tr>
                                        
                                        </table>
                                    </td>
                                
                                </tr>
                            </table>
                        </td>
                    </tr>
					
                    <tr>
                        <td align="center" style="padding:24px;">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td><a href="https://www.facebook.com/AttariClass"><img src="https://attariclasses.in/email-image/facebook_image.png" width="32" style="margin:0 10px;"></a></td>
                                    <td><a href="https://www.instagram.com/attari.classes/"><img src="https://attariclasses.in/email-image/instagram_image.png" width="32" style="margin:0 10px;"></a></td>
                                    <td><a href="https://www.linkedin.com/company/attari-classes-vmware-aws-azure-mcsa-ccna-training-in-mumbai/"><img src="https://attariclasses.in/email-image/linknked_image.png" width="32" style="margin:0 10px;"></a></td>
                                    <td><a href="https://www.youtube.com/c/AttariClasses-IT-Trainings"><img src="https://attariclasses.in/email-image/youtube_image.png" width="32" style="margin:0 10px;"></a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px; background-color:#eeeeee;">
                            <p style="margin:0; font-size:12px; color:#999999; text-align:center;">
                                © 2026 Attari Classes. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>