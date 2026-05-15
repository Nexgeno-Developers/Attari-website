@extends('frontend.layouts.app')

@php
    $meta_title = '';
    $meta_description = '';
    $meta_url = url()->current();
@endphp

@section('page.title', 'VMware, AWS, Azure, MCSE/MCSA, CCNA Training Institute in Mumbai')

@section('page.description', 'Best Training & Certification institute for VMware, AWS, Azure, MCSE/MCSA, CCNA in Mumbai & across India. Online & Classroom Training options')

@section('page.type', 'website')

@section('page.content')

<style>
    .nav-sections .menu-item-link {
    font-size: 14px;
}
.batch_shedule_box {
    margin-bottom: 0;
}

section#testimonials {
    height: 624.33px;
}
</style>


<!----------========== batch start ===============-------------------->

    <section class="sm-at banner1 batch_banner">
        <img class="inner-banner-image" src="assets/frontend/images/Batch-Schedule-1.jpg"/>
        <div class="container mt235">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrums_section paddtb80">
                        <h1 class="sm-aboutus color-white1">Batch Schedule</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url(route('index')) }}">Home</a></li>
                                <li class="breadcrumb-item"><a>»</a></li>
                                <li class="breadcrumb-item"><a><b>Batch Schedule</b></a></li>
                            </ol>
                        </nav>
                    </div>
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
                            <a class="menu-item-link active" href="{{request()->url()}}/#vmware-batch-traning" data-href="#vmware-batch-traning">VMware Training Batch Schedule</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#aws-batch-traning" data-href="#aws-batch-traning">AWS Training Batch Schedule</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#azure-batch-traning" data-href="#azure-batch-traning">Azure Training Batch Schedule</a>
                        </li>
                        {{-- <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#mcse-batch-traning" data-href="#mcse-batch-traning">MCSE Training Batch Schedule</a>
                        </li> --}}
                        <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#windows-server-hybrid-training" data-href="#windows-server-hybrid-training">Windows Server Hybrid Training</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-item-link" href="{{request()->url()}}/#ccna-batch-traning" data-href="#ccna-batch-traning">CCNA Training Batch Schedule</a>
                        </li>
                        <div class="active-line"></div>
                    </ul>
                </nav>
            </div>
        </div>
    </section>


    <div class="batch_main_section page-sections">
<!---------=============================== VMware =========================-------------------->

    <!------------------========================== schedule ===============================-------------------->
    
    
    <div id="vmware-batch-traning">
    <section id="vmware_batch" class="page-section prje_cove_section light_gray_bg pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="section_heading pb-3 text-center"> <b>VMware Training Schedule</b></h4>
                </div>

                @php
                
                    $vmware_batch = DB::table('batches')->where('status', 1)->where('course_id','5')->get(['oc_pointer_list', 'batch_detail', 'off_percentage', 'status','course_id'])->first();

                    $oc_vm_pointer = json_decode($vmware_batch->oc_pointer_list);

                    $batch_vm_detail = json_decode($vmware_batch->batch_detail, true);
                    $batch_vm_dates = array_column($batch_vm_detail, 'date');
        
                    $batch_start_times = array_column($batch_vm_detail, 'start_time');
                    $batch_end_times = array_column($batch_vm_detail, 'end_time');
                    
                    // Set start times
                    $batch_vm_startTime1 = isset($batch_start_times[0]) ? $batch_start_times[0] : null; 
                    $batch_vm_startTime2 = isset($batch_start_times[1]) ? $batch_start_times[1] : null; 
                    
                    // Set end times
                    $batch_vm_endTime1 = isset($batch_end_times[0]) ? $batch_end_times[0] : null;
                    $batch_vm_endTime2 = isset($batch_end_times[1]) ? $batch_end_times[1] : null;

                    // Get the start and end dates
                    $batch_vm_start_date = isset($batch_vm_dates[0]) ? date("Y-m-d", strtotime($batch_vm_dates[0])) : null;
                    $batch_vm_start_date2 = isset($batch_vm_dates[1]) ? date("Y-m-d", strtotime($batch_vm_dates[1])) : null;

                    $batch_vm_start_date = !empty($batch_vm_start_date) ? date("Y-m-d", strtotime($batch_vm_start_date)) : null; 
                    $batch_vm_start_date2 = !empty($batch_vm_start_date2) ? date("Y-m-d", strtotime($batch_vm_start_date2)) : null;
                
                    $batch_vm_end_date = !empty($batch_vm_start_date) ? date('Y-m-d', strtotime($batch_vm_start_date . ' +6 weeks')) : null;
                    $batch_vm_end_date2 = !empty($batch_vm_start_date2) ? date('Y-m-d', strtotime($batch_vm_start_date2 . ' +6 weeks')) : null;


                    $course_schema_vm = DB::table('courses')->where('status', 1)->where('id','5')->get(['batch_section_schema','video_section_schema','testimonials_section_schema'])->first();
                    
                @endphp

                @if(!empty($vmware_batch))
                    <div class="batch_shedule_box">
                        <div class="row align-items-center">
                            <div class="col-md-9">

                                <ul>
                                    @foreach ($oc_vm_pointer as $row)
                                        <li><i aria-hidden="true" class="far fa-check-circle"></i> @php echo html_entity_decode($row) @endphp</li>
                                    @endforeach
                                </ul>
                                
                                @if(!empty($batch_vm_detail))
                                    <table class="batch_table table">
                                        <tbody>
                                            <tr class="pdd_14">
                                                <td width="20"><div>DATE</div></td>
                                                <td width="40"><div>SCHEDULE </div></td>
                                                <td width="40"><div>TIME </div></td>
                                            </tr>
                                            @foreach ($batch_vm_detail as $row)
                                                <tr class="pdd_19">
                                                    <td><div>{{ formatDate($row['date']) }}</div></td>
                                                    <td><div>@php echo html_entity_decode($row['schedule']) @endphp<span class="text_red">@php echo html_entity_decode($row['remark']) @endphp</span></div></td>
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

                                            <tr class="pdd_19">
                                                <td><div><b>24*7</b></div></td>
                                                <td><div>Self Paced Learning <span class="text_red">Live Recorded Lectures</span>
                                                </div></td>
                                                <td><div><b class="text_blue"><a href="https://lms.attariclasses.in/">Always
                                                            Available</a></b></div></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                @endif

                            </div>


                            <div class="col-md-3">
                                <div class="button_main getin_touch_bx">
                                    <h5>Get In Touch to Avail <span>{{ $vmware_batch->off_percentage }} OFF</span>
                                    </h5>

                                    <button type="button" onclick="formModal('{{ url(route('component.form')) }}?section=VMware Training Schedule - Batch Page&title=Book a FREE Demo&current_page={{ urlencode(url()->current()) }}')" 
                                    class="btn bookfreedemo_button"> Book a Demo</button>

                                    <a class="view_coursebtn"
                                        href="{{ url('vmware-training-certification-online') }}"
                                        target="_blank">View Course Details <i aria-hidden="true"
                                            class="far fa-arrow-alt-circle-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

    <!-----------------================== Batch vm Schema =========================------------------------------>

    @php 
        echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]','[{start_date1}]','[{start_date2}]','[{end_date1}]','[{end_date2}]','[{start_time1}]','[{start_time2}]','[{end_time1}]','[{end_time2}]'],
        ["VMware Training Schedule", "Best Training & Certification institute for VMware in Mumbai & across India. Online & Classroom Training options", $meta_url, $batch_vm_start_date, $batch_vm_start_date2, $batch_vm_end_date, $batch_vm_end_date2, $batch_vm_startTime1, $batch_vm_startTime2, $batch_vm_endTime1,  $batch_vm_endTime2], 
        html_entity_decode($course_schema_vm->batch_section_schema));
    @endphp

    <!-----------------================== Batch vm Schema =========================------------------------------>


                @endif

            </div>
        </div>
    </section>
    <!------------------========================== schedule ===============================-------------------->

    <!---------------------=========================== Testimonials ===============-------------------------->

    <section id="testimonials" class="testiminilas_sec gradiant_bg pt-5 pb-5 dot_clr_white position_relative">
        <div class="container">
            <h3 class="heading_title text-center pddtop_0 pb-3 textcolor_wht ">VMware Training Testimonials</h3>
    
    <!-----------============= video testimonials ===============---------------------------------->

    @php
        $video_vm_review = DB::table('video_reviews')->where('status', 1)->where('course_id','5')->get();
    @endphp
    
            @if(!empty($video_vm_review))
                <div class="large-12 columns">
                    <div class="owl-carousel owl-theme video_testiminials">

                        @foreach ($video_vm_review as $row)
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
                                        {{--<img data-src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                            class="img-fluid d-block w-100 lazyload" alt=""> --}}
                                        <img data-src="{{ asset('storage/' . $row->image) }}"
                                            class="img-fluid d-block w-100 lazyload" alt="">
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            <!--------------------- video vm Review schema -------------------------------------->

            @php 
                echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],["VMware Training Testimonials",$meta_description,$meta_url], html_entity_decode($course_schema_vm->video_section_schema));
            @endphp

            <!--------------------- video vm Review schema -------------------------------------->


            @endif



    <!-----------============= video testimonials ===============---------------------------------->
    @php
        $text_vm_review = DB::table('text_reviews')->where('status', 1)->where('course_id','5')->whereIn('type', ['google', 'google_mcse'])->get();
    @endphp
    
        @if(!empty($text_vm_review))
            <div class="large-12 columns mt-4">
                <div class="owl-carousel owl-theme slider_content_dots">

                    @foreach ($text_vm_review as $row)
    
                        <div class="item">
                            <div class="testimonial_box">
                                <div class="testimonial__header">
                                    <div class="row">
                                        <div class="col-lg-6 col-10">
                                            <div class="testimonial__image">
                                                <img data-src="{{ asset('storage/' . $row->thumbnail) }}"
                                                    class="img-fluid d-block w-100 lazyload" alt="">
                                                <span class="testimonial__name">{{ $row->name }}</span>
                                            </div>
                                            <span>{{ $row->profile }}</span>
                                        </div>
                                        <div class="col-lg-6 col-2">
                                            <div class="testimonial__icon">
                                                @if($row->type == 'google')
                                                    <a href="{{ $row->url }}"><i aria-hidden="true" class="fab fa-google-plus"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial__content">
                                    <div class="testimonial__text">
                                         @php echo html_entity_decode($row->description) @endphp
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

        <!--------------------- Text vm Review -------------------------------------->

        @php 
            echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],["VMware Training Testimonials",$meta_description,$meta_url], html_entity_decode($course_schema_vm->testimonials_section_schema));
        @endphp

        <!--------------------- Text vm Review -------------------------------------->



        @endif
      
        </div>
    </section>
    
    </div>

    <!---------------------=========================== Testimonials ===============-------------------------->

<!------------=================================== VMware ==========================---------------------------->





<!-------================================== AWS =============================----------------------------------->

    <!------------------========================== schedule ===============================-------------------->
    
    <div id="aws-batch-traning">
    <section id="aws_batch" class="page-section prje_cove_section light_gray_bg pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="section_heading pb-3 text-center"> <b>AWS Training Schedule</b></h4>
                </div>

                @php 

                    $aws_batch = DB::table('batches')->where('status', 1)->where('course_id','7')->get(['oc_pointer_list', 'batch_detail', 'off_percentage', 'status','course_id'])->first();
                    $oc_aws_pointer = json_decode($aws_batch->oc_pointer_list);
                    $batch_aws_detail = json_decode($aws_batch->batch_detail, true);

                    $batch_aws_dates = array_column($batch_aws_detail, 'date');
                    
                    
                    $batch_start_times = array_column($batch_aws_detail, 'start_time');
                    $batch_end_times = array_column($batch_aws_detail, 'end_time');

                    // Set start times
                    $batch_aws_startTime1 = isset($batch_start_times[0]) ? $batch_start_times[0] : null; 
                    $batch_aws_startTime2 = isset($batch_start_times[1]) ? $batch_start_times[1] : null; 
                    
                    // Set end times
                    $batch_aws_endTime1 = isset($batch_end_times[0]) ? $batch_end_times[0] : null;
                    $batch_aws_endTime2 = isset($batch_end_times[1]) ? $batch_end_times[1] : null;

                    // Get the start and end dates
                    $batch_aws_start_date = isset($batch_aws_dates[0]) ? date("Y-m-d", strtotime($batch_aws_dates[0])) : null;
                    $batch_aws_start_date2 = isset($batch_aws_dates[1]) ? date("Y-m-d", strtotime($batch_aws_dates[1])) : null;

                    $batch_aws_start_date = !empty($batch_aws_start_date) ? date("Y-m-d", strtotime($batch_aws_start_date)) : null; 
                    $batch_aws_start_date2 = !empty($batch_aws_start_date2) ? date("Y-m-d", strtotime($batch_aws_start_date2)) : null;
                
                    $batch_aws_end_date = !empty($batch_aws_start_date) ? date('Y-m-d', strtotime($batch_aws_start_date . ' +6 weeks')) : null;
                    $batch_aws_end_date2 = !empty($batch_aws_start_date2) ? date('Y-m-d', strtotime($batch_aws_start_date2 . ' +6 weeks')) : null;

                    $course_schema_aws = DB::table('courses')->where('status', 1)->where('id','7')->get(['batch_section_schema','video_section_schema','testimonials_section_schema'])->first();

                @endphp

                @if(!empty($aws_batch))
                    <div class="batch_shedule_box">
                        <div class="row align-items-center">
                            <div class="col-md-9">

                                <ul>
                                    @foreach ($oc_aws_pointer as $row)
                                        <li><i aria-hidden="true" class="far fa-check-circle"></i> @php echo html_entity_decode($row) @endphp</li>
                                    @endforeach
                                </ul>
                                
                                @if(!empty($batch_aws_detail))
                                    <table class="batch_table table">
                                        <tbody>
                                            <tr class="pdd_14">
                                                <td width="20"><div>DATE</div></td>
                                                <td width="40"><div>SCHEDULE </div></td>
                                                <td width="40"><div>TIME</div> </td>
                                            </tr>
                                            @foreach ($batch_aws_detail as $row)
                                                <tr class="pdd_19">
                                                    <td><div>{{ formatDate($row['date']) }}</div></td>
                                                    <td><div>@php echo html_entity_decode($row['schedule']) @endphp<span class="text_red">@php echo html_entity_decode($row['remark']) @endphp</span></div></td>
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

                                            <tr class="pdd_19">
                                                <td><div><b>24*7</b></div></td>
                                                <td><div>Self Paced Learning <span class="text_red">Live Recorded Lectures</span></div>
                                                </td>
                                                <td><div><b class="text_blue"><a href="https://lms.attariclasses.in/">Always
                                                            Available</a></b></div></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                @endif

                            </div>


                            <div class="col-md-3">
                                <div class="button_main getin_touch_bx">
                                    <h5>Get In Touch to Avail <span>{{ $aws_batch->off_percentage }} OFF</span>
                                    </h5>
                                    
                                    <button type="button" onclick="formModal('{{ url(route('component.form')) }}?section=AWS Training Schedule - Batch Page&title=Book a FREE Demo&current_page={{ urlencode(url()->current()) }}')" 
                                    class="btn bookfreedemo_button"> Book a Demo</button>

                                    <a class="view_coursebtn"
                                        href="{{ url('aws-certification-training-online') }}"
                                        target="_blank">View Course Details <i aria-hidden="true"
                                            class="far fa-arrow-alt-circle-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

    <!-----------------================== Batch aws Schema =========================------------------------------>

    @php 
        echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]','[{start_date1}]','[{start_date2}]','[{end_date1}]','[{end_date2}]','[{start_time1}]','[{end_time1}]','[{start_time2}]','[{end_time2}]'],
        ["AWS Training Schedule", "Best Training & Certification institute for AWS in Mumbai & across India. Online & Classroom Training options", $meta_url, $batch_aws_start_date, $batch_aws_start_date2, $batch_aws_end_date, $batch_aws_end_date2, $batch_aws_startTime1, $batch_aws_endTime1, $batch_aws_startTime2, $batch_aws_endTime2], 
        html_entity_decode($course_schema_aws->batch_section_schema));
    @endphp

    <!-----------------================== Batch aws Schema =========================------------------------------>


                @endif

            </div>
        </div>
    </section>
    <!------------------========================== schedule ===============================-------------------->

    <!---------------------=========================== Testimonials ===============-------------------------->

    <section id="testimonials" class="testiminilas_sec gradiant_bg pt-5 pb-5 dot_clr_white position_relative zindex_11">
        <div class="container">
            <h3 class="heading_title text-center pddtop_0 pb-3 textcolor_wht ">AWS Cloud Training Testimonials</h3>
    
    <!-----------============= video testimonials ===============---------------------------------->

    @php
        $video_aws_review = DB::table('video_reviews')->where('status', 1)->where('course_id','7')->get();
    @endphp
    
            @if(!empty($video_aws_review))
                <div class="large-12 columns">
                    <div class="owl-carousel owl-theme video_testiminials">

                        @foreach ($video_aws_review as $row)
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
                                        {{--<img data-src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                            class="img-fluid d-block w-100 lazyload" alt=""> --}}
                                        <img data-src="{{ asset('storage/' . $row->image) }}"
                                            class="img-fluid d-block w-100 lazyload" alt="">
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>


        <!--------------------- video aws Review schema -------------------------------------->

            @php 
                echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],["AWS Cloud Training Testimonials",$meta_description,$meta_url], html_entity_decode($course_schema_aws->video_section_schema));
            @endphp

        <!--------------------- video aws Review schema -------------------------------------->


            @endif



    <!-----------============= video testimonials ===============---------------------------------->
    @php
        $text_aws_review = DB::table('text_reviews')->where('status', 1)->where('course_id','7')->whereIn('type', ['google', 'google_mcse'])->get();
        
    @endphp
    
        @if(!empty($text_aws_review))
            <div class="large-12 columns mt-4">
                <div class="owl-carousel owl-theme slider_content_dots">

                    @foreach ($text_aws_review as $row)
    
                        <div class="item">
                            <div class="testimonial_box">
                                <div class="testimonial__header">
                                    <div class="row">
                                        <div class="col-lg-6 col-10">
                                            <div class="testimonial__image">
                                                <img data-src="{{ asset('storage/' . $row->thumbnail) }}"
                                                    class="img-fluid d-block w-100 lazyload" alt="">
                                                <span class="testimonial__name">{{ $row->name }}</span>
                                            </div>
                                            <span>{{ $row->profile }}</span>
                                        </div>
                                        <div class="col-lg-6 col-2">
                                            <div class="testimonial__icon">
                                                @if($row->type == 'google')
                                                    <a href="{{ $row->url }}"><i aria-hidden="true" class="fab fa-google-plus"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial__content">
                                    <div class="testimonial__text">
                                         @php echo html_entity_decode($row->description) @endphp
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

    <!--------------------- Text aws Review -------------------------------------->

        @php 
            echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],["AWS Cloud Training Testimonials",$meta_description,$meta_url], html_entity_decode($course_schema_aws->testimonials_section_schema));
        @endphp

    <!--------------------- Text aws Review -------------------------------------->

        @endif
      
        </div>
    </section>
    </div>

    <!---------------------=========================== Testimonials ===============-------------------------->

<!-----------------=============================== AWS ======================================------------------------>


<!------------===================== azure =================================---------------------------->


    <!------------------========================== schedule ===============================-------------------->
    <div id="azure-batch-traning">
    <section id="azure_batch" class="page-section prje_cove_section light_gray_bg pt-5 pb-5 position_relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <h4 class="section_heading pb-3 text-center"> <b>Azure Training Schedule</b></h4>
                </div>

                @php        
                    $azure_batch = DB::table('batches')->where('status', 1)->where('course_id','8')->get(['oc_pointer_list', 'batch_detail','off_percentage','status','course_id'])->first();
                    $oc_azure_pointer = json_decode($azure_batch->oc_pointer_list);
                    $batch_azure_detail = json_decode($azure_batch->batch_detail, true);

                    $batch_azure_dates = array_column($batch_azure_detail, 'date');


                    $batch_start_times = array_column($batch_azure_detail, 'start_time');
                    $batch_end_times = array_column($batch_azure_detail, 'end_time');

                    // Set start times
                    $batch_azure_startTime1 = isset($batch_start_times[0]) ? $batch_start_times[0] : null; 
                    $batch_azure_startTime2 = isset($batch_start_times[1]) ? $batch_start_times[1] : null; 
                    
                    // Set end times
                    $batch_azure_endTime1 = isset($batch_end_times[0]) ? $batch_end_times[0] : null;
                    $batch_azure_endTime2 = isset($batch_end_times[1]) ? $batch_end_times[1] : null;

                    // Get the start and end dates
                    $batch_azure_start_date = isset($batch_azure_dates[0]) ? date("Y-m-d", strtotime($batch_azure_dates[0])) : null;
                    $batch_azure_start_date2 = isset($batch_azure_dates[1]) ? date("Y-m-d", strtotime($batch_azure_dates[1])) : null;

                    $batch_azure_start_date = !empty($batch_azure_start_date) ? date("Y-m-d", strtotime($batch_azure_start_date)) : null; 
                    $batch_azure_start_date2 = !empty($batch_azure_start_date2) ? date("Y-m-d", strtotime($batch_azure_start_date2)) : null;
                
                    $batch_azure_end_date = !empty($batch_azure_start_date) ? date('Y-m-d', strtotime($batch_azure_start_date . ' +6 weeks')) : null;
                    $batch_azure_end_date2 = !empty($batch_azure_start_date2) ? date('Y-m-d', strtotime($batch_azure_start_date2 . ' +6 weeks')) : null;

                    $course_schema_azure = DB::table('courses')->where('status', 1)->where('id','8')->get(['batch_section_schema','video_section_schema','testimonials_section_schema'])->first();

                @endphp

                @if(!empty($azure_batch))
                    <div class="batch_shedule_box">
                        <div class="row align-items-center">
                            <div class="col-md-9">

                                <ul>
                                    @foreach ($oc_azure_pointer as $row)
                                        <li><i aria-hidden="true" class="far fa-check-circle"></i> @php echo html_entity_decode($row) @endphp</li>
                                    @endforeach
                                </ul>
                                
                                @if(!empty($batch_azure_detail))
                                    <table class="batch_table table">
                                        <tbody>
                                            <tr class="pdd_14">
                                                <td width="20"><div>DATE</div></td>
                                                <td width="40"><div>SCHEDULE </div></td>
                                                <td width="40"><div>TIME </div></td>
                                            </tr>
                                            @foreach ($batch_azure_detail as $row)
                                                <tr class="pdd_19">
                                                    <td><div>{{ formatDate($row['date']) }}</div></td>
                                                    <td><div>@php echo html_entity_decode($row['schedule']) @endphp<span class="text_red">@php echo html_entity_decode($row['remark']) @endphp</span></div></td>
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

                                            <tr class="pdd_19">
                                                <td><div><b>24*7</b></div></td>
                                                <td><div>Self Paced Learning <span class="text_red">Live Recorded Lectures</span>
                                                </div></td>
                                                <td><div><b class="text_blue"><a href="https://lms.attariclasses.in/">Always
                                                            Available</a></b></div></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                @endif

                            </div>


                            <div class="col-md-3">
                                <div class="button_main getin_touch_bx">
                                    <h5>Get In Touch to Avail <span>{{ $azure_batch->off_percentage }} OFF</span>
                                    </h5>

                                    <button type="button" onclick="formModal('{{ url(route('component.form')) }}?section=Azure Training Schedule - Batch Page&title=Book a FREE Demo&current_page={{ urlencode(url()->current()) }}')" 
                                    class="btn bookfreedemo_button"> Book a Demo</button>

                                    <a class="view_coursebtn"
                                        href="{{ url('microsoft-azure-certification-training-online') }}"
                                        target="_blank">View Course Details <i aria-hidden="true"
                                            class="far fa-arrow-alt-circle-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

<!-----------------================== Batch azure Schema =========================------------------------------>

    @php 
        echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]','[{start_date1}]','[{start_date2}]','[{end_date1}]','[{end_date2}]','[{start_time1}]','[{end_time1}]','[{start_time2}]','[{end_time2}]'],
        ["Azure Training Schedule", "Best Training & Certification institute for Azure in Mumbai & across India. Online & Classroom Training options", $meta_url, $batch_azure_start_date, $batch_azure_start_date2, $batch_azure_end_date, $batch_azure_end_date2, $batch_azure_startTime1, $batch_azure_endTime1, $batch_azure_startTime2, $batch_azure_endTime2], 
        html_entity_decode($course_schema_azure->batch_section_schema));
    @endphp

<!-----------------================== Batch azure Schema =========================------------------------------>

                @endif

            </div>
        </div>
    </section>
    <!------------------========================== schedule ===============================-------------------->

    <!---------------------=========================== Testimonials ===============-------------------------->

    <section id="testimonials" class="testiminilas_sec gradiant_bg pt-5 pb-5 dot_clr_white position_relative">
        <div class="container">
            <h3 class="heading_title text-center pddtop_0 pb-3 textcolor_wht ">Azure Training Testimonials</h3>
    
    <!-----------============= video testimonials ===============---------------------------------->

    @php
        $video_azure_review = DB::table('video_reviews')->where('status', 1)->where('course_id','8')->get();
    @endphp
    
            @if(!empty($video_azure_review))
                <div class="large-12 columns">
                    <div class="owl-carousel owl-theme video_testiminials">

                        @foreach ($video_azure_review as $row)
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
                                        {{--<img data-src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                            class="img-fluid d-block w-100 lazyload" alt=""> --}}
                                        <img data-src="{{ asset('storage/' . $row->image) }}"
                                            class="img-fluid d-block w-100 lazyload" alt="">
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

    <!--------------------- video azure Review schema -------------------------------------->

            @php 
                echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],["Azure Training Testimonials",$meta_description,$meta_url], html_entity_decode($course_schema_azure->video_section_schema));
            @endphp

    <!--------------------- video azure Review schema -------------------------------------->


            @endif



    <!-----------============= video testimonials ===============---------------------------------->
    @php
        $text_azure_review = DB::table('text_reviews')->where('status', 1)->where('course_id','8')->whereIn('type', ['google', 'google_mcse'])->get();
        
    @endphp
    
        @if(!empty($text_azure_review))
            <div class="large-12 columns mt-4">
                <div class="owl-carousel owl-theme slider_content_dots">

                    @foreach ($text_azure_review as $row)
    
                        <div class="item">
                            <div class="testimonial_box">
                                <div class="testimonial__header">
                                    <div class="row">
                                        <div class="col-lg-6 col-10">
                                            <div class="testimonial__image">
                                                <img data-src="{{ asset('storage/' . $row->thumbnail) }}"
                                                    class="img-fluid d-block w-100 lazyload" alt="">
                                                <span class="testimonial__name">{{ $row->name }}</span>
                                            </div>
                                            <span>{{ $row->profile }}</span>
                                        </div>
                                        <div class="col-lg-6 col-2">
                                            <div class="testimonial__icon">
                                                @if($row->type == 'google')
                                                    <a href="{{ $row->url }}"><i aria-hidden="true" class="fab fa-google-plus"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial__content">
                                    <div class="testimonial__text">
                                         @php echo html_entity_decode($row->description) @endphp
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

    <!--------------------- Text azure Review -------------------------------------->

        @php 
            echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],["Azure Training Testimonials",$meta_description,$meta_url], html_entity_decode($course_schema_azure->testimonials_section_schema));
        @endphp

    <!--------------------- Text azure Review -------------------------------------->


        @endif
      
        </div>
    </section>
</div>
    <!---------------------=========================== Testimonials ===============-------------------------->

<!-------======================= azure =================----------------------------->




<!-------================================== WHI =============================----------------------------------->

    <!------------------========================== schedule ===============================-------------------->
    
    <div id="windows-server-hybrid-training">
    <section id="mcse_batch" class="page-section prje_cove_section light_gray_bg pt-5 pb-5 ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <h4 class="section_heading pb-3 text-center"> <b>Windows Server Hybrid Training Schedule</b></h4>
                </div>

                @php   
                                
                    $mcse_batch = DB::table('batches')->where('status', 1)->where('course_id','11')->get(['oc_pointer_list', 'batch_detail', 'off_percentage', 'status','course_id'])->first();
                    $oc_mcse_pointer = json_decode($mcse_batch->oc_pointer_list);
                    $batch_mcse_detail = json_decode($mcse_batch->batch_detail, true);

                    $batch_mcse_dates = array_column($batch_mcse_detail, 'date');
                    
                    $batch_start_times = array_column($batch_mcse_detail, 'start_time');
                    $batch_end_times = array_column($batch_mcse_detail, 'end_time');

                    // Set start times
                    $batch_mcse_startTime1 = isset($batch_start_times[0]) ? $batch_start_times[0] : null; 
                    $batch_mcse_startTime2 = isset($batch_start_times[1]) ? $batch_start_times[1] : null; 
                    
                    // Set end times
                    $batch_mcse_endTime1 = isset($batch_end_times[0]) ? $batch_end_times[0] : null;
                    $batch_mcse_endTime2 = isset($batch_end_times[1]) ? $batch_end_times[1] : null;

                    // Get the start and end dates
                    $batch_mcse_start_date = isset($batch_mcse_dates[0]) ? date("Y-m-d", strtotime($batch_mcse_dates[0])) : null;
                    $batch_mcse_start_date2 = isset($batch_mcse_dates[1]) ? date("Y-m-d", strtotime($batch_mcse_dates[1])) : null;

                    $batch_mcse_start_date = !empty($batch_mcse_start_date) ? date("Y-m-d", strtotime($batch_mcse_start_date)) : null; 
                    $batch_mcse_start_date2 = !empty($batch_mcse_start_date2) ? date("Y-m-d", strtotime($batch_mcse_start_date2)) : null;
                
                    $batch_mcse_end_date = !empty($batch_mcse_start_date) ? date('Y-m-d', strtotime($batch_mcse_start_date . ' +6 weeks')) : null;
                    $batch_mcse_end_date2 = !empty($batch_mcse_start_date2) ? date('Y-m-d', strtotime($batch_mcse_start_date2 . ' +6 weeks')) : null;

                    $course_schema_mcse = DB::table('courses')->where('status', 1)->where('id','11')->get(['batch_section_schema','video_section_schema','testimonials_section_schema'])->first();

                @endphp

                @if(!empty($mcse_batch))
                    <div class="batch_shedule_box">
                        <div class="row align-items-center">
                            <div class="col-md-9">

                                <ul>
                                    @foreach ($oc_mcse_pointer as $row)
                                        <li><i aria-hidden="true" class="far fa-check-circle"></i> @php echo html_entity_decode($row) @endphp</li>
                                    @endforeach
                                </ul>
                                
                                @if(!empty($batch_mcse_detail))
                                    <table class="batch_table table">
                                        <tbody>
                                            <tr class="pdd_14">
                                                <td width="20"><div>DATE</div></td>
                                                <td width="40"><div>SCHEDULE</div> </td>
                                                <td width="40"><div>TIME</div> </td>
                                            </tr>
                                            @foreach ($batch_mcse_detail as $row)
                                                <tr class="pdd_19">
                                                    <td><div>{{ formatDate($row['date']) }}</div></td>    
                                                    <td><div>@php echo html_entity_decode($row['schedule']) @endphp<span class="text_red">@php echo html_entity_decode($row['remark']) @endphp</span></div></td>
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

                                            <tr class="pdd_19">
                                                <td><div><b>24*7</b></div></td>
                                                <td><div>Self Paced Learning <span class="text_red">Live Recorded Lectures</span>
                                                </div></td>
                                                <td><div><b class="text_blue"><a href="https://lms.attariclasses.in/">Always
                                                            Available</a></b></div></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                @endif

                            </div>


                            <div class="col-md-3">
                                <div class="button_main getin_touch_bx">
                                    <h5>Get In Touch to Avail <span>{{ $mcse_batch->off_percentage }} OFF</span>
                                    </h5>

                                    <button type="button" onclick="formModal('{{ url(route('component.form')) }}?section=MCSE Training Schedule - Batch Page&title=Book a FREE Demo&current_page={{ urlencode(url()->current()) }}')" 
                                    class="btn bookfreedemo_button"> Book a Demo</button>

                                    <a class="view_coursebtn"
                                        href="{{ url('windows-server-hybrid-training-certification-online') }}"
                                        target="_blank">View Course Details <i aria-hidden="true"
                                            class="far fa-arrow-alt-circle-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

<!-----------------================== Batch mcse Schema =========================------------------------------>

    @php 
        echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]','[{start_date1}]','[{start_date2}]','[{end_date1}]','[{end_date2}]','[{start_time1}]','[{end_time1}]','[{start_time2}]','[{end_time2}]'],
        ["Windows Server Hybrid Training Schedule", "Best Training & Certification institute for Windows Server Hybrid in Mumbai & across India. Online & Classroom Training options", $meta_url, $batch_mcse_start_date, $batch_mcse_start_date2, $batch_mcse_end_date, $batch_mcse_end_date2, $batch_mcse_startTime1, $batch_mcse_endTime1, $batch_mcse_startTime2, $batch_mcse_endTime2], html_entity_decode($course_schema_mcse->batch_section_schema));
    @endphp

<!-----------------================== Batch mcse Schema =========================------------------------------>

                @endif

            </div>
        </div>
    </section>
    <!------------------========================== schedule ===============================-------------------->

    <!---------------------=========================== Testimonials ===============-------------------------->

    <section id="testimonials" class="testiminilas_sec gradiant_bg pt-5 pb-5 dot_clr_white position_relative">
        <div class="container">
            <h3 class="heading_title text-center pddtop_0 pb-3 textcolor_wht ">Windows Server Hybrid Training Testimonials</h3>
    
    <!-----------============= video testimonials ===============---------------------------------->

    @php
        $video_mcse_review = DB::table('video_reviews')->where('status', 1)->where('course_id','11')->get();
    @endphp
    
            @if(!empty($video_mcse_review))
                <div class="large-12 columns">
                    <div class="owl-carousel owl-theme video_testiminials">

                        @foreach ($video_mcse_review as $row)
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
                                        {{--<img data-src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                            class="img-fluid d-block w-100 lazyload" alt=""> --}}
                                        <img data-src="{{ asset('storage/' . $row->image) }}"
                                            class="img-fluid d-block w-100 lazyload" alt="">
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

    <!--------------------- video mcse Review schema -------------------------------------->

                @php 
                    echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],["Windows Server Hybrid Training Testimonials",$meta_description,$meta_url], html_entity_decode($course_schema_mcse->video_section_schema));
                @endphp

    <!--------------------- video mcse Review schema -------------------------------------->


            @endif



    <!-----------============= video testimonials ===============---------------------------------->
    @php
        $text_mcse_review = DB::table('text_reviews')->where('status', 1)->where('course_id','11')->whereIn('type', ['google', 'google_mcse'])->get();
        
    @endphp
    
        @if(!empty($text_mcse_review))
            <div class="large-12 columns mt-4">
                <div class="owl-carousel owl-theme slider_content_dots">

                    @foreach ($text_mcse_review as $row)
    
                        <div class="item">
                            <div class="testimonial_box">
                                <div class="testimonial__header">
                                    <div class="row">
                                        <div class="col-lg-6 col-10">
                                            <div class="testimonial__image">
                                                <img data-src="{{ asset('storage/' . $row->thumbnail) }}"
                                                    class="img-fluid d-block w-100 lazyload" alt="">
                                                <span class="testimonial__name">{{ $row->name }}</span>
                                            </div>
                                            <span>{{ $row->profile }}</span>
                                        </div>
                                        <div class="col-lg-6 col-2">
                                            <div class="testimonial__icon">
                                                @if($row->type == 'google')
                                                    <a href="{{ $row->url }}"><i aria-hidden="true" class="fab fa-google-plus"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial__content">
                                    <div class="testimonial__text">
                                         @php echo html_entity_decode($row->description) @endphp
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

    <!--------------------- Text mcse Review -------------------------------------->

        @php 
            echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],["Windows Server Hybrid Training Testimonials",$meta_description,$meta_url], html_entity_decode($course_schema_mcse->testimonials_section_schema));
        @endphp

    <!--------------------- Text mcse Review -------------------------------------->


        @endif
      
        </div>
    </section>
    </div>

    <!---------------------=========================== Testimonials ===============-------------------------->

<!-----------------=============================== MCSE ======================================------------------------>



<!-------================================== CCNA =============================----------------------------------->

    <!------------------========================== schedule ===============================-------------------->
    <div id="ccna-batch-traning">
    <section id="ccna_batch" class="page-section prje_cove_section light_gray_bg pt-5 pb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <h4 class="section_heading pb-3 text-center"> <b>CCNA Training Schedule</b></h4>
                </div>

                @php    
                    
                    $ccna_batch = DB::table('batches')->where('status', 1)->where('course_id','10')->get(['oc_pointer_list', 'batch_detail', 'off_percentage', 'status','course_id'])->first();
                    $oc_ccna_pointer = json_decode($ccna_batch->oc_pointer_list);
                    $batch_ccna_detail = json_decode($ccna_batch->batch_detail, true);

                    $batch_ccna_dates = array_column($batch_ccna_detail, 'date');


                    $batch_start_times = array_column($batch_ccna_detail, 'start_time');
                    $batch_end_times = array_column($batch_ccna_detail, 'end_time');

                    // Set start times
                    $batch_ccna_startTime1 = isset($batch_start_times[0]) ? $batch_start_times[0] : null; 
                    $batch_ccna_startTime2 = isset($batch_start_times[1]) ? $batch_start_times[1] : null; 
                    
                    // Set end times
                    $batch_ccna_endTime1 = isset($batch_end_times[0]) ? $batch_end_times[0] : null;
                    $batch_ccna_endTime2 = isset($batch_end_times[1]) ? $batch_end_times[1] : null;

                    // Get the start and end dates
                    $batch_ccna_start_date = isset($batch_ccna_dates[0]) ? date("Y-m-d", strtotime($batch_ccna_dates[0])) : null;
                    $batch_ccna_start_date2 = isset($batch_ccna_dates[1]) ? date("Y-m-d", strtotime($batch_ccna_dates[1])) : null;

                    $batch_ccna_start_date = !empty($batch_ccna_start_date) ? date("Y-m-d", strtotime($batch_ccna_start_date)) : null; 
                    $batch_ccna_start_date2 = !empty($batch_ccna_start_date2) ? date("Y-m-d", strtotime($batch_ccna_start_date2)) : null;
                
                    $batch_ccna_end_date = !empty($batch_ccna_start_date) ? date('Y-m-d', strtotime($batch_ccna_start_date . ' +6 weeks')) : null;
                    $batch_ccna_end_date2 = !empty($batch_ccna_start_date2) ? date('Y-m-d', strtotime($batch_ccna_start_date2 . ' +6 weeks')) : null;

                    $course_schema_ccna = DB::table('courses')->where('status', 1)->where('id','10')->get(['batch_section_schema','video_section_schema','testimonials_section_schema'])->first();

                @endphp

                @if(!empty($ccna_batch))
                    <div class="batch_shedule_box">
                        <div class="row align-items-center">
                            <div class="col-md-9">

                                <ul>
                                    @foreach ($oc_ccna_pointer as $row)
                                        <li><i aria-hidden="true" class="far fa-check-circle"></i> @php echo html_entity_decode($row) @endphp</li>
                                    @endforeach
                                </ul>
                                
                                @if(!empty($batch_ccna_detail))
                                    <table class="batch_table table">
                                        <tbody>
                                            <tr class="pdd_14">
                                                <td width="20"><div>DATE</div></td>
                                                <td width="40"><div>SCHEDULE</div> </td>
                                                <td width="40"><div>TIME </div></td>
                                            </tr>
                                            @foreach ($batch_ccna_detail as $row)
                                                <tr class="pdd_19">
                                                    <td><div>{{ formatDate($row['date']) }}</div></td>
                                                    <td><div>@php echo html_entity_decode($row['schedule']) @endphp<span class="text_red">@php echo html_entity_decode($row['remark']) @endphp</span></div></td>
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

                                            <tr class="pdd_19">
                                                <td><div><b>24*7</b></div></td>
                                                <td><div>Self Paced Learning <span class="text_red">Live Recorded Lectures</span>
                                                </div></td>
                                                <td><div><b class="text_blue"><a href="https://lms.attariclasses.in/">Always
                                                            Available</a></b></div></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                @endif

                            </div>


                            <div class="col-md-3">
                                <div class="button_main getin_touch_bx">
                                    <h5>Get In Touch to Avail <span>{{ $ccna_batch->off_percentage }} OFF</span>
                                    </h5>

                                    <button type="button" onclick="formModal('{{ url(route('component.form')) }}?section=CCNA Training Schedule - Batch Page&title=Book a FREE Demo&current_page={{ urlencode(url()->current()) }}')" 
                                    class="btn bookfreedemo_button"> Book a Demo</button>

                                    <a class="view_coursebtn"
                                        href="{{ url('ccna-training-certification-online') }}"
                                        target="_blank">View Course Details <i aria-hidden="true"
                                            class="far fa-arrow-alt-circle-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

<!-----------------================== Batch ccna Schema =========================------------------------------>

    @php 
        echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]','[{start_date1}]','[{start_date2}]','[{end_date1}]','[{end_date2}]','[{start_time1}]','[{end_time1}]','[{start_time2}]','[{end_time2}]'],
        ["CCNA Training Schedule", "Best Training & Certification institute for CCNA in Mumbai & across India. Online & Classroom Training options", $meta_url, $batch_ccna_start_date, $batch_ccna_start_date2, $batch_ccna_end_date, $batch_ccna_end_date2, $batch_ccna_startTime1, $batch_ccna_endTime1, $batch_ccna_startTime2, $batch_ccna_endTime2], 
        html_entity_decode($course_schema_ccna->batch_section_schema));
    @endphp

<!-----------------================== Batch ccna Schema =========================------------------------------>

                @endif

            </div>
        </div>
    </section>
    <!------------------========================== schedule ===============================-------------------->

    <!---------------------=========================== Testimonials ===============-------------------------->

    <section id="testimonials" class="testiminilas_sec gradiant_bg pt-5 pb-5 dot_clr_white">
        <div class="container">
            <h3 class="heading_title text-center pddtop_0 pb-3 textcolor_wht ">CCNA Training Testimonials</h3>
    
    <!-----------============= video testimonials ===============---------------------------------->

    @php
        $video_ccna_review = DB::table('video_reviews')->where('status', 1)->where('course_id','10')->get();
    @endphp
    
            @if(!empty($video_ccna_review))
                <div class="large-12 columns">
                    <div class="owl-carousel owl-theme video_testiminials">

                        @foreach ($video_ccna_review as $row)
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
                                        {{--<img data-src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                            class="img-fluid d-block w-100 lazyload" alt=""> --}}
                                        <img data-src="{{ asset('storage/' . $row->image) }}"
                                            class="img-fluid d-block w-100 lazyload" alt="">
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

    <!--------------------- video ccna Review schema -------------------------------------->

                @php 
                    echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],["CCNA Cloud Training Testimonials",$meta_description,$meta_url], html_entity_decode($course_schema_ccna->video_section_schema));
                @endphp

    <!--------------------- video ccna Review schema -------------------------------------->


            @endif



    <!-----------============= video testimonials ===============---------------------------------->
    @php
        $text_ccna_review = DB::table('text_reviews')->where('status', 1)->where('course_id','10')->whereIn('type', ['google', 'google_mcse'])->get();
    @endphp
    
        @if(!empty($text_ccna_review))
            <div class="large-12 columns mt-4">
                <div class="owl-carousel owl-theme slider_content_dots">

                    @foreach ($text_ccna_review as $row)
    
                        <div class="item">
                            <div class="testimonial_box">
                                <div class="testimonial__header">
                                    <div class="row">
                                        <div class="col-lg-6 col-10">
                                            <div class="testimonial__image">
                                                <img data-src="{{ asset('storage/' . $row->thumbnail) }}"
                                                    class="img-fluid d-block w-100 lazyload" alt="">
                                                <span class="testimonial__name">{{ $row->name }}</span>
                                            </div>
                                            <span>{{ $row->profile }}</span>
                                        </div>
                                        <div class="col-lg-6 col-2">
                                            <div class="testimonial__icon">
                                                @if($row->type == 'google')
                                                    <a href="{{ $row->url }}"><i aria-hidden="true" class="fab fa-google-plus"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial__content">
                                    <div class="testimonial__text">
                                         @php echo html_entity_decode($row->description) @endphp
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

    <!--------------------- Text ccna Review -------------------------------------->

    @php 
        echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],["CCNA Cloud Training Testimonials",$meta_description,$meta_url], html_entity_decode($course_schema_ccna->testimonials_section_schema));
    @endphp

<!--------------------- Text ccna Review -------------------------------------->


        @endif
      
        </div>
    </section>
</div>
    <!---------------------=========================== Testimonials ===============-------------------------->

<!-----------------=============================== CCNA ======================================------------------------>


<!-------------=============== batch end =============== -------------------->
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
    window.scrollTo(0, 0);
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
          //handleActiveLinkUpdate(index);

          const targetId = this.getAttribute('data-href').substring(1);
          const targetElement = document.getElementById(targetId);
          const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - sectionOffset;

          window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
          });
        }));

        window.addEventListener("scroll", () => {
          const currentIndex = sectionsContainer.getBoundingClientRect().top < 0
            ? (sections.length - 1) - [...sections].reverse().findIndex(section => window.scrollY >= section.offsetTop - sectionOffset * 2) 
            : 0;

          if (userScroll && activeIndex !== currentIndex) {
            handleActiveLinkUpdate(currentIndex);
            //handleActiveLinkUpdate(currentIndex);
          } else {
            window.clearTimeout(isScrolling);
            isScrolling = setTimeout(() => userScroll = true, 100);
          }
        });

        init();
      }
    });
  </script>
  

@endsection
