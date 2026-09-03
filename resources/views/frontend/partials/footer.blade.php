@include('frontend.component.marketingform')
@include('frontend.component.marketingform2')


<section class="footer site_footer">
    <div class="container">
        <div class="site_footer_channel">
            <a target="_blank" rel="noopener" href="https://whatsapp.com/channel/0029Va9JnmaHAdNWUTJFhc2O">
                Join Attari Classes channel on
                <span class="site_footer_channel_icon"><i aria-hidden="true" class="fab fa-whatsapp"></i></span>
            </a>
        </div>


        <div class="row footer_links_container site_footer_grid">
            <div class="col-lg-4 col-md-6">
                <a class="site_footer_brand" href="{{ url(route('index')) }}" aria-label="Attari Classes">
                    <span class="site_footer_brand_icon" aria-hidden="true"><i class="fas fa-cloud"></i></span>
                    <span class="site_footer_brand_text"><strong>Attari</strong>Classes</span>
                </a>
                <p class="footer_para">Attari Classes is an IT training institute for VMware vSphere, AWS Cloud, Azure Cloud, Windows Server Hybrid and CCNA course. We provide Instructor led Live Online
                    training to candidates across the globe & Classroom Training in
                    Mumbai, we also have self paced training options (Video Learning).</p>

                <div class="social_icon">
                    <a target="_blank" href="https://www.facebook.com/AttariClass" rel="nofollow" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                    <a target="_blank" href="https://twitter.com/i/flow/login?redirect_after_login=%2FAttariClasses" rel="nofollow" aria-label="X"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                    <a target="_blank" href="https://www.instagram.com/attari.classes/" rel="nofollow" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                    <a target="_blank" href="https://www.linkedin.com/company/attari-classes-vmware-aws-azure-mcsa-ccna-training-in-mumbai/" rel="nofollow" aria-label="LinkedIn"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="footer_links_heading">Courses</div>
                <ul class="footer_links">
                    @php
                    $course = getcmsCourses();
                    @endphp
                    @foreach ($course as $item)
                        @php
                            $slug = $item->slug === 'mcsa-mcse-windows-server-training-online'
                                ? 'windows-server-hybrid-training-certification-online'
                                : $item->slug;
                        @endphp
                        <li><a href="{{ url(route('course.detail', ['slug' => $slug] )) }}">{{ $item->menu_title }}</a></li>
                    @endforeach
                    <li><a target="_blank" href="https://lms.attariclasses.in/">Self Paced Video (LMS)</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="footer_links_heading">Quick Links</div>
                <ul class="footer_links">
                    <li><a href="{{ url(route('training-option')) }}">Training</a></li>
                    <li><a href="{{ url(route('batch')) }}">Batch Schedule</a></li>
                    <li><a href="{{ url(route('about')) }}">About Us</a></li>
                    <li><a href="{{ url(route('reviews')) }}">Reviews</a></li>
                    <li><a href="{{ url(route('success-stories')) }}">Success Stories</a></li>
                    <li><a href="{{ url(route('blog')) }}">Blog</a></li>
                    <li><a href="{{ url(route('photo-gallery')) }}">Photo Gallery</a></li>
                    <li><a href="{{ url(route('contact')) }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer_links_heading">Contact</div>
                <div class="footer_info">
                    <div class="footer_info_icon">
                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                    </div>
                    <div class="footer_info_text">
                        <p>
                            Attari Classes, Kanakia Zillion, F wing, 4th Floor, 438, LBS
                            Marg-CST Road Junction Kurla (West), Mumbai-400070 (Entry from
                            Gate No 2 on CST Road)
                        </p>
                    </div>
                </div>
                <div class="footer_info">
                    <div class="footer_info_icon">
                        <i class="fas fa-phone-alt" aria-hidden="true"></i>
                    </div>
                    <div class="footer_info_text">
                        <p class="mb-0"><a href="tel:+917738375431">+91 77383 75431</a></p>
                        <p><a href="tel:+919987088551">+91 99870 88551</a></p>
                    </div>
                </div>
                <div class="footer_info">
                    <div class="footer_info_icon">
                        <i class="fas fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="footer_info_text">
                        <p><a href="mailto:info@attariclasses.in">info@attariclasses.in</a></p>
                    </div>
                </div>
                <div class="footer_info">
                    <div class="footer_info_icon">
                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                    </div>
                    <div class="footer_info_text">
                        <p><a id="footer-whatsapp-link" target="_blank" rel="noopener" href="https://api.whatsapp.com/send?phone=917738375431&text=Hi%2C+I+am+contacting+you+through+your+website">Chat on WhatsApp</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="site_footer_bottom">
            <p class="copyright">© {{ date('Y') }} Attari Classes. All Rights Reserved</p>
            <ul class="site_footer_legal">
                <li><a href="{{ url(route('privacy-policy')) }}">Privacy Policy</a></li>
                <li><a href="{{ url(route('terms')) }}">Terms of Service</a></li>
                <li><a href="{{ url(route('refund-policy')) }}">Refunds & Cancellations</a></li>
            </ul>
        </div>
    </div>
</section>


<!-- <div class="whatsappdesktop">
<a target="_blank" href="https://api.whatsapp.com/send?phone=+917738375431&amp;text=Hi,%20I%20am%20contacting%20you%20through%20your%20website%20from%20desktop%20view%20https://attariclasses.in/">
<i aria-hidden="true" class="fab fa-whatsapp"></i>
</a>
</div> -->


<!-- <div class="whatsappdesktop">
  <a id="whatsapp-link" target="_blank">
    <i aria-hidden="true" class="fab fa-whatsapp"></i>  Chat on WhatsApp
  </a>
</div> -->


<button id="combo" aria-label="back-to-top" class="back-to-top" type="button"><i class="fas fa-chevron-up" aria-hidden="true"></i></button>

<!-- ---------------fix footer---------------- -->

<section class="fix_footer d-none d-lg-block d-md-block">
    <div class="container">
        <div class="row">
            
            <!--<div class="col-2 tablet_nones">-->
            <!--    <div class="join-whatsap-channel"><a target="_blank" href="https://whatsapp.com/channel/0029Va9JnmaHAdNWUTJFhc2O ">Join our channel on <i aria-hidden="true" class="fab fa-whatsapp"></i></a></div>-->
            <!--</div>-->
            <div class="col-9 text-center py-2">
                <p>
                    For Career Assistance : <img src="/assets/frontend/images/inr.png" width="15" height="10"
                        alt="INR" />
                    +91
                    7738375431
                </p>
            </div>
            <div class="col-3 query">
                <div class="query_heading d-flex justify-content-between align-items-center">
                    <p>Drop a Query</p>
                    <i class="fas fa-chevron-up"></i>
                </div>

                <div class="query_form">

                    @php
                        $session_data = json_decode(session('user_ip'), true);
                    @endphp

                    @include('frontend.component.common_form', [
                                    'section' => 'Drop a Query Form',
                                    'title'  => 'Drop a Query Form',
                                    'course_name' => null
                                ])                  

                </div>
            </div>
        </div>
    </div>
</section>


 <section class="fix_mobile_footer">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="inner_box">
           <div class="call-now">
             <a class="call_now" href="tel:+91 7738375431">
              <i aria-hidden="true" class="fas fa-phone-alt" style="transform: rotate(90deg);"></i>
               <span class="icon-box-title"> Call </span>
             </a>
           </div>
           {{--
           <div class="what-sapp">
             <a class="whatsup_now" href="https://api.whatsapp.com/send?phone=+917738375431&text=Hi,%20I%20am%20contacting%20you%20through%20your%20website%20from%20mobile%20view%20https://attariclasses.in/">
               <i aria-hidden="true" class="fab fa-whatsapp"></i>
               <span class="elementor-icon-box-title"> Whatsapp </span>
             </a>
           </div>
           --}}
           <div class="what-sapp">
              <a class="whatsup_now" id="whatsapp-link-mobile">
               <i aria-hidden="true" class="fab fa-whatsapp"></i>
               <span class="elementor-icon-box-title"> Chat on WhatsApp </span>
              </a>
            </div>
           <div class="popup_form">
             <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#enquiry_modal"> Drop a query </button>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 
 
 <div class="modal fade enquiry_modal" id="enquiry_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="enquiry_modal_close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
			<div class="modal-body">
			     @include('frontend.component.common_form', [
                'section' => 'Footer - Bottom Section - Drop a Query Form on Mobile view',
                'title'  => 'Drop a <b>Query</b>',
                'Headingclassname'  => 'color_white',
                'course_name' => null
            ])
			</div>
		</div>
	</div>
</div>





<script>
    document.addEventListener("DOMContentLoaded", function () {
        const openButtons = document.querySelectorAll(".trainer-btn");
        const modals = document.querySelectorAll(".trainer-modal-overlay");
        const closeButtons = document.querySelectorAll(".trainer-modal-close");

        openButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                const modalId = button.getAttribute("data-modal");
                const modal = document.getElementById(modalId);

                if (modal) {
                    modal.classList.add("active");
                    document.body.classList.add("modal-open");
                }
            });
        });

        closeButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                closeModal(button.closest(".trainer-modal-overlay"));
            });
        });

        modals.forEach(function (modal) {
            modal.addEventListener("click", function (event) {
                if (event.target === modal) {
                    closeModal(modal);
                }
            });
        });

        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape") {
                const activeModal = document.querySelector(".trainer-modal-overlay.active");
                if (activeModal) {
                    closeModal(activeModal);
                }
            }
        });

        function closeModal(modal) {
            if (modal) {
                modal.classList.remove("active");
                document.body.classList.remove("modal-open");
            }
        }
    });
</script>



// <script>
//   // Get current query parameters from URL
//   // const queryParams = window.location.search; // includes '?'
  
//   // Mapping of original keys to replacement letters
//   const keyMap = {
//     gclid: 'G',
//     gbraid: 'G',
//     gad: 'G',
//     fbclid: 'F',
//     ig: 'I',
//     linkedin: 'L',
//     chatgpt: 'C'
//   };

//   // Get current URL parameters
// //   const urlParams = new URLSearchParams(window.location.search);
// //   const filteredParams = [];

// //   // Only include allowed keys
// //   urlParams.forEach((value, key) => {
// //     if (keyMap[key]) {
// //       const newKey = keyMap[key];
// //       filteredParams.push(`${newKey}=${value}`);
// //     }
// //   });

// //   // Build query string if there are matched keys
// //   const customQuery = filteredParams.length ? '?' + filteredParams.join('&') : '';

//   const urlParams = new URLSearchParams(window.location.search);
//   const finalKeys = new Set(); // To avoid duplicates

//   // Step 1: Handle direct key matches
//   urlParams.forEach((value, key) => {
//     if (keyMap[key]) {
//       finalKeys.add(keyMap[key]);
//     }

//     // Step 2: Special handling for utm_source
//     if (key === 'utm_source') {
//       const lowerVal = value.toLowerCase();
//       if (lowerVal.includes('linkedin')) finalKeys.add('L');
//       if (lowerVal.includes('chatgpt.com')) finalKeys.add('C');
//     }
//   });

//   // Build query string: ?G&F&L etc.
//   const customQuery = finalKeys.size ? '?' + [...finalKeys].join('&') : '';
  
  
//   // Prepare base WhatsApp message
//   const baseMessage_desktop = `Hi, I am contacting you through your website from desktop view https://attariclasses.in/${customQuery}`;
//   const baseMessage_mobile = `Hi, I am contacting you through your website from mobile view https://attariclasses.in/${customQuery}`;
  
  
//   // Encode the full message
//   const encodedMessage_desktop = encodeURIComponent(baseMessage_desktop);
//   const encodedMessage_mobile = encodeURIComponent(baseMessage_mobile);

//   // Set phone number
//   const phone = '+917738375431';

//   // Final WhatsApp API URL
//   const whatsappURL_desktop = `https://api.whatsapp.com/send?phone=${phone}&text=${encodedMessage_desktop}`;
//   const whatsappURL_mobile = `https://api.whatsapp.com/send?phone=${phone}&text=${encodedMessage_mobile}`;

//   // Set the href dynamically
//   document.getElementById('whatsapp-link').href = whatsappURL_desktop;
//   document.getElementById('whatsapp-link-mobile').href = whatsappURL_mobile;
// </script>


{{--
// <script>
// Mapping of original keys to replacement letters
//   const keyMap = {
//     gclid: 'G',
//     gbraid: 'G',
//     gad: 'G',
//     fbclid: 'F',
//     ig: 'I',
//     linkedin: 'L',
//     chatgpt: 'C'
//   };

//   const urlParams = new URLSearchParams(window.location.search);
//   const finalKeys = new Set(); // To avoid duplicates

//   // Step 1: Handle direct key matches
//   urlParams.forEach((value, key) => {
//     if (keyMap[key]) {
//       finalKeys.add(keyMap[key]);
//     }

//     // Step 2: Special handling for utm_source
//     if (key === 'utm_source') {
//       const lowerVal = value.toLowerCase();
//       if (lowerVal.includes('linkedin')) finalKeys.add('L');
//       if (lowerVal.includes('chatgpt.com')) finalKeys.add('C');
//     }
//   });

//   // Build query string: ?G&F&L etc.
//   const customQuery = finalKeys.size ? '?' + [...finalKeys].join('&') : '';

//   // Prepare clean base messages (no HTML, no tag injection)
//   let baseMessage_desktop = `Hi, I am contacting you through your website from desktop view https://attariclasses.in/${customQuery}`;
//   let baseMessage_mobile = `Hi, I am contacting you through your website from mobile view https://attariclasses.in/${customQuery}`;

//   // Step: Strip any accidental HTML (just in case)
//   const stripHtml = (str) => str.replace(/<\/?[^>]+(>|$)/g, '');
  
//   baseMessage_desktop = stripHtml(baseMessage_desktop);
//   baseMessage_mobile = stripHtml(baseMessage_mobile);

//   // Encode the messages
//   const encodedMessage_desktop = encodeURIComponent(baseMessage_desktop);
//   const encodedMessage_mobile = encodeURIComponent(baseMessage_mobile);

//   // Set phone number
//   const phone = '+917738375431';

//   // Build final WhatsApp URLs
//   const whatsappURL_desktop = `https://api.whatsapp.com/send?phone=${phone}&text=${encodedMessage_desktop}`;
//   const whatsappURL_mobile = `https://api.whatsapp.com/send?phone=${phone}&text=${encodedMessage_mobile}`; 

//   // Set the href values only (no innerHTML, no injection)
//   document.getElementById('whatsapp-link').setAttribute('href', whatsappURL_desktop);
//   document.getElementById('whatsapp-link-mobile').setAttribute('href', whatsappURL_mobile);
// </script>
--}}


@php
  $mediumKey = get_medium('key') ?? '';
@endphp
<script>
  const medium = @json($mediumKey);
  const customQuery = medium ? `?${encodeURIComponent(medium)}` : '';

  let baseMessage_desktop = `Hi, I am contacting you through your website from desktop view https://attariclasses.in/${customQuery}`;
  let baseMessage_mobile = `Hi, I am contacting you through your website from mobile view https://attariclasses.in/${customQuery}`;

  const stripHtml = (str) => str.replace(/<\/?[^>]+(>|$)/g, '');
  baseMessage_desktop = stripHtml(baseMessage_desktop);
  baseMessage_mobile = stripHtml(baseMessage_mobile);

  const encodedMessage_desktop = encodeURIComponent(baseMessage_desktop);
  const encodedMessage_mobile = encodeURIComponent(baseMessage_mobile);

  const phone = '+917738375431';
  const whatsappURL_desktop = `https://api.whatsapp.com/send?phone=${phone}&text=${encodedMessage_desktop}`;
  const whatsappURL_mobile = `https://api.whatsapp.com/send?phone=${phone}&text=${encodedMessage_mobile}`; 

  document.getElementById('whatsapp-link').setAttribute('href', whatsappURL_desktop);
  document.getElementById('whatsapp-link-mobile').setAttribute('href', whatsappURL_mobile);
  const footerWhatsapp = document.getElementById('footer-whatsapp-link');
  if (footerWhatsapp) {
    footerWhatsapp.setAttribute('href', whatsappURL_desktop);
  }
</script>

