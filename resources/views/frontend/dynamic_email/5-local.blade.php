@php
    $fallbackHeroImage = 'https://attariclasses.in/email-image/Vmwarelocal1.png';
    $uploadedHeroImageUrl = dynamic_email_uploaded_image_url(
        (int) $emailTemplateData['course_id'],
        (string) $emailTemplateData['type']
    );
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>VMware Course Enquiry</title>
</head>
<body style="margin:0; padding:0; background-color:#f5f5f5; font-family: 'Inter', Arial, sans-serif;">
    <div style="display:none; max-height:0px; overflow:hidden; font-size:1px; line-height:1px; color:#ffffff; opacity:0;">
        Reserve your seat for VMware training at Attari Classes. First lecture is a FREE demo.
    </div>
    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f5f5f5">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table bgcolor="#ffffff" width="600" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto; border-radius: 8px; overflow: hidden;">
                    <tr>
                        <td align="center" style="padding:24px;">
                            <a href="https://attariclasses.in/vmware-training-certification-online/e" target="_blank">
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
                                <img src="{{ $uploadedHeroImageUrl ?: $fallbackHeroImage }}" alt="Windows Server Hybrid Training Banner" width="420" style="border:1px solid #cccccc69; width:100%; max-width:420px; border-radius:30px; display:block;">
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
                                                    <img src="https://attariclasses.in/storage/assets/image/text_review/Gv2pla0tHbPPjbNMOOyZnRV33JZWJTydJHHiuK2S.jpg" width="56" height="56" alt="Reviewer" style="display:block; width:56px; height:56px; border-radius:28px; border:0;">
                                                </td>
                                                <td valign="top" style="padding:0;">
                                                    <p style="margin:0; font-size:16px; line-height:22px; color:#000000; font-weight:700;">
                                                        Sachin Bankar
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
                                                 I was a good experience of learning online VMware course at attari Classes. Maqsood Sir are Knowledgeable and capable of clearing all off the doubts. They will teach you from very basic to advanced Level. After Completing Below training you are capable for join L2 L3 level Job. New Learning portal LMS is best option for reviews completed lecture. If you want to upgrade your VMware knowledge Please join the attari Online class its best option.
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
                                                    <img src="https://attariclasses.in/storage/assets/image/text_review/wcRJRrmHYZmLKQYMReHeSYtPGwGjE9ulTJPORkxL.jpg" width="56" height="56" alt="Reviewer" style="display:block; width:56px; height:56px; border-radius:28px; border:0;">
                                                </td>
                                                <td valign="top" style="padding:0;">
                                                    <p style="margin:0; font-size:16px; line-height:22px; color:#000000; font-weight:700;">
                                                       Kannan govindaraj
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
                                                   I have completed my VmWare vSphere Course from Attari classes, it helped me a lot to Gain strong knowledge in Virtualization, each and every topic is cleared theoretically and practically too, LMS is the great way of learning in offline too, I would recommend to everyone that Attari Classes is the best place to learn VMware Vsphere Virtualizatiom from anywhere!!! Thank you so much
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
                                                    <img src="https://attariclasses.in/storage/assets/image/text_review/6j72uFRo8zpnctHxF8BAQRZugKSJUHlYASwkDveL.jpg" width="56" height="56" alt="Reviewer" style="display:block; width:56px; height:56px; border-radius:28px; border:0;">
                                                </td>
                                                <td valign="top" style="padding:0;">
                                                    <p style="margin:0; font-size:16px; line-height:22px; color:#000000; font-weight:700;">
                                                        
                                                Mahesh Dalvi
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
                                                     I had done online VMware class from Attari Classes. The way Maqsood sir teaches is an extra ordinary. The way he revise previous lecture in short time is a great way to sync with topic. Theory and practical management is awesome. The examples he gives is real life so it clear the logic. Course starts with basic and at the end you will become expert. LMS is an extra advantage to revise the topic as well as if you miss any lecture. It's online class but you feel like classroom training. Thank you Maqsood sir and Attari classes for this wonderful training. I will recommend only Attari Classes for VMware training.
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
                                                    <img src="https://attariclasses.in/storage/assets/image/text_review/W9bUGCii8RF4sSlUHdSu4t6qepSjznEFYl7qpcI7.jpg" width="56" height="56" alt="Reviewer" style="display:block; width:56px; height:56px; border-radius:28px; border:0;">
                                                </td>
                                                <td valign="top" style="padding:0;">
                                                    <p style="margin:0; font-size:16px; line-height:22px; color:#000000; font-weight:700;">
                                                        
Samir Gaikwad
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
                                                  "Maqsood sir have great teaching skills.The VMware Attari classes was great. One of the best classes I ever attended. I always pick up new stuff when attending classes with other instructors, but your class surpassed all of my expectations. The Attari classes was by far the most thorough class on VMware I have seen.” "Thanks Maqsood sir and Attari classes team."
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