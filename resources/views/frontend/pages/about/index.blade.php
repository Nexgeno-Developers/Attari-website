@extends('frontend.layouts.app')

@section('page.title', 'About Us - Attari Classes')

@section('page.description', 'Attari Classes is one of the leading IT Training Center. Google and Facebook reviews are enough to prove our excellency in teaching')

@section('page.type', 'website')

@section('page.content')

    <!-- -------------------- About banner start ---------------- -->

    <section class="about_page">
        
        <section class="sm-at banner1">
            <img class="inner-banner-image" src="assets/frontend/images/aboutus_banner-1.jpg"/>
        <div class="mt235">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrums_section paddtb80">
                            <h1 class="sm-aboutus color-white1">About Us</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ url(route('index')) }}">Home</a></li>
                                    <li class="breadcrumb-item"><a>»</a></li>
                                    <li class="breadcrumb-item"><a><b>About Us</b></a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        
        <section class="about_attari_classes">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="aboutpg_hed"> Attari <span class="dark">Classes</span> </h2>
                        <p> Attari Classes is an IT training institute for VMware vSphere, AWS Cloud, Azure Cloud, Windows Server Hybrid and CCNA course </p>
                        <p> We provide Instructor led Live Online training to candidates across the globe & Classroom
                            Training in Mumbai, we also have self paced training options (Video Learning) </p>
                        <p> The world class training at Attari Classes is offered through several innovative learning
                            methods and delivery models to cater the unique requirements of a global customer base which
                            emphasize on maximum practical learning </p>
                    </div>
                    <div class="col-md-6 image"> <img src="/assets/frontend/images/Photo-Gallery-6.jpg" alt="" /> </div>
                </div>
            </div>
        </section>
        <!-- --------Our Mission------------ -->
        <section class="about_mission">
            <div class="">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="aboutpg_hed white_color"> Our <span class="light">Mission</span> </h4>
                            <p class="fs-18" style="font-size:16px !important"> Our mission is to provide quality education with hands-on practical and make
                                understand practical scenarios, all this at very affordable fees. Unlike many others we are
                                specialized in providing training only on few courses so quality is never compromised </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ------------------- Our Achivement---------------------- -->
        <section class="our_achivement">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text_content">
                        <h4 class="aboutpg_hed pt-4"> Our <span class="light display_black">Achievements</span> </h4>
                        <p> Today the name Attari Classes is brand for IT Trainings in Mumbai, we have trained more than
                            6000 candidates working in IT companies like Wipro, TCS, Infosys, Accenture, Capgemeini, etc
                        </p>
                        <p> We have trained candidates across India and other countries like UAE, Oman, Australia,
                            Singapore, USA, Canada, UK, etc. </p>
                        <p> With high end IT infra for practical’s, Attari Classes have fulfilled the demand of candidates
                            for hands-on practical training </p>

                            <button type="button" onclick="formModal('{{ url(route('component.form')) }}?section=Our Achievements - About-us Page&title=Book a FREE Demo&current_page={{ urlencode(url()->current()) }}')" 
                                    class="btn bookfreedemo_button none"> Book a Demo</button>

                    </div>
        <!-----=================================   Certificates ===============----------------->
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


                    <div class="col-md-6">
                        <div class="about_our_slider">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">

                                    @foreach($certificates as $row)
                                        <div class="carousel-item @if($a == '1') active @endif" data-bs-interval="10000"> 
                                            <img data-src="{{ asset('storage/' . $row->image) }}" width="576" height="450"
                                            class="lazyload d-block w-100" alt="{{ $row->alt_image }}">
                                        </div>
                                        @php $a++; @endphp
                                    @endforeach


                                </div>
                                
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                    data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span> 
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="next"> <span
                                    class="carousel-control-next-icon" aria-hidden="true"></span> <span
                                    class="visually-hidden">Next</span> 
                                </button>

                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </section>


        <section class="enquiry_mobile_form d-block d-lg-none d-md-none">
            <div class="container">
                @include('frontend.component.common_form', [
                'section' => 'About Us Page - After Our Achivement Section - Book A Free Demo - Mobile View',
                'title'  => 'Book a <b>FREE</b> Demo',
                'Headingclassname'  => 'color_white',
            ])
            </div>
        </section>

        <!-- ------------------------ our infras------------------->
        <section class="our_infras gray_bgg1 pt-4 pb-4 pt-lg-0 pb-lg-0">
            <div class="container">
                <div class="row">

                    <div class="col-md-5 d-flex pt-md-5 ps-md-5 justify-content-center flex-column order-md-2">
                        <h4 class="aboutpg_hed"> Our <span class="light display_black">Infrastructure</span> </h4>
                        <p class="para"> We Provide High end Labs for Hands-on practical training </p>
                        
                        <button type="button" onclick="formModal('{{ url(route('component.form')) }}?section=Our Infrastructure - About-us Page&title=Enquire Now&current_page={{ urlencode(url()->current()) }}')" 
                        class="btn bookfreedemo_button none d-none d-lg-block"> Enquire Now </button>
                    </div>



                    <div class="col-md-7 img_content order-md-1">
                        <div class="row">
                            <div class="col-6 padd4 marginleftright0">
                                <div class="gallery_boxex">
                                    <a href="/assets/frontend/images/our_infraimg5.jpg" data-fancybox="gallery"> <img
                                            src="/assets/frontend/images/our_infraimg5.jpg" data-src="/assets/frontend/images/our_infraimg5.jpg" /> </a>
                                </div>
                            </div>
                            <div class="col-6 padd4 marginleftright0">
                                <div class="gallery_boxex">
                                    <a href="/assets/frontend/images/our_infraimg6.jpg" data-fancybox="gallery"> <img
                                            src="/assets/frontend/images/our_infraimg6.jpg" data-src="/assets/frontend/images/our_infraimg6.jpg" /> </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 padd4 marginleftright0">
                                <div class="gallery_boxex">
                                    <a href="/assets/frontend/images/our_infraimg7.jpg" data-fancybox="gallery"> <img
                                            src="/assets/frontend/images/our_infraimg7.jpg" data-src="/assets/frontend/images/our_infraimg7.jpg" /> </a>
                                </div>
                            </div>
                            <div class="col-6 padd4 marginleftright0">
                                <div class="gallery_boxex">
                                    <a href="/assets/frontend/images/our_infraimg8.jpg" data-fancybox="gallery"> <img
                                            src="/assets/frontend/images/our_infraimg8.jpg" data-src="/assets/frontend/images/our_infraimg8.jpg" /> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!---------------------------------location---------------------->
        <section class="about_location">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 location_box_1 d-flex pt-md-5 pe-5 justify-content-center flex-column">
                        <h4 class="aboutpg_hed pt-md-4"> Our <span class="light display_black">Location</span> </h4>
                        <p> We are at located at one of the finest location in Mumbai at Kanakia Zillion </p>
                        <div class="mt-4"> <a>
                                View On Google
                                <i aria-hidden="true" class="fas fa-arrow-right"></i>
                            </a> </div>
                        <button type="button" onclick="formModal('{{ url(route('component.form')) }}?section=Our Infrastructure - About-us Page&title=Contact Us&current_page={{ urlencode(url()->current()) }}')" 
                        class="btn bookfreedemo_button none d-none d-lg-block mt-3"> Contact Us</button>
                    </div>
                    <div class="col-md-7 img_content">
                        <div class="row">
                            <div class="col-6 padd4 marginleftright0">
                                <div class="gallery_boxex">
                                    <a href="/assets/frontend/images/Photo-Gallery-4.jpg" data-fancybox="gallery"> <img
                                            src="/assets/frontend/images/Photo-Gallery-4.jpg" data-src="/assets/frontend/images/Photo-Gallery-4.jpg" /> </a>
                                </div>
                            </div>
                            <div class="col-6 padd4 marginleftright0">
                                <div class="gallery_boxex">
                                    <a href="/assets/frontend/images/Photo-Gallery-11.jpg" data-fancybox="gallery"> <img
                                            src="/assets/frontend/images/Photo-Gallery-11.jpg" data-src="/assets/frontend/images/Photo-Gallery-11.jpg" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 padd4 marginleftright0">
                                <div class="gallery_boxex">
                                    <a href="/assets/frontend/images/Photo-Gallery-6.jpg" data-fancybox="gallery"> <img
                                            src="/assets/frontend/images/Photo-Gallery-6.jpg" data-src="/assets/frontend/images/Photo-Gallery-6.jpg" /> </a>
                                </div>
                            </div>
                            <div class="col-6 padd4 marginleftright0">
                                <div class="gallery_boxex">
                                    <a href="/assets/frontend/images/Photo-Gallery-2.jpg" data-fancybox="gallery"> <img
                                            src="/assets/frontend/images/Photo-Gallery-2.jpg" data-src="/assets/frontend/images/Photo-Gallery-2.jpg" /> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>


    <section class="enquiry_mobile_form d-block d-lg-none d-md-none">
        <div class="container">
            @include('frontend.component.common_form', [
                'section' => 'About Us Page - Bottom Section - Book A Free Demo - Mobile View',
                'title'  => 'Book a <b>FREE</b> Demo',
                'Headingclassname'  => 'color_white',
            ])
        </div>
    </section>

@endsection
