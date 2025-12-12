@extends('frontend.layouts.app')

@php
    if ($learning->page == 'practice') {
        $title = $alias . ' Exam Dumps | ' . $alias . ' Practice Test Questions and Answers';
    } else {
        $title = $alias . ' Books | Best ' . $alias . ' Certification Study Material';
    }

    $meta_title = ucfirst($title);
    $meta_description =
        'Attari Classes provides Hands-on Practical Training, Book FREE DEMO, Topic wise Recorded Lectures on LMS, Online & Classroom Training options';
    $meta_url = url()->current();
@endphp



@section('page.title', $meta_title)

@section('page.description', $meta_description)

@section('page.type', 'website')

@section('page.content')


    <!----------========== Vmware Book guides start ===============-------------------->

    <section class="sm-at banner1 bookguide_banner">
        @if ($learning->page == 'practice')
            <img class="inner-banner-image" src="/assets/frontend/images/test.jpg" />
        @else
            <img class="inner-banner-image" src="/assets/frontend/images/Book.jpg" />
        @endif

        <div class="container mt235">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrums_section paddtb80">
                        <h1 class="sm-aboutus color-white1">{{ ucwords(str_replace('-', ' ', $learning->slug)) }}</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item"><a>»</a></li>
                                <li class="breadcrumb-item"><a href="learning"><b>Learning</b></a></li>
                                <li class="breadcrumb-item"><a>»</a></li>
                                <li class="breadcrumb-item">
                                    <a><b>{{ ucwords(str_replace('-', ' ', $learning->slug)) }}</b></a></li>
                            </ol>
                        </nav>
                    </div>
                </div>


            </div>
        </div>
    </section>




    <section class="practice_test_section pt-5 pb-5">
        <div class="container">
            <div class="practice_test_box">
                <div class="row align-items-center">
                    @if ($learning->page == 'practice')
                        @if(!empty($learning->statement) || !empty($learning->youtube_url))
                            @if(!empty($learning->statement))
                                <div class="col-md-6">
                                    <h4 class="watch_video_hed">@php echo html_entity_decode($learning->statement) @endphp <span><i class="fa fa-arrow-right"
                                                aria-hidden="true"></i></span></h4>

                                </div>
                            @endif

                            @if(!empty($learning->youtube_url))
                                <div class="col-md-6">
                                    <div class="prcatice_button">
                                        <a id="play-video" class="video-play-button video-btn" type="button" class="btn"
                                            data-bs-toggle="modal" data-bs-target="#learning_pratice_video"> <span></span> </a>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="border_middle"></div>
                            </div>
                        @endif

                    @endif
                    <div class="col-md-12">
                        <h5 class="download_head pb-lg-4 pb-0">{{ $learning->heading_pdf_title }}</h5>
                    </div>

                    <div class="col-md-12">
                        @php $pdf = json_decode($learning->pdf);  @endphp

                        @foreach ($pdf as $row)
                            <div class="pdf_boxex_practice">
                                <a href="{{ asset('storage/' . $row->pdf) }}"><img src="/assets/frontend/images/pdf.webp">
                                    <span> {{ $row->title }} <span></a>
                                <div class="download_button">
                                    <a href="{{ asset('storage/' . $row->pdf) }}" download="{{ $row->title }}">Download
                                        PDF <i aria-hidden="true" class="fas fa-download"></i></a>
                                </div>
                            </div>
                        @endforeach


                        <div class="moreinfo_button"><i class="fa fa-arrow-right" aria-hidden="true"></i> More Info</div>
                        <div class="moreinfo_box" style="display:none;">
                            <p>{{ $learning->more_info }}</p>
                        </div>


                    </div>


                </div>
            </div>
        </div>


        </div>
    </section>


    <section id="vmware_batch" class="prje_cove_section light_gray_bg pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="section_heading pb-3 text-center"> <b>{{ $learning->schedule_title }}</b></h4>
                </div>



                @php

                    $batch = DB::table('batches')
                        ->where('status', 1)
                        ->where('course_id', $learning->course_id)
                        ->get(['oc_pointer_list', 'batch_detail', 'off_percentage', 'status', 'course_id'])
                        ->first();
                    $oc_ccna_pointer = json_decode($batch->oc_pointer_list);
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
                    $batch_start_date = isset($batch_dates[0]) ? date('Y-m-d', strtotime($batch_dates[0])) : null; // Get the first date
                    $batch_start_date2 = isset($batch_dates[1]) ? date('Y-m-d', strtotime($batch_dates[1])) : null; // Get the last date

                    $batch_start_date = !empty($batch_start_date) ? date('Y-m-d', strtotime($batch_start_date)) : null;
                    $batch_start_date2 = !empty($batch_start_date2)
                        ? date('Y-m-d', strtotime($batch_start_date2))
                        : null;

                    $batch_end_date = !empty($batch_start_date)
                        ? date('Y-m-d', strtotime($batch_start_date . ' +6 weeks'))
                        : null;
                    $batch_end_date2 = !empty($batch_start_date2)
                        ? date('Y-m-d', strtotime($batch_start_date2 . ' +6 weeks'))
                        : null;

                    $course_schema = DB::table('courses')
                        ->where('status', 1)
                        ->where('id', $learning->course_id)
                        ->get(['batch_section_schema', 'video_section_schema', 'testimonials_section_schema'])
                        ->first();

                @endphp

                @if (!empty($batch))
                    <div class="batch_shedule_box">
                        <div class="row align-items-center">
                            <div class="col-md-9">

                                <ul>
                                    @foreach ($oc_ccna_pointer as $row)
                                        <li><i aria-hidden="true" class="far fa-check-circle"></i> @php echo html_entity_decode($row) @endphp</li>
                                    @endforeach
                                </ul>

                                @if (!empty($batch_detail))
                                    <table class="batch_table table">
                                        <tbody>
                                            <tr class="pdd_14">
                                                <td width="20">
                                                    <div>DATE</div>
                                                </td>
                                                <td width="40">
                                                    <div>SCHEDULE</div>
                                                </td>
                                                <td width="40">
                                                    <div>TIME </div>
                                                </td>
                                            </tr>
                                            @foreach ($batch_detail as $row)
                                                <tr class="pdd_19">
                                                    <td>
                                                        <div>{{ formatDate($row['date']) }}</div>
                                                    </td>
                                                    <td>
                                                        <div>@php echo html_entity_decode($row['schedule']) @endphp<span
                                                                class="text_red">@php echo html_entity_decode($row['remark']) @endphp</span></div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            @php
                                                                if (
                                                                    isset($row['start_time']) &&
                                                                    isset($row['end_time'])
                                                                ) {
                                                                    echo date('g:i A', strtotime($row['start_time'])) .
                                                                        ' to ' .
                                                                        date('g:i A', strtotime($row['end_time'])) .
                                                                        ' (IST) ';
                                                                }
                                                            @endphp
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr class="pdd_19">
                                                <td>
                                                    <div><b>24*7</b></div>
                                                </td>
                                                <td>
                                                    <div>Self Paced Learning <span class="text_red">Live Recorded
                                                            Lectures</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div><b class="text_blue"><a href="https://lms.attariclasses.in/">Always
                                                                Available</a></b></div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                @endif

                            </div>


                            <div class="col-md-3">
                                <div class="button_main getin_touch_bx">
                                    <h5>Get In Touch to Avail <span>{{ $batch->off_percentage }} OFF</span>
                                    </h5>

                                    <button type="button"
                                        onclick="formModal('{{ url(route('component.form')) }}?section={{ ucwords(str_replace('-', ' ', $learning->slug)) . ' - ' . ucwords($learning->page) . ' Page' }}&title=Book a FREE Demo&current_page={{ urlencode(url()->current()) }}')"
                                        class="btn bookfreedemo_button">Book a FREE Demo</button>

                                    @php
                                        $course = DB::table('cms')
                                            ->where('status', 1)
                                            ->where('zone', 0)
                                            ->where('course_id', $learning->course_id)
                                            ->first(['slug']);
                                    @endphp

                                    <a class="view_coursebtn"
                                        href="{{ url(route('course.detail', ['slug' => $course->slug])) }}"
                                        target="_blank">View Course Details <i aria-hidden="true"
                                            class="far fa-arrow-alt-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-----------------================== Batch Schema =========================------------------------------>

                    @php
                        echo str_replace(
                            [
                                '[{meta_title}]',
                                '[{meta_desc}]',
                                '[{current_url}]',
                                '[{start_date1}]',
                                '[{start_date2}]',
                                '[{end_date1}]',
                                '[{end_date2}]',
                                '[{start_time1}]',
                                '[{start_time2}]',
                                '[{end_time1}]',
                                '[{end_time2}]',
                            ],
                            [
                                $meta_title,
                                $meta_description,
                                $meta_url,
                                $batch_start_date,
                                $batch_start_date2,
                                $batch_end_date,
                                $batch_end_date2,
                                $batch_startTime1,
                                $batch_startTime2,
                                $batch_endTime1,
                                $batch_endTime2,
                            ],
                            html_entity_decode($course_schema->batch_section_schema),
                        );
                    @endphp

                    <!-----------------================== Batch Schema =========================------------------------------>


                @endif


            </div>
        </div>
    </section>



    <section id="testimonials" class="testiminilas_sec gradiant_bg pt-5 pb-5">
        <div class="container">
            <h3 class="heading_title text-center pddtop_0 pb-3 textcolor_wht ">{{ $learning->testimonials_title }}</h3>

            @php
                $video_review = DB::table('video_reviews')
                    ->where('status', 1)
                    ->where('course_id', $learning->course_id)
                    ->get();
            @endphp

            @if (count($video_review) > 0)
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
                                        {{-- <img data-src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                            class="img-fluid d-block w-100 lazyload" alt=""> --}}
                                        <img data-src="{{ asset('storage/' . $row->image) }}"
                                            class="img-fluid d-block w-100 lazyload" alt="">
                                    </a>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>

                <!--------------------- video Review schema -------------------------------------->

                @php
                    echo str_replace(
                        ['[{meta_title}]', '[{meta_desc}]', '[{current_url}]'],
                        [$meta_title, $meta_description, $meta_url],
                        html_entity_decode($course_schema->video_section_schema),
                    );
                @endphp

                <!--------------------- video Review schema -------------------------------------->

            @endif





            @php
                $text_review = DB::table('text_reviews')
                    ->where('status', 1)
                    ->where('course_id', $learning->course_id)
                    ->whereIn('type', ['google', 'google_mcse'])
                    ->get();
            @endphp

            @if (!empty($text_review))
                <div class="large-12 columns mt-4">
                    <div class="owl-carousel owl-theme slider_content_dots">

                        @foreach ($text_review as $row)
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
                                                    @if ($row->type == 'google')
                                                        <a href="{{ $row->url }}"><i aria-hidden="true"
                                                                class="fab fa-google-plus"></i></a>
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

                <!--------------------- Text Review -------------------------------------->

                @php
                    echo str_replace(
                        ['[{meta_title}]', '[{meta_desc}]', '[{current_url}]'],
                        [$meta_title, $meta_description, $meta_url],
                        html_entity_decode($course_schema->testimonials_section_schema),
                    );
                @endphp

                <!--------------------- Text Review -------------------------------------->


            @endif

        </div>
    </section>



    <section id="faqs" class="overview py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="section_heading pb-3 text-center textcolor_blck"> {{ $learning->faq_title }} </h4>

                    @if (!empty($learning->faq))
                        <div class="accordion--container1 accordion_style1">

                            @php
                                $course_faq = json_decode($learning->faq);
                                $i = 1;
                            @endphp

                            @foreach ($course_faq as $faq1)
                                @foreach ($faq1 as $title => $description)
                                    <li class="accordion1">
                                        <span> @php echo $title @endphp <i class="fa fa-angle-up"></i>
                                        </span>
                                        <div class="contentsillabus_div">
                                            <div class="txt">
                                                @php echo html_entity_decode($description) @endphp
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endforeach

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="learning_pratice_video" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe width="560" height="315" id="video" src="{{ $learning->youtube_url }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>

            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // when the modal is opened autoplay it  
            $('#learning_pratice_video').on('shown.bs.modal', function(e) {
                console.log("ddd");
                // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
                $("#video").attr('src', "{{ $learning->youtube_url }}");
            })



            // stop playing the youtube video when I close the modal
            $('#learning_pratice_video').on('hide.bs.modal', function(e) {
                console.log("ddd");
                // a poor man's stop video
                $("#video").attr('src', '');
            })
        });
    </script>
    <!-------------=============== Vmware Book guides end =============== -------------------->

@endsection
