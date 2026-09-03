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
    <section class="vm_banner course_hero">
        <div class="container">
            @php
                $heroTitle = $cms->title;
                if (preg_match('/^(.*?\bwith)\s+(.+)$/iu', $heroTitle, $heroTitleParts)) {
                    $heroTitleHtml = e($heroTitleParts[1]) . ' <span class="course_hero_highlight">' . e($heroTitleParts[2]) . '</span>';
                } else {
                    $heroTitleHtml = e($heroTitle);
                }

                if (strpos($detail->url, 'embed/') === false) {
                    $videoID = basename($detail->url);
                    $youtube_url_detail = 'https://youtu.be/embed/' . $videoID;
                } else {
                    $youtube_url_detail = $detail->url;
                }
            @endphp
            <div class="row align-items-center course_hero_row">
                <div class="col-lg-8">
                    <div class="breadcrums_section">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url(route('index')) }}">Home</a></li>
                                <li class="breadcrumb-item"><a>»</a></li>
                                <li class="breadcrumb-item"><a><b>{{ $cms->breadcrumb_title }}</b></a></li>
                            </ol>
                        </nav>
                    </div>

                    <h1 class="course_hero_title">{!! $heroTitleHtml !!}</h1>

                    <div class="course_hero_desc desc">
                        @php echo ReplaceKeyword($cms->description, $cms->replace_keyword) @endphp
                    </div>

                    <p class="course_hero_rating">
                        <span class="course_hero_stars" aria-hidden="true">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>{{ $detail->rating }} ({{ $detail->total_review }}) ratings</span>
                        <span class="course_hero_dot">8,000+ Students Trained</span>
                    </p>

                    <div class="course_hero_actions">
                        <button type="button" class="course_hero_btn course_hero_btn_primary" onclick="formModal('{{ url(route('component.form')) }}?section=Enquire Form Top - course Page&title=Enquire Now&current_page={{ urlencode(url()->current()) }}&course_name={{$courseInputName}}')">Enquire now</button>
                        <a href="#syllabus" class="course_hero_btn course_hero_btn_outline check_curriculum">Check curriculum</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="course_hero_media">
                        <a href="{{ $youtube_url_detail }}" data-fancybox="gallery" aria-label="Play course video">
                            <img src="{{ asset('storage/' . $detail->other_thumbnail) }}" alt="{{ $cms->title }}" />
                            <span class="course_hero_play"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="vm_nav course_subnav" id="vm_nav">
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
        <section id="key_features" class="page-section key_features course_features paddingt_80 paddinb_80 position_relative zindex_1111111">
            <div class="container">
                <h2 class="section_heading course_features_heading text-center textcolor_blck">{{ $detail->key_title }} Key Features</h2>
                <div class="course_features_grid">
                    <div class="key_boxes">
                        <div class="key_features_icon">
                            <i class="fa-solid fa-desktop"></i>
                        </div>
                        <p>Instructor led live Training</p>
                    </div>
                    <div class="key_boxes">
                        <div class="key_features_icon">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <p>Hands-on Practical Training</p>
                    </div>
                    <div class="key_boxes">
                        <div class="key_features_icon">
                            <i class="fa-solid fa-comment-dots"></i>
                        </div>
                        <p>Trainer Support on WhatsApp</p>
                    </div>
                    <div class="key_boxes">
                        <div class="key_features_icon">
                            <i class="fa-solid fa-circle-play"></i>
                        </div>
                        <p>Recorded lectures on LMS</p>
                    </div>
                    <div class="key_boxes">
                        <div class="key_features_icon">
                            <i class="fa-solid fa-database"></i>
                        </div>
                        <p>Access to Learning Portal</p>
                    </div>
                    <div class="key_boxes">
                        <div class="key_features_icon">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <p>Certificate from Attari classes</p>
                    </div>
                    <div class="key_boxes">
                        <div class="key_features_icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <p>New Job Openings Forum</p>
                    </div>
                    <div class="key_boxes">
                        <div class="key_features_icon">
                            <i class="fa-solid fa-headphones"></i>
                        </div>
                        <p>Support Desk for Student</p>
                    </div>
                </div>
            </div>
        </section>

        <!---------============== overviews ====================----------------------->

        <section id="overviews" class="page-section overview course_overview paddingt_80 paddinb_80 position_relative zindex_111111">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-md-9 width70">
                        <h2 class="section_heading course_overview_heading textcolor_blck">
                            {{ $detail->overview_section_heading }}
                        </h2>
                        <div class="overview_content">
                            @php echo ReplaceKeyword($detail->course_overview, $cms->replace_keyword) @endphp
                        </div>
                    </div>
                    <div class="col-md-3 width30">
                        <div class="overview_sidebar">
                            <!-- @if (!empty($detail->faq))
                                <div class="overview_faq accordion--container1 accordion_style1">
                                    @php
                                        $course_faq = json_decode($detail->faq);
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
                            @endif -->

                            <div class="overview_talk">
                                <div class="overview_talk_header">
                                    <p class="overview_talk_title">Talk To Us</p>
                                    <p class="overview_talk_subtitle">We are happy to help you</p>
                                </div>

                                <a class="overview_talk_phone" href="tel:+917738375431">
                                    <span class="overview_talk_flag" aria-hidden="true"></span>
                                    <span>+91-7738375431</span>
                                </a>

                                <div class="overview_talk_quote">
                                    <div class="overview_talk_quote_mark" aria-hidden="true">&ldquo;</div>
                                    <p>Build your cloud skills with live trainer guidance, hands-on labs, and support whenever you need help.</p>
                                    <p class="overview_talk_quote_author">- Attari Classes</p>
                                </div>

                                <div class="overview_talk_actions">
                                    <a class="overview_talk_whatsapp" target="_blank" rel="noopener" href="https://api.whatsapp.com/send?phone=917738375431&text=Hi%2C+I+am+contacting+you+through+your+website">
                                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                        <span>Chat on WhatsApp</span>
                                    </a>
                                    <button type="button" class="overview_talk_demo" onclick="formModal('{{ url(route('component.form')) }}?section=Overview - Book Free Demo&title=Book a FREE Demo&current_page={{ urlencode(url()->current()) }}&course_name={{$courseInputName}}')">Book a free demo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



    <!---------===================== syllabas section ==================-------------------------------->


        <section id="syllabus" class="page-section syllabus_section course_syllabus_modern gradiant_bg paddingt_80 paddinb_80 position_relative zindex_11111">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 width70 course_syllabus_content">
                        <h2 class="section_heading pb-3 textcolor_wht float_left course_syllabus_title"> {{ $detail->syllabus_section_heading }}
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
                    
                        <p class="online_css course_syllabus_intro">
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
                    
                        <p class="online_css course_syllabus_intro">
                           Looking for the latest VMware vSphere detailed syllabus or VCP certification syllabus? You can view the complete module-wise VMware course content below or download the VMware syllabus PDF for offline reference.
                        </p>
                    @endif

                    @if(!request()->is('aws-certification-training-online') && !request()->is('vmware-training-certification-online'))
                        <p class="course_syllabus_intro">
                            View the complete module-wise curriculum below or request the full syllabus PDF on WhatsApp for offline reference.
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
                                            @php
                                                $moduleDescription = ReplaceKeyword($row->description, $cms->replace_keyword);
                                            @endphp
                                            <li class="accordion1 @if($i == 1) open @endif">
                                                <span class="syllabus_module_header">
                                                    <span class="syllabus_module_title">Module {{ $i }}:- @php echo ReplaceKeyword($row->title, $cms->replace_keyword) @endphp</span>
                                                    <i class="fa fa-angle-up"></i>
                                                </span>
                                                <div class="contentsillabus_div" style="@if($i == 1) display:block; @endif">
                                                    <div class="txt">
                                                        @php echo $moduleDescription @endphp
                                                    </div>
                                                    <div class="syllabus_module_actions">
                                                        @if(!empty($detail->curriculum_pdf))
                                                            <a class="module_download_brochure showFormBtnCurriculum" href="javascript:void(0)">
                                                                <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                                               {{ explode(' ', trim($cms->menu_title ?? $cms->breadcrumb_title))[0] }}   Syllabus on WhatsApp
                                                            </a>
                                                        @endif
                                                      
                                                            <!-- <a class="module_watch_video">
                                                                <i class="fas fa-play" aria-hidden="true"></i> Watch Video
                                                              
                                                            </a> -->
                                                        
                                                    </div>
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


                    <div class="col-md-3 width30 position_sticky course_syllabus_form_col">
                        <div class="bookdemofreeform_course syllabus_demo_card">
                            <div class="syllabus_demo_card_head">
                                <p class="syllabus_demo_title">Book a <b>FREE</b> Demo</p>
                                <span class="syllabus_demo_card_sub">Share your details. A counsellor will call you back.</span>
                            </div>

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
            @php
                $projectIconClass = function ($title) {
                    $normalizedTitle = strtolower(strip_tags(html_entity_decode($title)));
                    $iconRules = [
                        ['words' => ['license', 'licensing'], 'icon' => 'fa-solid fa-key'],
                        ['words' => ['vcenter'], 'icon' => 'fa-solid fa-server'],
                        ['words' => ['vm', 'virtual machine'], 'icon' => 'fa-solid fa-desktop'],
                        ['words' => ['clone', 'template'], 'icon' => 'fa-solid fa-copy'],
                        ['words' => ['content library'], 'icon' => 'fa-solid fa-folder-open'],
                        ['words' => ['snapshot'], 'icon' => 'fa-solid fa-camera'],
                        ['words' => ['security', 'acl', 'ssh', 'vpn'], 'icon' => 'fa-solid fa-shield-alt'],
                        ['words' => ['host profile'], 'icon' => 'fa-solid fa-id-card'],
                        ['words' => ['network', 'vpc', 'vnet', 'vlan', 'routing', 'route', 'nat', 'etherchannel', 'switch'], 'icon' => 'fa-solid fa-network-wired'],
                        ['words' => ['storage', 'san', 'nas', 'ebs', 's3', 'bucket', 'file server'], 'icon' => 'fa-solid fa-hard-drive'],
                        ['words' => ['motion', 'svmotion', 'peering'], 'icon' => 'fa-solid fa-right-left'],
                        ['words' => ['ha', 'drs', 'fault tolerance', 'failover', 'highly available'], 'icon' => 'fa-solid fa-sync-alt'],
                        ['words' => ['ec2', 'compute', 'server'], 'icon' => 'fa-solid fa-server'],
                        ['words' => ['load balancer', 'loadbalancer', 'balancing'], 'icon' => 'fa-solid fa-scale-balanced'],
                        ['words' => ['autoscaling', 'scale set'], 'icon' => 'fa-solid fa-chart-line'],
                        ['words' => ['backup', 'restore', 'disaster recovery', 'site recovery'], 'icon' => 'fa-solid fa-clock-rotate-left'],
                        ['words' => ['rds', 'database', 'dynamo'], 'icon' => 'fa-solid fa-database'],
                        ['words' => ['route53', 'dns', 'domain naming'], 'icon' => 'fa-solid fa-globe'],
                        ['words' => ['hybrid', 'connector', 'entra', 'active directory', 'domain controller', 'user', 'group', 'ou'], 'icon' => 'fa-solid fa-users-gear'],
                        ['words' => ['cloud formation'], 'icon' => 'fa-solid fa-cloud'],
                        ['words' => ['ios', 'router'], 'icon' => 'fa-solid fa-route'],
                        ['words' => ['spanning tree', 'loop free'], 'icon' => 'fa-solid fa-diagram-project'],
                        ['words' => ['dhcp'], 'icon' => 'fa-solid fa-sitemap'],
                        ['words' => ['wireless'], 'icon' => 'fa-solid fa-wifi'],
                    ];

                    foreach ($iconRules as $rule) {
                        foreach ($rule['words'] as $word) {
                            if (strpos($normalizedTitle, $word) !== false) {
                                return $rule['icon'];
                            }
                        }
                    }

                    return 'fa-solid fa-layer-group';
                };
            @endphp
            <section id="projects_covered" class="page-section prje_cove_section course_projects paddingt_80 paddinb_80 position_relative zindex_1111">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="section_heading course_projects_heading text-center">{{ $detail->project_section_heading }}</h2>
                            <div class="owl-carousel owl-theme projects-covered">

                                @foreach ($project_covered as $row)
                                    <div class="item">
                                        <div class="projects_covered_box">
                                            <div class="projects_covered__header">
                                                <span class="projects_covered__name">{{ $row->title }}</span>
                                                <div class="projects_covered__icon">
                                                    <i class="{{ $projectIconClass($row->title) }}" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div class="projects_covered__content">
                                                <div class="projects_covered__text">
                                                    <div class="proj-cov">
                                                        @php echo ReplaceKeyword($row->description, $cms->replace_keyword) @endphp
                                                    </div>
                                                </div>
                                                <button type="button" class="projects_view_more">View More <i class="fa fa-chevron-down" aria-hidden="true"></i></button>
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
            <section id="certificate_section" class="page-section certificate_section course_certificates paddingt_80 paddinb_80 position_relative zindex_111">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="section_heading course_certificates_heading text-center">{{ $detail->certificate_section_heading }}</h2>
                            <div class="owl-carousel owl-theme professional_students">

                                @foreach ($certificate as $row)
                                    <div class="item">
                                        <div class="certificate_card">
                                            <a href="{{ asset('storage/' . $row->image) }}" data-fancybox="gallery2">
                                                <img src="{{ asset('storage/' . $row->image) }}" alt="{{ $row->alt_image }}"/>
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


        <section id="testimonials" class="page-section testiminilas_sec course_testimonials paddingt_80 paddinb_80 position_relative zindex_11">
            <div class="container">
                <h2 class="section_heading course_testimonials_heading text-center">
                    {{ $detail->testimonials_section_heading }}
                </h2>

                @if (!empty($video_review))
                    <div class="owl-carousel owl-theme course_video_reviews">
                        @foreach ($video_review as $row)
                            <div class="item">
                                <div class="course_review_video">
                                    @php
                                        if (strpos($row->url, 'embed/') === false) {
                                            $videoID = basename($row->url);
                                            $youtube_url = 'https://youtu.be/embed/' . $videoID;
                                        } else {
                                            $youtube_url = $row->url;
                                        }
                                    @endphp
                                    <a href="{{ $youtube_url }}" data-fancybox="gallery" aria-label="Play student review video">
                                        <img src="{{ asset('storage/' . $row->image) }}" alt="" />
                                        <span class="course_review_play"></span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @php
                    echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],[$meta_title,$meta_description,$meta_url], html_entity_decode($detail->video_section_schema));
                    @endphp
                @endif

                @if (!empty($text_review))
                    <div class="owl-carousel owl-theme course_text_reviews">
                        @foreach ($text_review as $row)
                            @php
                                $reviewInitial = strtoupper(substr(trim($row->name), 0, 1));
                                $reviewRole = $row->profile ?: ($cms->menu_title . ' learner');
                            @endphp
                            <div class="item">
                                <div class="course_review_card">
                                    <div class="course_review_head">
                                        <span class="course_review_avatar">{{ $reviewInitial }}</span>
                                        <div class="course_review_meta">
                                            <span class="course_review_name">{{ $row->name }}</span>
                                            <!-- <span class="course_review_role">{{ $reviewRole }}</span> -->
                                        </div>
                                    </div>
                                    <div class="course_review_stars" aria-label="5 star rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="course_review_text">
                                        @php echo ReplaceKeyword($row->description, $cms->replace_keyword) @endphp
                                    </div>
                                    <button type="button" class="course_review_more">View More <i class="fa fa-chevron-down" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @php
                    echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],[$meta_title,$meta_description,$meta_url], html_entity_decode($detail->testimonials_section_schema));
                    @endphp
                @endif
            </div>
        </section>

        @if (!empty($batch))
            @php
                $paced_pointer = json_decode($batch->paced_pointer_list) ?: [];
                $oc_pointer = json_decode($batch->oc_pointer_list) ?: [];
                $corp_pointer = json_decode($batch->corp_pointer_list) ?: [];
                $batch_detail = json_decode($batch->batch_detail, true) ?: [];
                $batch_dates = array_column($batch_detail, 'date');
                $batch_start_times = array_column($batch_detail, 'start_time');
                $batch_end_times = array_column($batch_detail, 'end_time');
                $batch_startTime1 = $batch_start_times[0] ?? null;
                $batch_startTime2 = $batch_start_times[1] ?? null;
                $batch_endTime1 = $batch_end_times[0] ?? null;
                $batch_endTime2 = $batch_end_times[1] ?? null;
                $batch_start_date = !empty($batch_dates[0]) ? date("Y-m-d", strtotime($batch_dates[0])) : null;
                $batch_start_date2 = !empty($batch_dates[1]) ? date("Y-m-d", strtotime($batch_dates[1])) : null;
                $batch_end_date = !empty($batch_start_date) ? date('Y-m-d', strtotime($batch_start_date . ' +6 weeks')) : null;
                $batch_end_date2 = !empty($batch_start_date2) ? date('Y-m-d', strtotime($batch_start_date2 . ' +6 weeks')) : null;
                $selectedBatchIndex = 0;
                foreach ($batch_detail as $i => $slot) {
                    $remarkText = strtolower(strip_tags(html_entity_decode($slot['remark'] ?? '')));
                    if (strpos($remarkText, 'started') === false) {
                        $selectedBatchIndex = $i;
                        break;
                    }
                }
            @endphp
            <section id="batch_shedule" class="page-section course_batch paddingt_80 paddinb_80">
                <div class="container">
                    <h2 class="section_heading course_batch_heading text-center">{{ $detail->batch_section_heading }}</h2>

                    <div class="course_batch_card">
                        <div class="course_batch_copy">
                            <h3 class="course_batch_title">{{ $batch->paced_title }}</h3>
                            <ul class="course_batch_points">
                                @foreach ($paced_pointer as $row)
                                    <li><i class="fas fa-check" aria-hidden="true"></i> @php echo html_entity_decode($row) @endphp</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="course_batch_action">
                            <a class="course_batch_btn" href="https://lms.attariclasses.in/" target="_blank">Visit Video Portal</a>
                        </div>
                    </div>

                    <div class="course_batch_card course_batch_card_online">
                        <div class="course_batch_copy">
                            <h3 class="course_batch_title">{{ $batch->oc_title }} <span class="course_batch_badge">Preferred</span></h3>
                            <ul class="course_batch_points">
                                @foreach ($oc_pointer as $row)
                                    <li><i class="fas fa-check" aria-hidden="true"></i> @php echo html_entity_decode($row) @endphp</li>
                                @endforeach
                            </ul>
                            @if (!empty($batch_detail))
                                <div class="course_batch_slots">
                                    @foreach ($batch_detail as $i => $row)
                                        @php
                                            $remarkHtml = html_entity_decode($row['remark'] ?? '');
                                            $remarkPlain = strtolower(strip_tags($remarkHtml));
                                            $isStarted = strpos($remarkPlain, 'started') !== false;
                                            $isSelected = $i === $selectedBatchIndex;
                                        @endphp
                                        <div class="course_batch_slot {{ $isSelected ? 'is-selected' : '' }} {{ $isStarted ? 'is-started' : '' }}">
                                            <div class="course_batch_slot_title">@php echo html_entity_decode($row['schedule']) @endphp</div>
                                            @if (!empty($row['remark']))
                                                <div class="course_batch_slot_note">@php echo $remarkHtml @endphp</div>
                                            @endif
                                            <div class="course_batch_meta">
                                                <span><i class="far fa-calendar-alt" aria-hidden="true"></i> {{ formatDate($row['date']) }}</span>
                                                @if (!empty($row['start_time']) && !empty($row['end_time']))
                                                    <span><i class="far fa-clock" aria-hidden="true"></i> {{ date('g:i A', strtotime($row['start_time'])) }} to {{ date('g:i A', strtotime($row['end_time'])) }} (IST)</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="course_batch_offer">
                            <p>Get In Touch to Avail</p>
                            <strong>{{ $batch->off_percentage }} OFF</strong>
                            <button type="button" class="course_batch_btn" onclick="formModal('{{ url(route('component.form')) }}?section=Online / Classroom - course Page&title=Book a Demo&current_page={{ urlencode(url()->current()) }}&course_name={{$courseInputName}}')">Book a Demo</button>
                        </div>
                    </div>

                    <div class="course_batch_card">
                        <div class="course_batch_copy">
                            <h3 class="course_batch_title">{{ $batch->corp_title }}</h3>
                            <ul class="course_batch_points">
                                @foreach ($corp_pointer as $row)
                                    <li><i class="fas fa-check" aria-hidden="true"></i> @php echo html_entity_decode($row) @endphp</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="course_batch_action">
                            <button type="button" class="course_batch_btn" onclick="formModal('{{ url(route('component.form')) }}?section={{$batch->corp_title. ' - course Page'}}&current_page={{ urlencode(url()->current()) }}&title=Enquire Now&course_name={{$courseInputName}}')">Enquire Now</button>
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
    $courseId = (int) ($cms->course_id ?? $detail->id);
    $cId = $courseId;
    $courseMenuName = $cms->menu_title ?: 'demo';
    $trainerHeading = 'Meet Our Expert Trainer';
    $trainerDesc = 'Learn from Industry Expert Trainer';
    $skillsHeading = 'Services and skills you will master';
    $demoCtaTitle = 'Attend a free ' . $courseMenuName . ' demo class this week';
    $demoCtaText = 'Sit through a live session, meet the trainer, see the labs — then decide.';

    $skillsByCourse = [
        5 => [ // VMware vSphere + vSAN
            'ESXi & vCenter',
            'vSphere Clustering',
            'vSAN Basics',
            'vMotion & DRS',
            'HA & Fault Tolerance',
            'vSwitch & Networking',
            'Datastores & Storage',
            'Snapshots & Clones',
            'Resource Pools',
            'VM Management',
            'Troubleshooting',
            'Hands-on Labs',
        ],
        7 => [ // AWS Cloud with GenAI
            'EC2 & Auto Scaling',
            'VPC & Subnetting',
            'IAM & Security',
            'S3 & CloudFront',
            'RDS & DynamoDB',
            'Lambda & Serverless',
            'CloudWatch & CloudTrail',
            'Route 53 & ELB',
            'GenAI on AWS',
            'Bedrock & AI Services',
            'AI-assisted Scripting',
            'Hands-on Labs',
        ],
        8 => [ // AZURE Cloud with GenAI
            'Virtual Machines',
            'Virtual Networks',
            'Entra ID & IAM',
            'Storage Accounts',
            'Azure OpenAI',
            'Azure AI Services',
            'NSG & Security',
            'Azure Monitor',
            'Hybrid Identity',
            'Architecture Design',
            'Hands-on Labs',
        ],
        10 => [ // CCNA with Automation
            'IP Addressing & Subnetting',
            'VLANs & Trunking',
            'Routing Protocols',
            'OSPF',
            'STP & EtherChannel',
            'ACLs & NAT',
            'Network Automation',
            'Python for Networking',
            'Packet Tracer Labs',
            'Hands-on Labs',
        ],
        11 => [ // Windows Server Hybrid
            'Active Directory',
            'DNS & DHCP',
            'Group Policy',
            'Hyper-V',
            'File Services',
            'Failover Clustering',
            'Windows Admin Center',
            'Hybrid Azure AD',
            'WSUS & Patching',
            'Identity Management',
            'Troubleshooting',
            'Hands-on Labs',
        ],
        9 => [ // MCSE
            'Active Directory',
            'DNS & DHCP',
            'Group Policy',
            'File & Print Services',
            'IIS Web Server',
            'RAID & Storage',
            'Backup & Restore',
            'User Management',
            'Troubleshooting',
            'Hands-on Labs',
        ],
    ];

    $skillTags = $skillsByCourse[$courseId] ?? [
        'Hands-on Labs',
        'Real-Time Projects',
        'Interview Preparation',
        'Architecture Design',
        'Troubleshooting',
        'Certification Guidance',
    ];

    if ($courseId == 5) {
        $trainerHeading = 'VMware';
        $trainerDesc = 'Learn VMware vSphere Server Virtualization from Industry Expert Trainer';
    } elseif ($courseId == 7) {
        $trainerHeading = 'AWS';
        $trainerDesc = 'Learn AWS Cloud Computing from Industry Expert Trainer';
    } elseif ($courseId == 8) {
        $trainerHeading = 'Azure';
        $trainerDesc = 'Learn Microsoft Azure Cloud Computing from Industry Expert Trainer';
    } elseif ($courseId == 11) {
        $trainerHeading = 'Windows Server';
        $trainerDesc = 'Learn Windows Server Hybrid Administration from Industry Expert Trainer';
    } elseif ($courseId == 10) {
        $trainerHeading = 'CCNA';
        $trainerDesc = 'Learn CCNA Networking from Industry Expert Trainer';
    } elseif ($courseId == 9) {
        $trainerHeading = 'Windows Server';
        $trainerDesc = 'Learn Windows Server Administration from Industry Expert Trainer';
    }
@endphp



@if(in_array($cId, [5, 7]))
                    
                    <section id="trainer_profile" class="page-section nx_trainer_section">
                          <div class="container">
                            <div class="text-center">
                              <h2 class="nx_trainer_heading">Meet Our <span>Expert Trainer</span></h2>
                              <p class="nx_trainer_desc">{{ $trainerDesc }}</p>
                            </div>
                            <div class="nx_trainer_box">
                               <div class="nx_trainer_top">
                                  <div class="nx_trainer_identity">
                                        
                                        <div>
                                            <h3 class="nx_trainer_name">Mr. Maqsood Sheikha</h3>
                                            <div class="nx_trainer_role">VMware & AWS Cloud Trainer</div>
                                        </div>
                                  </div>
                                  <div class="nx_trainer_btn_wrap">
                                      <button type="button" class="trainer-btn nx_trainer_btn" data-modal="maqsoodModal">View Full Profile</button>
                                  </div>
                              </div>
                              <div class="nx_trainer_content">
                                    <ul class="nx_trainer_points">
                                      <li>Training Since 2011</li>
                                      <li>10,000+ Students Trained</li>
                                      <li>VMware vSphere & AWS Cloud Specialist</li>
                                      <li>Enterprise IT Infrastructure Project Experience</li>
                                      <li>Students Across India, Gulf Countries & North America</li>
                                      <li>Hands-on Real Time Project Training</li>
                                    </ul>
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
                             
                           
                         <section id="trainer_profile" class="page-section nx_trainer_section">
                          <div class="container">
                            <div class="text-center">
                              <h2 class="nx_trainer_heading">Meet Our <span>Expert Trainer</span></h2>
                              <p class="nx_trainer_desc">{{ $trainerDesc }}</p>
                            </div>
                            <div class="nx_trainer_box">
                               <div class="nx_trainer_top">
                                  <div class="nx_trainer_identity">
                                       
                                        <div>
                                            <h3 class="nx_trainer_name">Mr. Zameer Momin</h3>
                                            <div class="nx_trainer_role">Microsoft Azure, Windows Server Hybrid & Networking Trainer</div>
                                        </div>
                                  </div>
                                  <div class="nx_trainer_btn_wrap">
                                      <button type="button" class="trainer-btn nx_trainer_btn" data-modal="zamirModal">View Full Profile</button>
                                  </div>
                              </div>
                              <div class="nx_trainer_content">
                                    <ul class="nx_trainer_points">
                                      <li>Training Since 2017</li>
                                      <li>8,000+ Students Trained</li>
                                      <li>Azure, Windows Server Hybrid & CCNA Networking</li>
                                      <li>Enterprise Infrastructure Experience</li>
                                      <li>Students Across India, Gulf Countries & North America</li>
                                      <li>Hands-on Real Time Project Training</li>
                                    </ul>
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

        <section id="skills_master" class="paddingt_80 paddinb_80 page-section course_skills_section">
            <div class="container">
                <h2 class="course_skills_heading">{{ $skillsHeading }}</h2>
                <div class="course_skills_tags">
                    @foreach ($skillTags as $skillTag)
                        <span>{{ $skillTag }}</span>
                    @endforeach
                </div>

                <div class="course_skills_cta">
                    <div class="course_skills_cta_copy">
                        <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                        <h3>{{ $demoCtaTitle }}</h3>
                        <p>{{ $demoCtaText }}</p>
                    </div>
                    <div class="course_skills_cta_actions">
                        <button type="button" class="course_skills_cta_demo" onclick="formModal('{{ url(route('component.form')) }}?section=Skills - Book Free Demo&title=Book a FREE Demo&current_page={{ urlencode(url()->current()) }}&course_name={{$courseInputName}}')">Book free demo</button>
                        <a class="course_skills_cta_whatsapp" target="_blank" rel="noopener" href="https://api.whatsapp.com/send?phone=917738375431&text=Hi%2C+I+am+contacting+you+through+your+website">Chat on WhatsApp</a>
                    </div>
                </div>
            </div>
        </section>

    <!--Faq section-->

        <section id="faqs" class="page-section course_faq_section">
            <div class="container">
                @if (!empty($faq) && $faq->count() > 0)
                    <h2 class="course_faq_heading">{{ $detail->faq_section_heading }}</h2>
                @endif

                <div class="course_faq_layout">
                    @if (!empty($faq))
                        <div class="course_faq_list_wrap">
                            <div class="course_faq_list accordion--container accordion_style_one">
                                @foreach ($faq as $row)
                                    <div class="accordionone{{ $loop->index >= 10 ? ' faq_extra' : '' }}">
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
                            @if ($faq->count() > 10)
                                <button type="button" class="course_faq_toggle" aria-expanded="false">
                                    View More <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                </button>
                            @endif
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

                    <div class="overview_talk">
                                <div class="overview_talk_header">
                                    <p class="overview_talk_title">Talk To Us</p>
                                    <p class="overview_talk_subtitle">We are happy to help you</p>
                                </div>

                                <a class="overview_talk_phone" href="tel:+917738375431">
                                    <span class="overview_talk_flag" aria-hidden="true"></span>
                                    <span>+91-7738375431</span>
                                </a>

                                <div class="overview_talk_quote">
                                    <div class="overview_talk_quote_mark" aria-hidden="true">&ldquo;</div>
                                    <p>Build your cloud skills with live trainer guidance, hands-on labs, and support whenever you need help.</p>
                                    <p class="overview_talk_quote_author">- Attari Classes</p>
                                </div>

                                <div class="overview_talk_actions">
                                    <a class="overview_talk_whatsapp" target="_blank" rel="noopener" href="https://api.whatsapp.com/send?phone=917738375431&text=Hi%2C+I+am+contacting+you+through+your+website">
                                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                        <span>Chat on WhatsApp</span>
                                    </a>
                                    <button type="button" class="overview_talk_demo" onclick="formModal('{{ url(route('component.form')) }}?section=Overview - Book Free Demo&title=Book a FREE Demo&current_page={{ urlencode(url()->current()) }}&course_name={{$courseInputName}}')">Book a free demo</button>
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
            ->get(['cms.course_id', 'cms.slug', 'cms.menu_title', 'courses.thumbnail']);
            
        $course_wsh  = $cms_courses->firstWhere('course_id', 11);
        
        if (!$course_wsh) {
            $cms_courses_temp = DB::table('cms')
                ->join('courses', 'cms.course_id', '=', 'courses.id')
                ->where('cms.status', 1)
                ->where('cms.zone', 0)
                ->where('cms.course_id', 11)
                ->get(['cms.course_id', 'cms.slug', 'cms.menu_title', 'courses.thumbnail']);
        
            $course_wsh = $cms_courses_temp->first();
        }

        $otherCourseMeta = [
            5 => [
                'category' => 'VMWARE',
                'title' => 'VMware vSphere',
                'icon' => 'fas fa-server',
                'image' => '/assets/frontend/images/other-course-vmware.jpg',
            ],
            7 => [
                'category' => 'AWS',
                'title' => 'AWS Cloud Architect',
                'icon' => 'fas fa-cloud',
                'image' => '/assets/frontend/images/other-course-azure.jpg',
            ],
            8 => [
                'category' => 'AZURE',
                'title' => 'Azure Cloud Administrator',
                'icon' => 'fas fa-cloud',
                'image' => '/assets/frontend/images/other-course-azure.jpg',
            ],
            9 => [
                'category' => 'MICROSOFT',
                'title' => 'Windows Server Hybrid',
                'icon' => 'fas fa-layer-group',
                'image' => '/assets/frontend/images/other-course-windows.jpg',
            ],
            11 => [
                'category' => 'MICROSOFT',
                'title' => 'Windows Server Hybrid',
                'icon' => 'fas fa-layer-group',
                'image' => '/assets/frontend/images/other-course-windows.jpg',
            ],
            10 => [
                'category' => 'CISCO',
                'title' => 'Cisco Networking CCNA',
                'icon' => 'fas fa-globe',
                'image' => '/assets/frontend/images/other-course-cisco.jpg',
            ],
        ];

        $otherCourses = [];
        $seenCourseIds = [];
        foreach ($cms_courses as $row) {
            if ($row->course_id == 9 && $course_wsh) {
                $row = $course_wsh;
            }
            if ($row->course_id == $cId || isset($seenCourseIds[$row->course_id])) {
                continue;
            }
            if (!isset($otherCourseMeta[$row->course_id])) {
                continue;
            }
            $seenCourseIds[$row->course_id] = true;
            $otherCourses[] = $row;
        }
    @endphp
    
    <section class="other_courses course_other_section">
        <div class="container">
            <h2 class="course_other_heading">Other Courses We Offer</h2>
            <div class="course_other_grid">
                @foreach ($otherCourses as $row)
                    @php
                        $meta = $otherCourseMeta[$row->course_id];
                        $cardImage = $meta['image'];
                    @endphp
                    <a class="course_other_card" href="{{ url(route('course.detail', ['slug' => $row->slug] )) }}" style="background-image: url('{{ $cardImage }}');">
                        <span class="course_other_card_icon" aria-hidden="true"><i class="{{ $meta['icon'] }}"></i></span>
                        <span class="course_other_card_brand">{{ $meta['category'] }}</span>
                        <span class="course_other_card_title">{{ $row->menu_title ?: $meta['title'] }}</span>
                        <span class="course_other_card_badge">{{ $meta['category'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    

            @php
                $course_name = $courseInputName;
                session()->put('course_name', $course_name);
                $cms_alias_city = DB::table('cms')->where('status', 1)->where('zone', 1)->where('course_id', $cms->course_id)->whereNot('id', $cms->id)->get(['alias', 'slug']);
                $cms_alias_country = DB::table('cms')->where('status', 1)->where('zone', 2)->where('course_id', $cms->course_id)->whereNot('id', $cms->id)->get(['alias', 'slug']);
                $hasLocationContent = $cms_alias_city->isNotEmpty() || $cms_alias_country->isNotEmpty();
                $hasSeoContent = !empty($detail->seo_label) && !empty($detail->seo_description);
            @endphp

            @if($hasLocationContent || $hasSeoContent)
    <section class="location_section course_location_section">
        <div class="container">
            @if($hasLocationContent)
            <p class="course_location_label">Find by Location</p>
            <h2 class="course_location_heading">Find {{ $course_name }} by Location</h2>
            @endif

            @if($cms_alias_city->isNotEmpty())
                <div class="course_location_card">
                    <div class="course_location_card_head">
                        <span class="course_location_card_icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></span>
                        <h3>{{ $course_name }} in other Cities</h3>
                    </div>
                    <ul class="course_location_pills list-container">
                        @foreach ($cms_alias_city as $index => $row)
                            <li class="list-item" data-index="{{ $index }}">
                                <a href="{{ url(route('course.detail', ['slug' => $row->slug] )) }}">{{ $row->alias }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <button type="button" class="load-more-btns">Load More</button>
                </div>
            @endif

            @if($cms_alias_country->isNotEmpty())
                <div class="course_location_card">
                    <div class="course_location_card_head">
                        <span class="course_location_card_icon" aria-hidden="true"><i class="fas fa-globe"></i></span>
                        <h3>{{ $course_name }} in other Countries</h3>
                    </div>
                    <ul class="course_location_pills list-container">
                        @foreach ($cms_alias_country as $index => $row)
                            <li class="list-item" data-index="{{ $index }}">
                                <a href="{{ url(route('course.detail', ['slug' => $row->slug])) }}">{{ $row->alias }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <button type="button" class="load-more-btns">Load More</button>
                </div>
            @endif

            @if(!empty($detail->seo_label) && !empty($detail->seo_description))
                @php
                    $seo_label = ReplaceKeyword($detail->seo_label, $cms->replace_keyword);
                    $seo_description = ReplaceKeyword($detail->seo_description, $cms->replace_keyword);
                @endphp
                <div class="course_location_seo">
                    <h2
                        class="course-info-heading"
                        role="button"
                        tabindex="0"
                        aria-expanded="false"
                        aria-controls="courseInfoContent"
                    >
                        <span class="course-info-icon">+</span>
                        <span>{{ $seo_label }}</span>
                    </h2>
                    <div id="courseInfoContent" class="course-info-content">
                        <div class="course-info-inner">
                            @php echo html_entity_decode($seo_description) @endphp
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
            @endif

    <style>
	.hidden_classes {
		display: none;
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
            let initialCount = screenWidth <= 767 ? 8 : 14;

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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("#projects_covered .projects_covered_box").forEach(function (box) {
                var items = box.querySelectorAll(".proj-cov li");
                var btn = box.querySelector(".projects_view_more");
                if (!btn) {
                    return;
                }
                if (items.length <= 4) {
                    btn.style.display = "none";
                    return;
                }
                btn.addEventListener("click", function () {
                    var expanded = box.classList.toggle("is-expanded");
                    btn.innerHTML = expanded
                        ? 'View Less <i class="fa fa-chevron-up" aria-hidden="true"></i>'
                        : 'View More <i class="fa fa-chevron-down" aria-hidden="true"></i>';
                    if (window.jQuery && jQuery(".projects-covered").length) {
                        jQuery(".projects-covered").trigger("refresh.owl.carousel");
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("#testimonials .course_review_card").forEach(function (card) {
                var text = card.querySelector(".course_review_text");
                var btn = card.querySelector(".course_review_more");
                if (!text || !btn) {
                    return;
                }
                if (text.scrollHeight <= text.clientHeight + 8) {
                    btn.style.display = "none";
                    return;
                }
                btn.addEventListener("click", function () {
                    var expanded = card.classList.toggle("is-expanded");
                    btn.innerHTML = expanded
                        ? 'View Less <i class="fa fa-chevron-up" aria-hidden="true"></i>'
                        : 'View More <i class="fa fa-chevron-down" aria-hidden="true"></i>';
                    if (window.jQuery && jQuery(".course_text_reviews").length) {
                        jQuery(".course_text_reviews").trigger("refresh.owl.carousel");
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("#faqs .course_faq_list_wrap").forEach(function (wrap) {
                var list = wrap.querySelector(".course_faq_list");
                var btn = wrap.querySelector(".course_faq_toggle");
                if (!list || !btn) {
                    return;
                }
                btn.addEventListener("click", function () {
                    var expanded = list.classList.toggle("is-expanded");
                    btn.setAttribute("aria-expanded", expanded ? "true" : "false");
                    btn.innerHTML = expanded
                        ? 'View Less <i class="fa fa-chevron-up" aria-hidden="true"></i>'
                        : 'View More <i class="fa fa-chevron-down" aria-hidden="true"></i>';
                    if (!expanded) {
                        list.querySelectorAll(".faq_extra.open").forEach(function (item) {
                            item.classList.remove("open");
                            var panel = item.querySelector(".contentsillabus_div1");
                            if (panel) {
                                panel.style.display = "none";
                            }
                        });
                    }
                });
            });
        });
    </script>
    
@endsection
