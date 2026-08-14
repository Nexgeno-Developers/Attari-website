@extends('frontend.layouts.app')



@php 
    $page_title = ReplaceKeyword($detail->meta_title, $cms->replace_keyword);
    $page_description = ReplaceKeyword($detail->meta_description, $cms->replace_keyword);  
    // $courseInputName  = $detail->alias2;  
    $courseInputName  = $cms->menu_title;
    $courseAlias  = $detail->alias;  
    $cId  = $detail->id;  
@endphp

@php

    $description = strip_tags(html_entity_decode($page_description));
    $description = html_entity_decode($description);
    $wordLimit = 155; // Set your desired word limit

    // Split the string into an array of words
    $words = preg_split('/\s+/', $description, -1, PREG_SPLIT_NO_EMPTY);

    // Limit the array to the desired number of words
    $limitedWords = array_slice($words, 0, $wordLimit);

    // Join the limited words back into a string
    $tem_desc = implode(' ', $limitedWords); 
    

    $meta_title = $cms->title;
    $meta_description = $tem_desc;
    $meta_url = url()->current();
@endphp 

@section('page.title', $page_title)

@section('page.description', $tem_desc)

@section('page.type', 'website')

@section('page.content')

    <!----------========== courses start ===============-------------------->
    <section class="vm_banner pb-lg-4 pt-lg-4 pb-4 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-9 width70">

                    <div class="col-12">
                        <div class="breadcrums_section pb-4">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ url(route('index')) }}">Home</a></li>
                                    <li class="breadcrumb-item"><a>»</a></li>
                                    <li class="breadcrumb-item"><a><b>{{ $cms->breadcrumb_title }}</b></a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>


                    <div class="top_content_section">
                        <h1>{{ $cms->title }}</h1>
                        <p class="rating "> {{ $detail->rating }}
                            <img class="star_icon rating_img" src="/assets/frontend/images/star_new_icon.png" alt="star icon">
                            <img class="star_icon" src="/assets/frontend/images/star_new_icon.png" alt="star icon">
                            <img class="star_icon" src="/assets/frontend/images/star_new_icon.png" alt="star icon">
                            <img class="star_icon" src="/assets/frontend/images/star_new_icon.png" alt="star icon">
                            <img class="star_icon" src="/assets/frontend/images/star_new_icon.png" alt="star icon">
                            ({{ $detail->total_review }}) Rating
                        </p>

                        <div class="show_mobileview imagebox d-flex align-items-center justify-content-center">

                    @php
                        // Assuming $row->url contains the YouTube URL
                        if (strpos($detail->url, 'embed/') === false) {
                            $videoID = basename($detail->url);
                            $youtube_url_detail = 'https://youtu.be/embed/' . $videoID; // Corrected the concatenation
                        } else {
                            $youtube_url_detail = $detail->url; // URL already in the correct format
                        }
                    @endphp


                    <a href="{{ $youtube_url_detail }}" data-fancybox="gallery">
                        <img src="{{ asset('storage/' . $detail->other_thumbnail) }}"
                            class="img-fluid d-block w-100" alt="">
                                
                        <div class="pulse-button space_1"></div>
                    </a>

                </div>


                        <div class="desc pe-lg-4 pe-0">
                            @php echo ReplaceKeyword($cms->description, $cms->replace_keyword) @endphp
                        </div>
                    </div>
                    <button type="button" class="btn coursepg_enquiryform" onclick="formModal('{{ url(route('component.form')) }}?section=Enquire Form Top - course Page&title=Enquire Now&current_page={{ urlencode(url()->current()) }}&course_name={{$courseInputName}}')"> Enquire Now </button>
                    <div class="check_carriculam"><a href="#syllabus" class="check_curriculum"> Check Curriculum </a></div>
                </div>
                <div class="show_desktopview col-3 width30 imagebox d-flex align-items-center justify-content-center">

                    @php
                        // Assuming $row->url contains the YouTube URL
                        if (strpos($detail->url, 'embed/') === false) {
                            $videoID = basename($detail->url);
                            $youtube_url_detail = 'https://youtu.be/embed/' . $videoID; // Corrected the concatenation
                        } else {
                            $youtube_url_detail = $detail->url; // URL already in the correct format
                        }
                    @endphp


                    <a href="{{ $youtube_url_detail }}" data-fancybox="gallery">
                        <img src="{{ asset('storage/' . $detail->other_thumbnail) }}"
                            class="img-fluid d-block w-100" alt="">
                        <div class="pulse-button space_1"></div>
                    </a>

                </div>
            </div>
        </div>
    </section>


    <section class="vm_nav" id="vm_nav">
        <div class="container">
            <div id="version" class="version highlight-bar">
                <nav class="nav-sections">
                    <ul class="menu menu34">
                        <li class="menu-item">
                            <a class="menu-item-link active" href="{{request()->url()}}/#key_features" data-href="#key_features">Key Feature</a>
                        </li>
                        
                        <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#overviews" data-href="#overviews">Overview</a>
                        </li>
                        
                        <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#syllabus" data-href="#syllabus">Course Content</a>
                        </li>
                        
                        
                        <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#projects_covered" data-href="#projects_covered">Project</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#certificate_section" data-href="#certificate_section">Certificate</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#testimonials" data-href="#testimonials">Testimonials</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#batch_shedule" data-href="#batch_shedule">Batch Schedule</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#trainer_profile" data-href="#trainer_profile">Trainer Profile</a>
                        </li>
                        @if (!empty($faq) && $faq->count() > 0)
                        <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#faqs" data-href="#faqs">FAQ</a>
                        </li>
                        @endif
                        
                        <div class="active-line"></div>
                    </ul>
                </nav>
            </div>
        </div>
    </section>


    <!-----------------key features---------------------->

    <div class="page-sections">
        <section id="key_features" class="page-section key_features py-5 position_relative zindex_1111111">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section_heading pb-lg-3 pb-0 text-center textcolor_blck mb-3">{{ $detail->key_title }} Key
                            Features
                        </h2>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-md-2">
                        <div class="key_boxes">
                            <div class="key_features_icon">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                            <p> Instructor led live Training </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-md-2">
                        <div class="key_boxes">
                            <div class="key_features_icon">
                                <i class="fa fa-laptop" aria-hidden="true"></i>
                            </div>
                            <p> Hands-on Practical Training </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-md-2">
                        <div class="key_boxes">
                            <div class="key_features_icon">
                                <i class="fa-solid fa-headset"></i>
                            </div>
                            <p> Trainer Support on WhatsApp </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-md-2">
                        <div class="key_boxes">
                            <div class="key_features_icon">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <p> Recorded lectures on LMS </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-md-2">
                        <div class="key_boxes">
                            <div class="key_features_icon">
                                <i class="fa fa-book" aria-hidden="true"></i>
                            </div>
                            <p> Access to Learning Portal </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-md-2">
                        <div class="key_boxes">
                            <div class="key_features_icon">
                               <i class="fa-solid fa-file"></i>
                            </div>
                            <p> Certificate from Attari classes </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-md-2">
                        <div class="key_boxes">
                            <div class="key_features_icon">
                                <i class="fa-solid fa-users-gear"></i>
                            </div>
                            <p> Access to forum for new Job Openings </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-md-2">
                        <div class="key_boxes">
                            <div class="key_features_icon">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <p> Support Desk for Student </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!---------============== overviews ====================----------------------->

        <section id="overviews" class="page-section overview py-5 position_relative zindex_111111 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 width70">
                        <h2 class="section_heading pb-3 text-center textcolor_blck">
                            {{ $detail->overview_section_heading }}
                        </h2>
                        <div>
                            @php echo ReplaceKeyword($detail->course_overview, $cms->replace_keyword) @endphp
                        </div>

                        @if (!empty($detail->faq))
                            <div class="accordion--container1 accordion_style1">

                                @php
                                    $course_faq = json_decode($detail->faq);
                                    $i = 1;
                                @endphp

                                @foreach ($course_faq as $faq1)
                                    @foreach ($faq1 as $title => $description)
                                        <li class="accordion1">
                                            <span> @php echo ReplaceKeyword($title, $cms->replace_keyword) @endphp <i class="fa fa-angle-up"></i>
                                            </span>
                                            <div class="contentsillabus_div">
                                                <div class="txt">
                                                    @php echo ReplaceKeyword($description, $cms->replace_keyword) @endphp
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endforeach

                            </div>
                        @endif


                    </div>
                    <div class="col-md-3 width30 position_sticky">
                        <div class="talktous_box">
                            <i class="fa-sharp fa-solid fa-phone"></i>
                            <p class="mb-3">Talk To Us</p> 
                            <p>
                                <a href="tel:+917738375431">+91 7738375431</a>
                            </p>
                            <p>
                                <a href="mailto:info@attariclasses.in">info@attariclasses.in</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>



    <!---------===================== syllabas section ==================-------------------------------->


        <section id="syllabus" class="page-section syllabus_section gradiant_bg pt-5 pb-5 position_relative zindex_11111">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 width70">
                        <h2 class="section_heading pb-3 textcolor_wht float_left"> {{ $detail->syllabus_section_heading }}
                        </h2>
                        
                     @if(request()->is('aws-certification-training-online'))
                        <style>
                            .online_css {
                                display: inline-block;
                                width: 100%;
                                color: #fff;
                                margin-top: -15px;
                                padding-bottom: 0px;
                            }
                    
                            @media (max-width: 767px) {
                                .online_css {
                                    width: 100%;
                                    text-align: center;
                                }
                            }
                        </style>
                    
                        <p class="online_css">
                            Looking for the latest SAA-C03 detailed syllabus? You can view the full curriculum below or download the complete AWS Solution Architect syllabus PDF for offline reference.
                        </p>
                    @endif
                    
                    
                    @if(request()->is('vmware-training-certification-online'))
                        <style>
                            .online_css {
                                display: inline-block;
                                width: 100%;
                                color: #fff;
                                margin-top: -15px;
                                padding-bottom: 0px;
                            }
                    
                            @media (max-width: 767px) {
                                .online_css {
                                    width: 100%;
                                    text-align: center;
                                }
                            }
                        </style>
                    
                        <p class="online_css">
                           Looking for the latest VMware vSphere detailed syllabus or VCP certification syllabus? You can view the complete module-wise VMware course content below or download the VMware syllabus PDF for offline reference.
                        </p>
                    @endif
                    
                        
                       @if(!empty($detail->curriculum_pdf))

                            @php
                                session()->put('pagecourse', $cms->breadcrumb_title);
                            @endphp
                        
                        
                        
                        @endif
                        
                        


                        <div style="clear:both"></div>

                                @php $i = 1; @endphp

                                @if (!empty($syllabus))
                                    <div class="accordion--container1 accordion_style1 syllabus-accordion">
        
                                        @foreach ($syllabus as $row)
                                            <li class="accordion1 @if($i == 1) open @endif">
                                                <span> Module {{ $i }}:- @php echo ReplaceKeyword($row->title, $cms->replace_keyword) @endphp <i class="fa fa-angle-up"></i>
                                                </span>
                                                <div class="contentsillabus_div" style="@if($i == 1) display:block; @endif">
                                                    <div class="txt">
                                                        @php echo ReplaceKeyword($row->description, $cms->replace_keyword) @endphp
                                                    </div>
                                                    @if(!empty($detail->curriculum_pdf))
                                                        <a class="module_download_brochure showFormBtnCurriculum" href="javascript:void(0)">
                                                            <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                                           {{ explode(' ', trim($cms->menu_title ?? $cms->breadcrumb_title))[0] }}   Syllabus on WhatsApp
                                                        </a>
                                                    @endif
                                                </div>
                                            </li>
                                            @php $i++ @endphp
                                        @endforeach
        
        
                                    </div>
                                @endif



                    </div>

            <!----=============================== Syllabus Schema ==============------------------------------->



         @php
            $s = 1;    
        @endphp
        
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@id": "{{$meta_url}}",
                "@type": "Course",
                "name": "{{$meta_title}}",
                "description": "{{$meta_description}}",
                "publisher": {
                    "@type": "Organization",
                    "name": "Attari Classes",
                    "url": "https://attariclasses.in"
                },
                "provider": {
                    "@type": "Organization",
                    "name": "Attari Classes",
                    "url": "https://attariclasses.in"
                },
                "image": [
                    "{{ asset('storage/' . $detail->other_thumbnail) }}"
                ],
                "offers": [
                    {
                        "@type": "Offer",
                        "category": "Partially Free"
                    }
                ],
                "educationalLevel": "Beginner",
                "inLanguage": "en",
                "hasCourseInstance": {
                    "@type": "CourseInstance",
                    "courseMode": "Online",
                    "courseWorkload": "PT3H"
                },
                "teaches": [
                    "{{ $courseAlias }} online training",
                    "{{ $courseAlias }} course",
                    "{{ $courseAlias }} certification"
                ],
                "educationalCredentialAwarded": {
                    "@type": "EducationalOccupationalCredential",
                    "name": "Attari Classes Online Certification",
                    "credentialCategory": "Certificate",
                    "offers": {
                        "@type": "Offer",
                        "category": "Partially Free"
                    }
                },
                "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": {{ $detail->rating }},
                    "ratingCount": {{ $detail->total_review }},
                    "bestRating": 5
                },
                    "syllabusSections": [
                            @foreach ($syllabus as $row)
                                @if($s <= 5)
                                    {
                                        "name": "Module {{ $s }}: {{ addslashes(ReplaceKeyword($row->title, $cms->replace_keyword)) }}",
                                        "description": "{{ schema_ReplaceKeyword($row->description, $cms->replace_keyword) }}"
                                    }@if($s < 5),@endif
                                    @php $s++; @endphp
                                @endif
                            @endforeach
                        ]
            }
         </script>
         
         <script type='application/ld+json'>
{
	"@context": "http://schema.org",
	"@type": "Product",
    "name": "{{$meta_title}}",
    "url":"{{$meta_url}}",
	"aggregateRating": {
		"@type": "AggregateRating",
		"ratingValue": {{ $detail->rating }},
		"ratingCount": {{ $detail->total_review }},
		"reviewCount": "10"
	}
}
</script>
         
       <!-- @php
            $s = 1;    
        @endphp
        
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "ItemList",
                "itemListElement": [
                        @foreach ($syllabus as $row) @if($s <= 5)
                            {
                                "@type": "ListItem",
                                "position": {{ $s }},
                                "item": {
                                    "@type": "Course",
                                    "url":"{{ $meta_url }}#CourseContent",
                                    "name": "Module {{ $s }}:- @php echo ReplaceKeyword($row->title, $cms->replace_keyword) @endphp",
                                    "description": "@php echo schema_ReplaceKeyword($row->description, $cms->replace_keyword) @endphp",
                                    "provider": {
                                        "@type": "Organization",
                                        "name": "Attari Classes",
                                        "sameAs": "https://attariclasses.in/"
                                    }
                                }
                            },
                            @endif @php $s++ @endphp @endforeach
                ]
            }
        </script>-->



            <!----=============================== Syllabus Schema ==============------------------------------->  


                    <div class="col-md-3 width30 position_sticky">
                        <div class="bookdemofreeform_course gray_bgg1 margin-top55">
                            <p class="text-center fs-24">Book a <b>FREE</b> Demo</p>

                            @include('frontend.component.common_form', [
                                'section' => 'Book a FREE Demo - Course Page',
                                'title'  => '',  
                                'course_name' => $courseInputName,
                                'msgfield' => '0',
                            ])
                        </div>
                    </div>


                </div>
            </div>
        </section>

    <!---------===================== syllabas section ==================-------------------------------->

        <!--Projects Covered section -->
        @if (!empty($project_covered))
            <section id="projects_covered" class="page-section prje_cove_section light_gray_bg pt-5 pb-5 position_relative zindex_1111">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="section_heading pb-3 text-center">{{ $detail->project_section_heading }}</h2>
                            <div class="owl-carousel owl-theme projects-covered">

                                @foreach ($project_covered as $row)
                                    <div class="item">
                                        <div class="projects_covered_box">
                                            <div class="projects_covered__header">
                                                <div class="row">
                                                    <div class="col-lg-9 col-10">
                                                        <div class="projects_covered__image">
                                                            <span
                                                                class="projects_covered__name">{{ $row->title }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-2">
                                                        <div class="projects_covered__icon">
                                                            <img src="{{ asset('storage/' . $row->icon) }}"
                                                                />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="projects_covered__content">
                                                <div class="projects_covered__text">
                                                    <div class="proj-cov">
                                                        @php echo ReplaceKeyword($row->description, $cms->replace_keyword) @endphp
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if (!empty($certificate))
            <section id="certificate_section" class="page-section certificate_section pt-5 pb-5 bg-white position_relative zindex_111">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="section_heading pb-3 text-center">{{ $detail->certificate_section_heading }}</h2>
                            <div class="owl-carousel owl-theme professional_students">

                                @foreach ($certificate as $row)
                                    <div class="item">
                                        <div class="cirtificate_img">
                                        
                                                <a href="{{ asset('storage/' . $row->image) }}" data-fancybox="gallery2">
                        <img src="{{ asset('storage/' . $row->image) }}" data-src="{{ asset('storage/' . $row->image) }}" alt="{{ $row->alt_image }}"/>
                    </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </section>
        @endif


        <section id="testimonials" class="page-section testiminilas_sec gradiant_bg pt-5 pb-5 dot_clr_white position_relative zindex_11">
            <div class="container">
                <h2 class="heading_title text-center pddtop_0 pb-3 textcolor_wht">
                    {{ $detail->testimonials_section_heading }}
                </h2>

                @if (!empty($video_review))
                    <div class="large-12 columns">
                        <div class="owl-carousel owl-theme video_testiminials">

                            @foreach ($video_review as $row)
                                <div class="item">
                                    <div class="testimonial_video">

                                        @php
                                            // Assuming $row->url contains the YouTube URL
                                            if (strpos($row->url, 'embed/') === false) {
                                                $videoID = basename($row->url);
                                                $youtube_url = 'https://youtu.be/embed/' . $videoID; // Corrected the concatenation
                                            } else {
                                                $youtube_url = $row->url; // URL already in the correct format
                                            }
                                        @endphp

                                        <a href="{{ $youtube_url }}" data-fancybox="gallery">
                                            <div class="pulse-button"></div>
                                            {{-- <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                                class="img-fluid d-block w-100" alt=""> --}}

                                            <img src="{{ asset('storage/' . $row->image) }}"
                                                class="img-fluid d-block w-100" alt="">

                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <!--------------------- video Review -------------------------------------->

                    @php 
                    echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],[$meta_title,$meta_description,$meta_url], html_entity_decode($detail->video_section_schema));
                    @endphp

                    <!--------------------- video Review -------------------------------------->

                @endif


                @if (!empty($text_review))
                    <div class="large-12 columns mt-4 ">
                        <div class="owl-carousel owl-theme slider_content_dots">

                            @foreach ($text_review as $row)
                                <div class="item">
                                    <div class="testimonial_box">
                                        <div class="testimonial__header">
                                            <div class="row">
                                                <div class="col-lg-6 col-10">
                                                    <div class="testimonial__image">
                                                        <img src="{{ asset('storage/' . $row->thumbnail) }}"
                                                            class="img-fluid d-block w-100" alt="">
                                                        <span class="testimonial__name">{{ $row->name }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-2">
                                                    <div class="testimonial__icon">
                                                        @if ($row->type == 'google')
                                                            <a href="{{ $row->url }}"><i aria-hidden="true" class="fab fa-google-plus"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="testimonial__content">
                                            <div class="testimonial__text">
                                                @php echo ReplaceKeyword($row->description, $cms->replace_keyword) @endphp
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <!--------------------- Text Review -------------------------------------->

                    @php 
                    echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],[$meta_title,$meta_description,$meta_url], html_entity_decode($detail->testimonials_section_schema));
                    @endphp

                    <!--------------------- Text Review -------------------------------------->

                @endif



            </div>
        </section>

        @if (!empty($batch))
            <section id="batch_shedule" class="page-section prje_cove_section light_gray_bg pt-5 pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="section_heading pb-3 text-center"> {{ $detail->batch_section_heading }}</h2>
                        </div>

                        <div class="batch_shedule_box">
                            <div class="row align-items-center">
                                <div class="col-md-9">
                                    <h3 class="batch_subhed">{{ $batch->paced_title }}</h3>
                                    @php $paced_pointer = json_decode($batch->paced_pointer_list) @endphp
                                    <ul>
                                        @foreach ($paced_pointer as $row)
                                            <li><i aria-hidden="true" class="far fa-check-circle"></i> @php echo html_entity_decode($row) @endphp
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <div class="button_main mt-2 mt-lg-0">
                                        <a href="https://lms.attariclasses.in/" target="_blank">Visit Video Portal</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="batch_shedule_box">
                            <div class="row align-items-center">
                                <div class="col-md-9">
                                    <h3 class="batch_subhed">{{ $batch->oc_title }} <span>Preferred</span>
                                    </h3>
                                    @php $oc_pointer = json_decode($batch->oc_pointer_list) @endphp
                                    <ul>
                                        @foreach ($oc_pointer as $row)
                                            <li><i aria-hidden="true" class="far fa-check-circle"></i> @php echo html_entity_decode($row) @endphp
                                            </li>
                                        @endforeach
                                    </ul>
                                    @php                                   

                                        $batch_detail = json_decode($batch->batch_detail, true);
                                        $batch_dates = array_column($batch_detail, 'date');
                                        
                                        $batch_start_times = array_column($batch_detail, 'start_time');
                                        $batch_end_times = array_column($batch_detail, 'end_time');

                                        // Set start times
                                        $batch_startTime1 = isset($batch_start_times[0]) ? $batch_start_times[0] : null; 
                                        $batch_startTime2 = isset($batch_start_times[1]) ? $batch_start_times[1] : null; 
                                        
                                        // Set end times
                                        $batch_endTime1 = isset($batch_end_times[0]) ? $batch_end_times[0] : null;
                                        $batch_endTime2 = isset($batch_end_times[1]) ? $batch_end_times[1] : null;
                                        
                                        // Get the start and end dates
                                        $batch_start_date = isset($batch_dates[0]) ? date("Y-m-d", strtotime($batch_dates[0])) : null; // Get the first date
                                        $batch_start_date2 = isset($batch_dates[1]) ? date("Y-m-d", strtotime($batch_dates[1])) : null; // Get the last date

                                        $batch_start_date = !empty($batch_start_date) ? date("Y-m-d", strtotime($batch_start_date)) : null; 
                                        $batch_start_date2 = !empty($batch_start_date2) ? date("Y-m-d", strtotime($batch_start_date2)) : null;
                                    
                                        $batch_end_date = !empty($batch_start_date) ? date('Y-m-d', strtotime($batch_start_date . ' +6 weeks')) : null;
                                        $batch_end_date2 = !empty($batch_start_date2) ? date('Y-m-d', strtotime($batch_start_date2 . ' +6 weeks')) : null;

                                    @endphp 

                                    @if (!empty($batch_detail))
                                        <table class="batch_table table">
                                            <tbody>
                                                <tr class="pdd_14">
                                                    <td><div class="">DATE</div></td>
                                                    <td><div class="">SCHEDULE </div></td>
                                                    <td><div class="">TIME </div></td>
                                                </tr>
                                                @foreach ($batch_detail as $row)
                                                    <tr class="pdd_19">
                                                        <td ><div class="">{{ formatDate($row['date']) }}</div></td>
                                                        <td ><div class="">@php echo html_entity_decode($row['schedule']) @endphp<span
                                                                class="text_red">@php echo html_entity_decode($row['remark']) @endphp</span></div></td>
                                                        <td>
                                                            <div>
                                                            @php
                                                            if (isset($row['start_time']) && isset($row['end_time'])) {
                                                                    echo date('g:i A', strtotime($row['start_time'])) . ' to ' . date('g:i A', strtotime($row['end_time'])). ' (IST) ';
                                                            }
                                                            @endphp
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    <div class="button_main getin_touch_bx">
                                        <p class="pb-2">Get In Touch to Avail <span>{{ $batch->off_percentage }} OFF</span></p>

                                        <a onclick="formModal('{{ url(route('component.form')) }}?section=Online / Classroom - course Page&title=Book a Demo&current_page={{ urlencode(url()->current()) }}&course_name={{$courseInputName}}')">Book a Demo</a>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="batch_shedule_box">
                            <div class="row align-items-center">
                                <div class="col-md-9">
                                    <h3 class="batch_subhed">{{ $batch->corp_title }}</h3>
                                    @php $corp_pointer = json_decode($batch->corp_pointer_list) @endphp
                                    <ul>
                                        @foreach ($corp_pointer as $row)
                                            <li>
                                                <i aria-hidden="true" class="far fa-check-circle"></i> @php echo html_entity_decode($row) @endphp
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <div class="button_main">
                                        <a onclick="formModal('{{ url(route('component.form')) }}?section={{$batch->corp_title. ' - course Page'}}&current_page={{ urlencode(url()->current()) }}&title=Enquire Now&course_name={{$courseInputName}}')">Enquire Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
    </section>

    <!-----------------================== Batch Schema =========================------------------------------>

    @php 
        echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]','[{start_date1}]','[{start_date2}]','[{end_date1}]','[{end_date2}]','[{start_time1}]','[{start_time2}]','[{end_time1}]','[{end_time2}]'],[$meta_title, $meta_description, $meta_url, $batch_start_date, $batch_start_date2, $batch_end_date, $batch_end_date2, $batch_startTime1, $batch_startTime2, $batch_endTime1,  $batch_endTime2], html_entity_decode($detail->batch_section_schema));
    @endphp

    <!-----------------================== Batch Schema =========================------------------------------>

    @endif



@php
    $trainerHeading = 'Meet Our Expert Trainer';
    $trainerDesc = 'Learn from Industry Expert Trainer';

    if ($cId == 5) {
        $trainerHeading = 'VMware';
        $trainerDesc = 'Learn VMware vSphere Server Virtualization from Industry Expert Trainer';
    } elseif ($cId == 7) {
        $trainerHeading = 'AWS';
        $trainerDesc = 'Learn AWS Cloud Computing from Industry Expert Trainer';
    } elseif ($cId == 8) {
        $trainerHeading = 'Azure';
        $trainerDesc = 'Learn Microsoft Azure Cloud Computing from Industry Expert Trainer';
    } elseif ($cId == 11) {
        $trainerHeading = 'Windows Server';
        $trainerDesc = 'Learn Windows Server Hybrid Administration from Industry Expert Trainer';
    } elseif ($cId == 10) {
        $trainerHeading = 'CCNA';
        $trainerDesc = 'Learn CCNA Networking from Industry Expert Trainer';
    } elseif ($cId == 9) {
        $trainerHeading = 'Windows Server';
        $trainerDesc = 'Learn Windows Server Hybrid Administration from Industry Expert Trainer';
    }
@endphp



@if(in_array($cId, [5, 7]))
                    
                    <section id="trainer_profile" class="page-section nx_trainer_section gradiant_bg">
                          <div class="container">
                            <!-- Heading -->
                            <div class="text-center">
                            
                              <h2 class="nx_trainer_heading"> Meet Our <span>Expert Trainer</span>
                              </h2>
                              <p class="nx_trainer_desc"> {{ $trainerDesc }} </p>
                            </div>
                            <!-- Trainer Card -->
                            <div class="nx_trainer_box d-lg-block d-none">
                              <!-- Top -->
                               <div class="nx_trainer_top">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      
                                        <h3 class="nx_trainer_name"> Mr. Maqsood Sheikha </h3>
                                        <div class="nx_trainer_role"> VMware & AWS Cloud Trainer </div>
                                      
                                  </div>
                                  <div class="col-md-4">
                                      <div class="nx_trainer_btn_wrap">
                                     
                                      <button type="button" class="trainer-btn nx_trainer_btn" data-modal="maqsoodModal"> View Full Profile </button>
                                    </div>
                                  </div>
                              </div>
                              </div>
                             
                              <!-- Content -->
                              <div class="nx_trainer_content">
                                <div class="row align-items-center">
                                  <!-- Left -->
                                  <div class="col-lg-12">
                                    <ul class="nx_trainer_points">
                                      <li> Training Since 2011 </li>
                                      <li> 10,000+ Students Trained </li>
                                      <li> VMware vSphere & AWS Cloud Specialist </li>
                                      <li> Enterprise IT Infrastructure Project Experience </li>
                                      <li> Students Across India, Gulf Countries & North America </li>
                                      <li> Hands-on Real Time Project Training </li>
                                    </ul>
                                  </div>
                                  <!-- Right -->
                                 
                                </div>
                              </div>
                            </div>
                            
                            <div class="trainer-grid d-lg-none d-block">
                                   <!-- Trainer 1 -->
                                   <div class="trainer-card">
                                     <div class="trainer-label-box">
                                       <div class="mobile_tr_name">Mr. Maqsood Sheikha</div>
                                       <p class="trainer-designation"> VMware & AWS Cloud Trainer </p>
                                     </div>
                                     <div class="trainer-content">
                                       <ul>
                                         <li>Training Since 2011</li>
                                         <li>10,000+ Students Trained</li>
                                         <li>VMware vSphere & AWS Cloud Specialist</li>
                                         <li>Enterprise IT Infrastructure Project Experience</li>
                                         <li>Students Across India, Gulf Countries & North America</li>
                                       </ul>
                                       <button type="button" class="trainer-btn" data-modal="maqsoodModal"> View Full Profile </button>
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
                             
                             @else 
                             
                           
                         <section id="trainer_profile" class="page-section nx_trainer_section gradiant_bg">
                          <div class="container">
                            <!-- Heading -->
                            <div class="text-center">
                            
                              <h2 class="nx_trainer_heading"> Meet Our <span>Expert Trainer</span>
                              </h2>
                              <p class="nx_trainer_desc"> {{ $trainerDesc }} </p>
                            </div>
                            <!-- Trainer Card -->
                            <div class="nx_trainer_box d-lg-block d-none">
                              <!-- Top -->
                               <div class="nx_trainer_top">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      
                                        <h3 class="nx_trainer_name"> Mr. Zameer Momin</h3>
                                        <div class="nx_trainer_role">Microsoft Azure, Windows Server Hybrid & Networking Trainer </div>
                                      
                                  </div>
                                  <div class="col-md-4">
                                      <div class="nx_trainer_btn_wrap">
                                     
                                      <button type="button" class="trainer-btn nx_trainer_btn" data-modal="zamirModal"> View Full Profile </button>
                                    </div>
                                  </div>
                              </div>
                              </div>
                             
                              <!-- Content -->
                              <div class="nx_trainer_content">
                                <div class="row align-items-center">
                                  <!-- Left -->
                                  <div class="col-lg-12">
                                    <ul class="nx_trainer_points">
                                      <li>Training Since 2017</li>
                                         <li>8,000+ Students Trained</li>
                                         <li>Azure, Windows Server Hybrid & CCNA Networking</li>
                                         <li>Enterprise Infrastructure Experience</li>
                                         <li>Students Across India, Gulf Countries & North America</li>
                                    </ul>
                                  </div>
                                  <!-- Right -->
                                 
                                </div>
                              </div>
                            </div>
                            
                            <div class="trainer-grid d-lg-none d-block">
                                   <!-- Trainer 1 -->
                                   <div class="trainer-card">
                                     <div class="trainer-label-box">
                                       <div class="mobile_tr_name"> Mr. Zameer Momin</div>
                                       <p class="trainer-designation"> Microsoft Azure, Windows Server Hybrid & CCNA  </p>
                                     </div>
                                     <div class="trainer-content">
                                       <ul>
                                         <li>Training Since 2017</li>
                                         <li>8,000+ Students Trained</li>
                                         <li>Azure, Windows Server Hybrid & CCNA Networking</li>
                                         <li>Enterprise Infrastructure Experience</li>
                                         <li>Students Across India, Gulf Countries & North America</li>
                                       </ul>
                                       <button type="button" class="trainer-btn" data-modal="zamirModal"> View Full Profile </button>
                                     </div>
                                   </div>
                                 </div>
                                 
                                 
                          </div>
                        </section>

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




                    @endif
                    

    <!--Faq section-->

        <section id="faqs" class="page-section overview py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 width70">
                    @if (!empty($faq) && $faq->count() > 0)
                        <h2 class="section_heading pb-3 text-center textcolor_blck"> {{ $detail->faq_section_heading }} </h2>
                    @endif
  
                        @if (!empty($faq))
                            <div class="accordion--container accordion_style_one">
                            
                                @foreach ($faq as $row)
                                    <div class="accordionone">
                            
                                        <h3>
                                            @php echo ReplaceKeyword($row->question, $cms->replace_keyword) @endphp
                                            <i class="fa fa-angle-up"></i>
                                        </h3>
                            
                                        <div class="contentsillabus_div1">
                                            <div class="txt">
                                                @php echo ReplaceKeyword($row->answer, $cms->replace_keyword) @endphp
                                            </div>
                                        </div>
                            
                                    </div>
                                @endforeach
                            
                            </div>
                    <!----================== Faq Schema ==================------------------->
                            @php
                                $f = 1;
                            @endphp
                            
                            <script type="application/ld+json">
                            {
                                "@context": "https://schema.org",
                                "@type": "FAQPage",
                                "mainEntity": [
                                    @foreach ($faq as $row)
                                        @if ($f <= 5)
                                            {
                                                "@type": "Question",
                                                "name": "@php echo ReplaceKeyword($row->question, $cms->replace_keyword) @endphp",
                                                "acceptedAnswer": {
                                                    "@type": "Answer",
                                                    "text": "@php echo ReplaceKeyword($row->answer, $cms->replace_keyword) @endphp"
                                                }
                                            }
                                            @if ($f < 5),
                                            @endif
                                        @endif
                                        @php
                                            $f++;
                                        @endphp
                                    @endforeach
                                ]
                            }
                            </script>

                    <!----================== Faq Schema ==================------------------->

                        @endif

                        <div class="gradiant_bg bookdemofreeform_course course_buttom_form mt-4">
                            <p class="text-center textcolor_wht pb-2 fs-24">Book a <b>FREE</b> Demo</p>
                            @include('frontend.component.common_form', [
                                'section' => 'Book a FREE Demo - Course Page',
                                'title'  => '',  
                                'course_name' => $courseInputName,
                                'msgfield' => '0',
                                'param1' => NULL,
                                'param2' => NULL,
                                'param3' => NULL,
                            ])
                        </div>


                    </div>
                    <div class="col-md-3 width30 position_sticky">
                        <div class="talktous_box margin-top55">
                            <i class="fa-sharp fa-solid fa-phone"></i>
                            <p class="mb-3">Talk To Us</p>
                            <p>
                                <a href="tel:+917738375431">+91 7738375431</a>
                            </p>
                            <p>
                                <a href="mailto:info@attariclasses.in">info@attariclasses.in</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    {{--@php
        $cms_course = DB::table('cms')->where('status', 1)->where('zone', 0)->whereNot('id', $cms->id)->get(['course_id', 'slug']);
    @endphp

    <section class="other_courses light_gray_bg pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section_heading pb-3 text-center"> Other Courses <strong>We Offer</strong></h2>
                    <div class="owl-carousel owl-theme other_courses_slider">

                        @foreach ($cms_course as $row)
                            <div class="item">
                                <div class="other_crs_box">
                                    <a href="{{ url(route('course.detail', ['slug' => $row->slug] )) }}">
                                        @php 
                                            $course = DB::table('courses')->where('id', $row->course_id)->get(['thumbnail'])->first();
                                        @endphp
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="">
                                    </a>
                                </div>
                            </div> 
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    
    <!--optimized code-->
    @php
        $cms_courses = DB::table('cms')
            ->join('courses', 'cms.course_id', '=', 'courses.id')
            ->where('cms.status', 1)
            ->where('cms.zone', 0)
            ->where('cms.id', '!=', $cms->id)
            ->get(['cms.course_id', 'cms.slug', 'courses.thumbnail']);
            
        $course_wsh  = $cms_courses->firstWhere('course_id', 11);
        
        if (!$course_wsh) {
            // If not found, fetch course_id = 11 directly
            $cms_courses_temp = DB::table('cms')
                ->join('courses', 'cms.course_id', '=', 'courses.id')
                ->where('cms.status', 1)
                ->where('cms.zone', 0)
                ->where('cms.course_id', 11)
                ->get(['cms.course_id', 'cms.slug', 'courses.thumbnail']);
        
            $course_wsh = $cms_courses_temp->first();
        }
        
    @endphp
    
    <section class="other_courses light_gray_bg pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section_heading pb-3 text-center"> Other Courses <strong>We Offer</strong></h2>
                    <div class="owl-carousel owl-theme other_courses_slider">
    
                        @foreach ($cms_courses as $row)
                            @php 
                                $row = $row->course_id == 9 && $course_wsh ? $course_wsh : $row;
                            @endphp
                            <div class="item">
                                <div class="other_crs_box">
                                    <a href="{{ url(route('course.detail', ['slug' => $row->slug] )) }}">
                                        <img src="{{ asset('storage/' . $row->thumbnail) }}" alt="">
                                    </a>
                                </div>
                            </div> 
                        @endforeach
    
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <section class="location_section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
 @php
 $course_name = $courseInputName;
                session()->put('course_name', $course_name);
            @endphp

            <h2>Find {{ $course_name }} by Location</h2>
                    <div class="location_box">
                        @php

                            /*if($cms->course_id == '5'){
                                $course_name = 'VMware Training ';
                            } elseif ($cms->course_id == '7') {
                                $course_name = 'AWS Training';
                            } elseif ($cms->course_id == '8') {
                                $course_name = 'Microsoft Azure Training';
                            } elseif ($cms->course_id == '9') {
                                $course_name = 'MCSE / MCSA Training';
                            } else {
                                $course_name = 'CCNA Training';
                            }*/
                            
                            $course_name = $courseInputName;
                            session()->put('course_name', $course_name);
                        @endphp

                        <h3>
                        {{ $course_name }} in other Cities
                        </h3>

                        @php
                            $cms_alias_city = DB::table('cms')->where('status', 1)->where('zone', 1)->where('course_id', $cms->course_id)->whereNot('id', $cms->id)->get(['alias', 'slug']);
                        @endphp

                        <ul class="elementor-icon-list-items list-container">
                            @foreach ($cms_alias_city as $index => $row)
                                <li class="list-item" data-index="{{ $index }}">
                                    <a href="{{ url(route('course.detail', ['slug' => $row->slug] )) }}">
                                        <span>{{ $row->alias }}</span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                        <button class="load-more-btns">Load More</button> 
                    </div>
                    

                    <div class="row" >
                        @php
                            $cms_alias_country = DB::table('cms')->where('status', 1)->where('zone', 2)->where('course_id', $cms->course_id)->whereNot('id', $cms->id)->get(['alias', 'slug']);
                        @endphp

                        @if(!empty($cms_alias_country))


                            @if($cms_alias_country->isNotEmpty())
                                <div class="location_box">
                                    <h3>
                                      {{ $course_name }} in other Countries
                                    </h3>
                                    <ul class="elementor-icon-list-items list-container">
                                        @foreach ($cms_alias_country as $index => $row)
                                            <li class="list-item" data-index="{{ $index }}">
                                                <a href="{{ url(route('course.detail', ['slug' => $row->slug])) }}">
                                                    <span>{{ $row->alias }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <button class="load-more-btns">Load More</button>  
                                </div>
                                
                            @endif
                        @endif
                    </div>
                    
                    
                 <div class="row">

    @if(!empty($detail->seo_label) && !empty($detail->seo_description))
        @php 
            $seo_label = ReplaceKeyword($detail->seo_label, $cms->replace_keyword); 
            $seo_description = ReplaceKeyword($detail->seo_description, $cms->replace_keyword);
        @endphp

        <div class="location_box text-center">

            <h2 
                class="course-info-heading"
                role="button"
                tabindex="0"
                aria-expanded="false"
                aria-controls="courseInfoContent"
            >
                <span>{{ $seo_label }}</span>
                <span class="course-info-icon">+</span>
            </h2>

            <div id="courseInfoContent" class="course-info-content">
                <div class="course-info-inner">
                    @php echo html_entity_decode($seo_description) @endphp
                </div>
            </div>

        </div>
    @endif

</div>

                </div>
            </div>
        </div>
    </section>

    <style>
    .course-info-heading {
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 12px;
}

.course-info-icon {
    font-size: 26px;
    font-weight: 700;
    line-height: 1;
}

.course-info-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s ease;
    text-align: left;
}

.course-info-inner {
    padding-top: 15px;
}

	.hidden_classes {
		display: none;
	}
	.load-more-btns {
		border: 0;
		background: transparent;
		color: #13aff0;
		font-size: 15px;
		position: relative;
		top: -4px;
		font-weight: 500;
	}
	@media(max-width:767px)
	{
	    .location_box ul {
    display: inline-block;
}
	}
</style>

    <!-------------=============== courses end =============== --------------------> 
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const headings = document.querySelectorAll(".course-info-heading");

    headings.forEach(function (heading) {
        function toggleAccordion() {
            const contentId = heading.getAttribute("aria-controls");
            const content = document.getElementById(contentId);
            const icon = heading.querySelector(".course-info-icon");
            const isOpen = heading.getAttribute("aria-expanded") === "true";

            if (isOpen) {
                content.style.maxHeight = "0px";
                heading.setAttribute("aria-expanded", "false");
                icon.textContent = "+";
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
                heading.setAttribute("aria-expanded", "true");
                icon.textContent = "−";
            }
        }

        heading.addEventListener("click", toggleAccordion);

        heading.addEventListener("keydown", function (event) {
            if (event.key === "Enter" || event.key === " ") {
                event.preventDefault();
                toggleAccordion();
            }
        });
    });
});
</script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        function updateVisibleItems() {
            let screenWidth = window.innerWidth;
            let initialCount = screenWidth <= 767 ? 15 : 25; // Show 10 on mobile, 28 on desktop

            document.querySelectorAll(".list-container").forEach((listContainer) => {
                let listItems = listContainer.querySelectorAll(".list-item");
                let loadMoreBtn = listContainer.nextElementSibling; // Find Load More button

                // Hide items beyond the initial limit
                listItems.forEach((item, index) => {
                    if (index < initialCount) {
                        item.classList.remove("hidden_classes");
                    } else {
                        item.classList.add("hidden_classes");
                    }
                });

                // Show/hide "Load More" button
                if (listItems.length > initialCount) {
                    loadMoreBtn.style.display = "block"; // Show button if more items exist
                } else {
                    loadMoreBtn.style.display = "none"; // Hide if all items fit
                }

                // Click event for Load More button
                loadMoreBtn.addEventListener("click", function () {
                    listItems.forEach(item => item.classList.remove("hidden_classes")); // Show all items
                    loadMoreBtn.style.display = "none"; // Hide button after clicking
                });
            });
        }

        updateVisibleItems(); // Run on page load
        window.addEventListener("resize", updateVisibleItems); // Run on screen resize
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', () => {
window.scrollTo(0, 0);
        // Handle Check Curriculum link separately
        const checkCurriculumLink = document.querySelector('.check_curriculum');
        if (checkCurriculumLink) {
            checkCurriculumLink.addEventListener('click', function (event) {
                event.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - (document.querySelector('.nav-sections') ? document.querySelector('.nav-sections').offsetHeight : 0);
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        }
    
        if (document.querySelector('.menu') && document.querySelector('.nav-sections')) {
            const sectionsContainer = document.querySelector('.page-sections');
            const sections = document.querySelectorAll('.page-section');
            const nav = document.querySelector('.nav-sections');
            const menu = nav.querySelector('.menu');
            const links = nav.querySelectorAll('.menu-item-link');
            const activeLine = nav.querySelector('.active-line');
            const sectionOffset = nav.offsetHeight;
            const activeClass = 'active';
            let activeIndex = 0;
            let isScrolling = true;
            let userScroll = true;
        
            if (!sectionsContainer || !sections.length || !nav || !menu || !links.length || !activeLine) {
              console.error('One or more elements are not found in the DOM');
              return;
            }
            
            const setActiveClass = () => {
              links[activeIndex].classList.add(activeClass);
            };
            
            const removeActiveClass = () => {
              links[activeIndex].classList.remove(activeClass);
            };
            
            const moveActiveLine = () => {
              const link = links[activeIndex];
              const linkX = link.getBoundingClientRect().x;
              const menuX = menu.getBoundingClientRect().x;
            
              activeLine.style.transform = `translateX(${(menu.scrollLeft - menuX) + linkX}px)`;
              activeLine.style.width = `${link.offsetWidth}px`;
            };
            
            const setMenuLeftPosition = position => {
              menu.scrollTo({
                left: position,
                behavior: 'smooth',
              });
            };
            
            const checkMenuOverflow = () => {
              const activeLink = links[activeIndex].getBoundingClientRect();
              const offset = 30;
            
              if (Math.floor(activeLink.right) > window.innerWidth) {
                setMenuLeftPosition(menu.scrollLeft + activeLink.right - window.innerWidth + offset);
              } else if (activeLink.left < 0) {
                setMenuLeftPosition(menu.scrollLeft + activeLink.left - offset);
              }
            };
        
            const handleActiveLinkUpdate = current => {
              removeActiveClass();
              activeIndex = current;
              checkMenuOverflow();
              setActiveClass();
              moveActiveLine();
            };
            
            const init = () => {
              moveActiveLine(links[0]);
              document.documentElement.style.setProperty('--section-offset', sectionOffset + 'px');
            };
        
            links.forEach((link, index) => link.addEventListener('click', function (event) {
              event.preventDefault();
              userScroll = false;
              handleActiveLinkUpdate(index);
            
              const targetId = this.getAttribute('data-href').substring(1);
              const targetElement = document.getElementById(targetId);
              const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - sectionOffset;
            
              window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
              });
              const currentPageUrl = window.location.origin + window.location.pathname.replace(/\/?$/, '/');
              history.pushState(null, '', currentPageUrl + '#' + targetId);
            }));
        
            window.addEventListener("scroll", () => {
              const currentIndex = sectionsContainer.getBoundingClientRect().top < 0
                ? (sections.length - 1) - [...sections].reverse().findIndex(section => window.scrollY >= section.offsetTop - sectionOffset * 2) 
                : 0;
            
              if (userScroll && activeIndex !== currentIndex) {
                handleActiveLinkUpdate(currentIndex);
              } else {
                window.clearTimeout(isScrolling);
                isScrolling = setTimeout(() => userScroll = true, 100);
              }
            });
        
            init();
        }
    });
  </script>  
  
  
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const heading = document.getElementById("seoHeading");
            const description = document.getElementById("seoDescription");

            if (heading && description) {
                heading.addEventListener("click", function () {
                    description.classList.toggle("d-none");
                });
            }
        });
    </script>
    
@endsection