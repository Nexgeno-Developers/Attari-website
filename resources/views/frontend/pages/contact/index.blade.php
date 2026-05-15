@extends('frontend.layouts.app')

@section('page.title', 'Contact us - Attari Classes')

@section('page.description',
    'Attari Classes is located in Mumbai, Kurla West. Get in touch with our support team on +91998708851 or email to info@attariclasses.in')

@section('page.type', 'website')


@section('page.schema')

<!-- Attari Classes - EducationalOrganization + LocalBusiness Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": ["EducationalOrganization", "LocalBusiness"],
  "@id": "https://attariclasses.in/#organization",
  "name": "Attari Classes",
  "url": "https://attariclasses.in/",
  "logo": {
    "@type": "ImageObject",
    "url": "https://attariclasses.in/assets/frontend/images/cropped-header-logo-1.webp"
  },
  "image": {
    "@type": "ImageObject",
    "url": "https://attariclasses.in/assets/frontend/images/cropped-header-logo-1.webp"
  },
  "description": "Attari Classes is an IT training institute offering VMware vSphere, AWS Cloud, Microsoft Azure, Windows Server Hybrid, CCNA, MCSE, live online training, classroom training in Mumbai, and self-paced LMS video courses.",
  "email": "info@attariclasses.in",
  "telephone": "+91-7738375431",
  "hasMap": "https://www.google.com/maps?cid=18202218376659524362",
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 19.07594004083397,
    "longitude": 72.87757885814574
  },
  "areaServed": [
    { "@type": "Country", "name": "India" },
    { "@type": "Country", "name": "United Arab Emirates" },
    { "@type": "Country", "name": "United States" },
    { "@type": "Country", "name": "United Kingdom" },
    { "@type": "Country", "name": "Singapore" },
    { "@type": "Country", "name": "New Zealand" },
    { "@type": "Country", "name": "Australia" },
    { "@type": "Country", "name": "Nigeria" },
    { "@type": "Country", "name": "Saudi Arabia" },
    { "@type": "Country", "name": "Kuwait" },
    { "@type": "Country", "name": "Qatar" },
    { "@type": "Country", "name": "Oman" },
    { "@type": "Country", "name": "Bahrain" }
  ],
  "openingHoursSpecification": [
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        "Sunday"
      ],
      "opens": "09:30",
      "closes": "18:30"
    }
  ],
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Kanakia Zillion, F wing, 4th Floor, 438, LBS Marg-CST Road Junction Kurla (West)",
    "addressLocality": "Mumbai",
    "addressRegion": "Maharashtra",
    "postalCode": "400070",
    "addressCountry": "IN"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+91-7738375431",
    "contactType": "customer service",
    "areaServed": ["IN", "AE", "US", "GB", "SG", "NZ", "AU", "NG", "SA", "KW", "QA", "OM", "BH"],
    "availableLanguage": ["en"]
  },
  "sameAs": [
    "https://www.facebook.com/AttariClass",
    "https://www.instagram.com/attari.classes/",
    "https://www.linkedin.com/company/attari-classes-vmware-aws-azure-mcsa-ccna-training-in-mumbai/"
  ]
}
</script>

@endsection


@section('page.content')

    <!----------========== contact start ===============-------------------->
    <!-- ---------------------- Contact banner start ---------------- -->


    <section class="">
        <img class="inner-banner-image" src="assets/frontend/images/Contact-us-1.jpg"/>
        <div class="container mt235">
            <div class="row">

                <div class="col-12">
                    <div class="breadcrums_section paddtb80">
                        <h1 class="sm-aboutus color-white1">Contact Us</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url(route('index')) }}">Home</a></li>
                                <li class="breadcrumb-item"><a>»</a></li>
                                <li class="breadcrumb-item"><a><b>Contact Us</b></a></li>
                            </ol>
                        </nav>
                    </div>
                </div>


            </div>
        </div>
    </section>

    @php
        $session_data = json_decode(session('user_ip'), true);
    @endphp

    <!-------------------Contact Form------------------------------>
    <section class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2 form_container">
                    <h6 class="mb-md-3 mb-2 contact_form_heading">Fill out this form for booking a career guidance session
                    </h6>
                    @include('frontend.component.common_form', [
                        'section' => 'Contact Us Form',
                    ])  
                    
                    <p class="text-center pt-3">I agree to get all updates via SMS, Whatsapp, RCS, Email, and any other channel</p>

                </div>
                <div class="col-md-6 order-md-1  info_contact">
                    <h3 class="mb-4">Contact Information</h3>
                    <div class="icon_text_contact mb-4">
                        <div><i aria-hidden="true" class="fas fa-phone-alt" style="transform: rotate(90deg);"></i></div>
                        <div>
                            <!--<p><a href="tel:+91 7304287233"> +91 7304287233</a></p>-->
                            <p><a href="tel:+91 7738375431"> +91 7738375431</a></p>
                            <p><a href="tel:+91 9987088551"> +91 9987088551</a></p>
                        </div>
                    </div>
                    <div class="icon_text_contact mb-4">
                        <div><i aria-hidden="true" class="far fa-envelope"></i></div>
                        <div>
                            <p><a href="mailto:info@attariclasses.in">info@attariclasses.in</a></p>
                        </div>
                    </div>
                    <h3 class="mb-4">Hour of operation</h3>
                    <p class="mb-3">All Day</p>
                    <div class="icon_text_contact">
                        <div><i aria-hidden="true" class="far fa-clock"></i></div>
                        <div>
                            <p>9:30 am to 6:30 pm IST</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!------------------------------Google Map --------------------------------------->

    <section class="google_map">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 text_location_content">
                    <i aria-hidden="true" class="fas fa-map-marker-alt"></i>
                    <h3>Head Office</h3>
                    <p class="mb-0">
                        Attari Classes, Kanakia Zillion, F wing, 4th Floor, 438, LBS
                        Marg-CST Road Junction Kurla (West), Mumbai-400070 (Entry from
                        Gate No 2 on CST Road)
                    </p>
                </div>
                <div class="col-md-6 ppdd00">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.718263638187!2d72.87394717438183!3d19.076120851970384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c88d956c3b09%3A0xfc9b452c90e0db0a!2sAttari%20Classes%20VMwareMCSE%2FMCSA%2C%20AWS%2C%20Azure%2C%20CCNA%20Training%20Institute%20in%20Mumbai!5e0!3m2!1sen!2sin!4v1688557053565!5m2!1sen!2sin"
                        width="100%" height="400" style="border: 0" allowfullscreen="" loading="lazy"
                        class="iframe_map1" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 order-md-2 text_location_content">
                    <i aria-hidden="true" class="fas fa-map-marker-alt"></i>
                    <h3>Branch Office</h3>
                   <p class="mb-0">
                        C Wing, Baitun Noor Appartment, 504-505, 5th, SG Barve Marg,
                        Mumbai, Maharashtra 400070
                    </p>
                </div>
                <div class="col-md-6 order-md-1 ppdd00 mb-md-0 mb-4">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.7367227153973!2d72.87629607438184!3d19.07530975199573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c960af8b7201%3A0x7131baacc5da6443!2sAttari%20IT%20Trainings%20%7C%20MCSE%20%7C%20CCNA%20%7C%20MCSA%20%7C%20Azure%20%7C%20VMwareAWS!5e0!3m2!1sen!2sin!4v1688557085824!5m2!1sen!2sin"
                        width="100%" height="400" style="border: 0" allowfullscreen="" class="iframe_map1"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </div>
    </section>







    <!-----------------------------Contact Social Section------------------------------->

    <section class="social_media gray_bgg1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="text_content">
                        <h3 class="socail_head">#Social Media</h3>
                       
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-md-4 col-6 contact_pdd0">
                            <div class="icons">
                                <div class="facebook">
                                    <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                    <h4>16K</h4>
                                    <p>Followers</p>
                                    <a target="_blank" href="https://www.facebook.com/AttariClass">Check Our Facebook</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6 contact_pdd0">
                            <div class="icons">
                                <div class="instagram">
                                    <i aria-hidden="true" class="fab fa-instagram"></i>
                                    <h4>2.6K</h4>
                                    <p>Followers</p>
                                    <a target="_blank" href="https://www.instagram.com/attari.classes/">Check Our
                                        Instagram</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-6 contact_pdd0">
                            <div class="icons">
                                <div class="linkedIn">
                                    <i aria-hidden="true" class="fab fa-linkedin-in"></i>
                                    <h4>8K</h4>
                                    <p>Followers</p>
                                    <a target="_blank"
                                        href="https://www.linkedin.com/company/attari-classes-vmware-aws-azure-mcsa-ccna-training-in-mumbai/">Check
                                        Our LinkedIn</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-6 contact_pdd0">
                            <div class="icons">
                                <div class="youtupe">
                                    <i aria-hidden="true" class="fab fa-youtube"></i>
                                    <h4>23.1K</h4>
                                    <p>Subscribers</p>
                                    <a target="_blank" href="https://www.youtube.com/c/AttariClasses-IT-Trainings">Check
                                        Our YouTube Channel</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-6 contact_pdd0">
                            <div class="icons">
                                <div class="telegram">
                                    <i aria-hidden="true" class="fab fa-whatsapp"></i>
                                    <h4>580+</h4>
                                    <p>Subscribers</p>
                                    <a target="_blank" href="https://whatsapp.com/channel/0029Va9JnmaHAdNWUTJFhc2O">Check Our WhatsApp</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-6 contact_pdd0">
                            <div class="icons">
                                <div class="twitter">
                                    <i aria-hidden="true" class="fab fa-twitter"></i>
                                    <h4>40+</h4>
                                    <p>Followers</p>
                                    <a target="_blank"
                                        href="https://twitter.com/i/flow/login?redirect_after_login=%2FAttariClasses">Check
                                        Our Twitter</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-------------=============== contact end =============== -------------------->

@endsection
