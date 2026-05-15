@extends('frontend.layouts.app')

@section('page.title', 'VMware vSphere, AWS Cloud, Azure Cloud, Windows Server Hybrid and CCNA Training Institute, Book Free DEMO -Attari Classes')

@section('page.description',
    'Attari Classes provides Hands-on Practical Training, Book FREE DEMO, Topic wise Recorded Lectures on LMS, Online & Classroom Training options')

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

<!--banner start-->

    <div class="banner_slider1">
        <picture>
            <source srcset="/assets/frontend/images/make_it_happen_responsive.jpg" width="600" height="600"
                media="(max-width: 767px)">
            <source srcset="/assets/frontend/images/make_it_happen_banner.jpg"> <img class="slide-image"
                src="/assets/frontend/images/make_it_happen_banner.jpg" alt="Banner">
        </picture>
        <div class="container">
            <div class="text-center">
                <div class="banner_content">
                    <button type="button" class="btn enquire_now_btn" onclick="formModal('{{ url(route('component.form')) }}?section=Enquire Form Top - Home Page&title=Enquire Now&current_page={{ urlencode(url()->current()) }}')"> Enquire Now </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Virtualization & Cloud Computing -->

    @include('frontend.component.virtualization_cloud_computing_home_card')

    <!--Server & Networking-->

    @include('frontend.component.server_networking_home_card')

    <!--Online Training -->



    <section class="training">
        <div class="container">
            <div class="row">
                <div class="col-md-7 training_text_box">
                    <h2 class="training_heading">
                        Instructor-Led Online Training with <span class="display_blck"> live Hands-on Practical</span>
                    </h2>
                    <p class="training_para pb-4"> Labs and Software are available on Cloud for practicals,you can Interact with
                        trainer live during the training and resolve queires, also get access to topic wise Live Recorded
                        Lectures on our Learning Management System(LMS) </p>
                    <div class="row">
                        <div class="col-lg-3 col-6 training_icons_box"> <img
                                data-src="/assets/frontend/images/teacher-1.svg" width="40" height="40"
                                class="lazyload" alt="Instructor-Led">
                            <p class="para">Instructor-Led</p>
                        </div>
                        <div class="col-lg-3 col-6 training_icons_box"> <img data-src="/assets/frontend/images/lab.webp"
                                width="40" height="40" class="lazyload" alt="Access to Cloud Labs">
                            <p class="para">Access to Cloud Labs</p>
                        </div>
                        <div class="col-lg-3 col-6 training_icons_box"> <img
                                data-src="/assets/frontend/images/Online-Training.webp" width="40" height="40"
                                class="lazyload" alt="Online Training Material">
                            <p class="para">Online Training Material</p>
                        </div>
                        <div class="col-lg-3 col-6 training_icons_box"> <img
                                data-src="/assets/frontend/images/whatsapp.png" width="40" height="40"
                                class="lazyload" alt="Trainer Support on WhatsApp">
                            <p class="para">Trainer Support on WhatsApp</p>
                        </div>
                    </div>
                    <div class="training_btn d-none d-lg-block">
                        <button type="button" class="btn bookfreedemo_button" onclick="formModal('{{ url(route('component.form')) }}?section=Instructor-Led Online Training - Home Page&title=Book a Demo&current_page={{ urlencode(url()->current()) }}')"> Book a Demo </button>
                    </div>
                </div>
                <div class="col-md-5 img_box"> <img data-src="/assets/frontend/images/dsvdfb.jpg" width="399"
                        height="600" class="lazyload" alt="Lab Image"> </div>
            </div>
        </div>
    </section>

    <!-- Counter-->

    @include('frontend.component.why_attari_counter')

    <!--Class Room-->

    <section class="classroom">
        <div class="container">
            <div class="row">

                <div class="col-md-6 classroom_text_box order-md-2">
                    <h2 class="training_heading">
                        Classroom Training with live Hands-on Practical
                    </h2>
                    <p class="training_para pb-4"> We have High tech Infrastructure in our Classrooms, using High end labs
                        candidates can perform live practical’s along with the trainer, also get access to topic wise Live
                        Recorded Lectures on our Learning Management System(LMS)</p>
                    <div class="row">
                        <div class="col-lg-3 col-6 training_icons_box"><img
                                data-src="/assets/frontend/images/infrastructure.png" width="40" height="40"
                                class="lazyload" alt="State Of Art Infrastructure">
                            <p class="para">State Of Art Infrastructure</p>
                        </div>
                        <div class="col-lg-3 col-6 training_icons_box"> <img data-src="/assets/frontend/images/online_training.png"
                                width="40" height="40" class="lazyload" alt="High End Labs">
                            <p class="para">High End Labs</p>
                        </div>
                        <div class="col-lg-3 col-6 training_icons_box"> <img
                                data-src="/assets/frontend/images/3442194.png" width="40" height="40"
                                class="lazyload" alt="Online Learning Portal">
                            <p class="para">Online Learning Portal</p>
                        </div>
                        <div class="col-lg-3 col-6 training_icons_box"> <img
                                data-src="/assets/frontend/images/whatsapp.png" width="40" height="40"
                                class="lazyload" alt="Trainer Support on WhatsApp">
                            <p class="para">Trainer Support on WhatsApp</p>
                        </div>
                    </div>
                    <div class="training_btn d-none d-lg-block">
                        <button type="button" class="btn bookfreedemo_button" onclick="formModal('{{ url(route('component.form')) }}?section=Classroom Training - Home Page&title=Book a Demo&current_page={{ urlencode(url()->current()) }}')"> Book a Demo </button>
                    </div>
                </div>
                <div class="col-md-6 order-md-1">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade ">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img data-src="/assets/frontend/images/homepageclassrromimg1.jpg" width="576" height="432" class="lazyload d-block w-100" alt="Cirtificate Image 1">
                            </div>
                            
                            <div class="carousel-item ">
                                <img data-src="/assets/frontend/images/homepageclassrromimg2.jpg" width="576" height="432" class="lazyload d-block w-100" alt="Cirtificate Image 1">
                            </div>
                            
                            <div class="carousel-item ">
                                <img data-src="/assets/frontend/images/homepageclassrromimg3.jpg" width="576" height="432" class="lazyload d-block w-100" alt="Cirtificate Image 1">
                            </div>
                            
                            <div class="carousel-item ">
                                <img data-src="/assets/frontend/images/homepageclassrromimg4.jpg" width="576" height="432" class="lazyload d-block w-100" alt="Cirtificate Image 1">
                            </div>
                            
                            <div class="carousel-item ">
                                <img data-src="/assets/frontend/images/homepageclassrromimg5.jpg" width="576" height="432" class="lazyload d-block w-100" alt="Cirtificate Image 1">
                            </div>
                            
                            <div class="carousel-item ">
                                <img data-src="/assets/frontend/images/homepageclassrromimg6.jpg" width="576" height="432" class="lazyload d-block w-100" alt="Cirtificate Image 1">
                            </div>
                            
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span> </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span> </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

 

    <section class="enquiry_mobile_form d-block d-lg-none d-md-none"> 
        <div class="container">

        @include('frontend.component.common_form', [
                'section' => 'Home Page - Class Room Training Section - Book A Free Demo - Mobile View',
                'title'  => 'Book a <b>FREE</b> Demo',
                'Headingclassname'  => 'color_white',
            ])

        </div>
    </section>

    <!--Free learning-->

    <section class="lms pt-lg-5 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="lms_heading pt-md-4 pt-0">
                        Free Learning Management System(LMS) Included with Training
                    </h2>
                    <p class="lms_para pb-4"> You get access to topic wise Live Recorded Lectures of our courses on Learning
                        Management System(LMS), lectures on LMS are updated regularly and even new topics are added whenever
                        required, you can access LMS even after course is completed, so revision and upgrading yourself in
                        future is easy </p>
                    <div class="training_btn"> <a target="_blank" href="https://lms.attariclasses.in/">Visit Video
                            Portal</a> </div>
                </div>
                <div class="col-md-6 lms_img"><img data-src="/assets/frontend/images/lms_images123.png" width="576"
                        height="422" class="lazyload" alt="Learning Image"> </div>
            </div>
        </div>
    </section>

    <!--adv lms-->

    @include('frontend.component.advantage_of_lms_section')

    <!--Certificate-->

    @php

    $certificates = DB::table('certificates as c1')
        ->whereIn('c1.course_id', [5, 7, 8, 9, 10])
        ->where('c1.status', '1')
        ->select('c1.course_id', 'c1.image', 'c1.alt_image', 'c1.created_at as latest_created_at')
        ->join(DB::raw('(SELECT course_id, MAX(created_at) as max_created_at
                        FROM certificates
                        WHERE course_id IN (5, 7, 8, 9, 10) AND status = \'1\'
                        GROUP BY course_id) as c2'), function ($join) {
                            $join->on('c1.course_id', '=', 'c2.course_id')
                                ->on('c1.created_at', '=', 'c2.max_created_at');
                        })
        ->orderBy('c1.course_id', 'ASC')                
        ->orderBy('c1.created_at', 'ASC')
        ->get();
        
        $a = 1;

    @endphp

    <section class="Certificate">
        <div class="container">
            <div class="row">
                <div class="col-md-6 Certificate_box">
                    <h2 class="Certificate_heading pt-md-5 mt-md-3">
                        Earn Industry-Recognized Credentials
                    </h2>
                    <p class="Certificate_para mb-md-5 mb-4"> Certification plays an Important role in proving your skills,
                        Hands-on practical training at Attari Classes will clear your concepts and make you exam ready. We
                        provide Practice exams and learning material for free which prepares you to answer the question
                        asked in actual exam, most of the candidates have passed exam in one attempt </p>
                    <div class="training_btn none">
                        <button type="button" class="btn bookfreedemo_button" onclick="formModal('{{ url(route('component.form')) }}?section=Certificate section - Home Page&title=Get Certified&current_page={{ urlencode(url()->current()) }}')"> Get Certified </button>
                    </div>
                </div>

                <div class="col-md-6">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">

                        <div class="carousel-inner">

                            @foreach($certificates as $row)
                                <div class="carousel-item @if($a == '1') active @endif" data-bs-interval="10000"> 
                                    <img data-src="{{ asset('storage/' . $row->image) }}" width="576" height="450"
                                    class="lazyload d-block w-100" alt="{{ $row->alt_image }}">
                                </div>
                                @php $a++; @endphp
                            @endforeach
                            
                        </div>
                        
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span> </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span> </button>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--Testimonial-->

    <section id="testimonials" class="testiminilas_sec pt-md-5 pt-3 pb-md-5 pb-3 gray_bgg1">
        <div class="container">
            <h3 class="main_heads text-center mb-4">
                What our <strong>Students</strong> says?
            </h3>

            @include('frontend.component.review_video')

            <!--comment -->

            @include('frontend.component.review_comment')


            <div class="view_allbutton text-center"> <a href="reviews"> View All
                    <i class="fas fa-arrow-right" aria-hidden="true"></i></a></div>
        </div>
    </section>

    <section class="enquiry_mobile_form d-block d-lg-none d-md-none">
        <div class="container">
        @include('frontend.component.common_form', [
                'section' => 'Home Page - Bottom Section - Book A Free Demo - Mobile View',
                'title'  => 'Book a <b>FREE</b> Demo',
                'Headingclassname'  => 'color_white',
            ])
        </div>
    </section>

    <!--DropDown-->
    
    
    
    
     <section class="trainer-section">
    <div class="container">

        <div class="trainer-header">
           
           
  <h2 class="main_heads text-center mb-4">
                Meet Our  <strong>Expert Trainers</strong>
            </h2>
            <p>
               Practical IT Training in VMware vSphere, AWS Cloud, Microsoft Azure Cloud, Windows Server Hybrid & Networking by Industry Expert Trainers.

            </p>
        </div>

        <div class="trainer-grid">

            <!-- Trainer 1 -->
            <div class="trainer-card">
                <div class="trainer-label-box">
                     <h3>Mr. Maqsood Sheikha</h3>
                    <p class="trainer-designation">
                        VMware & AWS Cloud Trainer
                    </p>
                </div>

                <div class="trainer-content">
                   

                    <ul>
                        <li>Training Since 2011</li>
                        <li>10,000+ Students Trained</li>
                        <li>VMware vSphere & AWS Cloud Specialist</li>
                        <li>Enterprise IT Infrastructure Project Experience</li>
                        <li>Students Across India, Gulf Countries & North America</li>
                    </ul>

                    <button type="button" class="trainer-btn" data-modal="maqsoodModal">
                        View Full Profile
                    </button>
                </div>
            </div>

            <!-- Trainer 2 -->
            <div class="trainer-card">
                <div class="trainer-label-box">
                    <h3>Mr. Zameer Momin</h3>

                    <p class="trainer-designation">
                        Microsoft Azure, Windows Server Hybrid & Networking Trainer
                    </p>
                </div>

                <div class="trainer-content">
                   

                    <ul>
                        <li>Training Since 2017</li>
                        <li>8,000+ Students Trained</li>
                        <li>Azure, Windows Server Hybrid & CCNA Networking</li>
                        <li>Enterprise Infrastructure Experience</li>
                        <li>Students Across India, Gulf Countries & North America</li>
                    </ul>

                    <button type="button" class="trainer-btn" data-modal="zamirModal">
                        View Full Profile
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>


            <!-- Mr. Maqsood Sheikha - Person Schema -->
            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "Person",
                    "@id": "https://attariclasses.in/#maqsood-sheikha",
                    "name": "Maqsood Sheikha",
                    "jobTitle": "VMware & AWS Cloud Trainer",
                    "worksFor": {
                    "@id": "https://attariclasses.in/#organization"
                },
                    "memberOf": {
                    "@id": "https://attariclasses.in/#organization"
                },
                    "alumniOf": {
                    "@type": "CollegeOrUniversity",
                    "name": "Saboo Siddik College of Engineering"
                },
                    "description": "Experienced VMware and AWS Cloud trainer with real-time enterprise infrastructure and virtualization expertise. Training students since 2011 with practical hands-on lab sessions.",
                    "knowsAbout": [
                    "VMware vSphere",
                    "VMware Virtualization",
                    "AWS Cloud Computing",
                    "Cloud Computing",
                    "Virtualization",
                    "Data Center Technologies",
                    "Enterprise Infrastructure"
                ],
                    "hasOccupation": {
                    "@type": "Occupation",
                    "name": "VMware & AWS Cloud Computing Trainer"
                },
                    "sameAs": [
                    "https://www.linkedin.com/in/maqsood-sheikha/"
                ]
            }
            </script> 

            
            
           <!-- Mr. Zameer Momin - Person Schema -->
            <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "Person",
              "@id": "https://attariclasses.in/#zameer-momin",
              "name": "Zameer Momin",
              "jobTitle": "Microsoft Azure, Windows Server Hybrid & CCNA Trainer",
              "worksFor": {
                "@id": "https://attariclasses.in/#organization"
              },
              "memberOf": {
                "@id": "https://attariclasses.in/#organization"
              },
              "alumniOf": {
                "@type": "CollegeOrUniversity",
                "name": "K. J. Somaiya College"
              },
              "description": "Experienced Microsoft Azure, Windows Server Hybrid, and CCNA Networking trainer with practical enterprise infrastructure expertise. Associated with IT training since 2017.",
              "knowsAbout": [
                "Microsoft Azure",
                "Windows Server Hybrid",
                "CCNA Networking",
                "Cloud Computing",
                "Enterprise Infrastructure",
                "Networking"
              ],
              "hasOccupation": {
                "@type": "Occupation",
                "name": "Azure Cloud, Windows Server Hybrid & CCNA Networking Trainer"
              }
            }
            </script>


            
            <!-- Maqsood Modal -->
<div class="trainer-modal-overlay" id="maqsoodModal">
    <div class="trainer-modal">
        <div class="trainer-modal-header">
            <button type="button" class="trainer-modal-close">&times;</button>

            <div class="trainer-modal-profile">
               
                <div>
                    <div class="header-title">Mr. Maqsood Sheikha</div>
                    <p>VMware & AWS Cloud Trainer</p>
                </div>
            </div>
        </div>

        <div class="trainer-modal-body">
          
            <p>
                Mr. Maqsood Sheikha completed his engineering graduation from Saboo Siddik College
                of Engineering in 2006 and started his professional journey in the IT industry.
                Over the years, he has worked on multiple enterprise IT infrastructure and cloud projects
                for reputed organizations through professional deployments and consulting assignments.
            </p>

            <p>
                He has served projects associated with companies including JPMorgan Chase & Co.,
                Nomura Holdings, Air India, Dmart, Kotak Life Insurance, Wipro Infotech,
                Allied Digital, and CMC, a Tata Group subsidiary.
            </p>

            <p>
                Since 2011, he has been actively involved in the IT training industry and has successfully
                trained more than 10,000 students from India and across the world. Students from Mumbai,
                Delhi, Bangalore, Hyderabad, Chennai, Pune, and other major cities of India, along with
                students from Gulf countries including Dubai and Saudi Arabia, and learners from North America
                and the USA have attended his training programs.
            </p>

            <div class="expertise">His Expertise Includes</div>

            <ul>
                <li>VMware vSphere Virtualization</li>
                <li>AWS Cloud Computing</li>
                <li>Data Center Virtualization</li>
                <li>Cloud Infrastructure Training</li>
                <li>AWS Solutions Architecture</li>
            </ul>

            <p>
                Students appreciate his practical teaching style, real-time scenario-based explanations,
                interview preparation guidance, and beginner-friendly approach.
            </p>
        </div>
    </div>
</div>

<!-- Zameer Modal -->
<div class="trainer-modal-overlay" id="zamirModal">
    <div class="trainer-modal">
        <div class="trainer-modal-header">
            <button type="button" class="trainer-modal-close">&times;</button>

            <div class="trainer-modal-profile">
              
                <div>
                    <div class="header-title">Mr. Zameer Momin</div>
                    <p>Microsoft Azure, Windows Server Hybrid & Networking Trainer </p>
                </div>
            </div>
        </div>

        <div class="trainer-modal-body">
            
            <p>
                Mr. Zameer Momin is an experienced IT infrastructure and cloud trainer specializing in Microsoft Azure Cloud, Windows Server Hybrid Administration, Networking, and Enterprise IT technologies.

            </p>

            <p>
                After completing his Computer Engineering degree in 2008 from K.J Somaiya College, he started his professional career in the IT industry with a strong focus on networking technologies. With certifications including CCNA and CCNP, he built strong expertise in enterprise networking before gradually moving into Microsoft Azure Cloud and Windows Server Hybrid technologies.

            </p>

            <p>
               He has served projects associated with companies including NIIT Technologies, Eclerx, First Source, HCL Comnet, Holcim and Patni Computers

            </p>

            <p>
               Since 2017, he has been actively associated with Attari Classes as a trainer and mentor, helping students and working professionals build successful careers in cloud computing and infrastructure administration.

            </p>

            <p>
                He has successfully trained more than 8,000 students from India and across the world. Students from Mumbai, Delhi, Bangalore, Hyderabad, Chennai, Pune, and other major cities of India, along with students from Gulf countries including Dubai and Saudi Arabia, and learners from North America and the USA have attended his training programs.

            </p>

            <div class="expertise">His expertise includes:</div>

            <ul>
                <li>Microsoft Azure Cloud Administration</li>
                <li>Windows Server Hybrid Infrastructure</li>
                <li>CCNA Networking</li>
            </ul>

            <p>
                Students appreciate his simplified teaching style, practical implementation approach, troubleshooting guidance, and strong focus on real-world concepts
            </p>
        </div>
    </div>
</div>

    <section class="faq pt-md-5 mt-4 best-institue">
        <div class="container">
            <div class="row">
                <div class="col-12 faq_box">
                    <div class="question">
                        <h1 class="text_services_heading1">
                            Best Institute for VMware, AWS, AZURE, MCSE, CCNA Training in
                            Mumbai
                        </h1> <i class="fas fa-arrow-right"></i>
                    </div>
                    <div class="answer">
                        <p> Attari Classes is the preferred Training Institute for VMware VCP certification training in
                            India. We provide latest trending courses like AWS Cloud Solution Architect, Aure Cloud
                            Administrator, CCNA-Networking Course and MCSE- Windows Server course. </p>
                        <p> Attari Classes provides both classroom and online training for domestic and international
                            students all over the world. We are one of the reliable and trustworthy learning centers for
                            VMware VCP Certification, Azure Certification AZ-104, AWS Solution Architect- Associate
                            Certification SAA-C02, and CCNA Certification Courses. We are also one of the leading, trusted,
                            and preferred Training providers to Corporates across India for various courses. </p>
                        <p> Attari Classes also provide options of Video learning using our Learning Management System(LMS)
                            for VMware vSphere, AWS Cloud, Azure Cloud, MCSE, and CCNA Courses, you can learn at your own
                            pace and do practicals using cloud-based labs or download the software required for labs using
                            the guidance given in our LMS. </p>
                        <h2 class="faq_inner_head">Attari Classes Training Programs</h2>
                        <div class="test_heading_inner"> <i> We provide Hands-on Live Practical training for</i> </div>
                        <ul class="test_ul">
                            <li> <a href="https://attariclasses.in/vmware-training-certification-online/">1. VMware
                                    vSphere</a>
                            </li>
                            <li>
                                <a href="https://attariclasses.in/aws-certification-training-online/">2. AWS Cloud Solution
                                    Architect</a>
                            </li>
                            <li>
                                <a href="https://attariclasses.in/microsoft-azure-certification-training-online/">3. Azure
                                    Cloud Administration</a>
                            </li>
                            <li>
                                <a href="https://attariclasses.in/mcsa-mcse-windows-server-training-online/">4. MCSE-
                                    Windows Server</a>
                            </li>
                            <li>
                                <a href="https://attariclasses.in/ccna-training-certification-online/">5. CCNA- Computer
                                    Networking</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--home content end-->
@endsection
