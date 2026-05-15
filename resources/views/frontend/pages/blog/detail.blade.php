@extends('frontend.layouts.app')

@php
$url = request()->segment('1');
$page = DB::table('blog_categories')
->where('slug', $url)
->first();
//$count = count($author);
$i = 1;
@endphp

@section('page.title', "$detail->meta_title")

@section('page.description', "$detail->meta_description")

@section('page.type', "$page->name")

@section('page.publish_time', $detail->created_at->format('Y-m-d\TH:i:sP'))
@section('page.modified_time', $detail->updated_at->format('Y-m-d\TH:i:sP'))


@php
    $meta_title = $detail->meta_title;
    $meta_description = $detail->meta_description;
    $meta_url = url()->current();
    
    $contact_slug = DB::table('cms')->where('course_id', $detail->course_id)->where('zone', 0)->pluck('slug')->first();
@endphp

@section('page.schema')
<!--------------------------- Page Schema --------------------------------->

<style>
    .bookdemofreeform_course.blue_gradianbg.blogdt_from p.text-center.color_white {
    color: #fff;
    font-size: 20px !important;
}
    .succes_page_form p.text-center.color_white {
    color: #fff;
    font-size: 20px !important;
}
</style>
<script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "BreadcrumbList",
    "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "{{ url(route('index')) }}"
    }, {
        "@type": "ListItem",
        "position": 2,
        "name": "{{ $page->name }}",
        "item": "{{ url(route(''.$url.'')) }}"
    }, {
        "@type": "ListItem",
        "position": 3,
        "name": "@php echo str_replace('&nbsp;',' ',htmlspecialchars_decode ($detail->title)); @endphp",
        "item": "{{ url()->current() }}"
    }]
}
</script>

<!--------------------------- Page Schema end--------------------------------->
@endsection

@section('page.content')

<!-------================ blog detail start ============ ------------>


<section class="blog_banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrums_section pt-4 pb-1">
                    <nav aria-label="breadcrumb">
                        <ul class="d-flex align-items-center breadcrumb gap-md-2 gap-1 list-unstyled" data-aos="fade-up"
                            data-aos-once="true">
                            <li>
                                <a href="{{ url(route('index')) }}" class="text-decoration-none" data-aos="fade-up"
                                    data-aos-once="true">Home</a>
                            </li>
                            <li>></li>
                            @if($url == 'blog' || $url == 'news' || $url == 'deal-update')
                            <li>
                                <a href="{{ url(route(''. $url.'')) }}" class="text-decoration-none" data-aos="fade-up"
                                    data-aos-once="true">
                                    {{ ucfirst($page->name) }}
                                </a>
                            </li>
                            <li>></li>
                            @endif
                            <li>{{ $detail->title }}</li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="col-md-9">
                <div class="blog_dt_top">
                    <h1 class="pb-2 pt-2 font_size_28">
                        {{ $detail->title }}
                    </h1>


                    <b><span>Last Update: {{ date("F j, Y", strtotime($detail->updated_at)) }}</span><span
                            class="ms-3"><i class="fa-regular fa-eye"></i> Post Views: {{ $detail->views }}</b>
                    <p class="pt-2">{{ $detail->short_description }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="cirtified_button">
                    <a href="javascript:void(0)" onclick="formModal('{{ url(route('component.form')) }}?section=Blog Detail Page - Become a Certified Professional&title=Book a FREE Demo&current_page={{ urlencode(url()->current()) }}')">Become a Certified Professional</a>
                </div>
            </div>

        </div>
    </div>
</section>
<!-----------------------------Recent Posts------------------------ -->
<section class="recent_post py-5 bggray1 mainblog_dtt">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-12">
                <div class="">
                <!-- <div class="mb-4"> -->
                    <div class="post_box pb-1">

                        <style>
                        .content {
                            width: 100%;
                            /* Adjust the width as needed */
                            overflow-wrap: break-word;
                            /* This property ensures that long words break and wrap to the next line */
                        }
                        </style>


                        <div class="text_box_post pb-4 ps-4 pe-4 pt-4 blogdtt_content">
                            <!-- <h6 class="mb-0"> -->
                                {{-- $detail->title --}}
                            <!-- </h6> -->
                            <p class="content">
                                @php echo html_entity_decode($detail->content) @endphp
                            </p>
                        </div>
                        
<!------------------========================== for text review ===============================-------------------->
            @php
                $batch = DB::table('batches')->where('status',
                1)->where('course_id', $detail->course_id)->get(['oc_pointer_list', 'batch_detail',
                'off_percentage', 'status','course_id'])->first();

                $oc_vm_pointer = json_decode($batch->oc_pointer_list);

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

                $course_schema_vm = DB::table('courses')->where('status', 1)->where('id', $detail->course_id)->get(['batch_section_schema','video_section_schema','testimonials_section_schema'])->first();

            @endphp
<!------------------========================== for text review ===============================-------------------->

            <!------------------========================== schedule ===============================-------------------->
            @if($detail->batch_schedule === 1)
                <section id="vmware_batch" class="page-section1 prje_cove_section light_gray_bg pt-5 pb-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                            <h2 class="section_heading pb-3 text-center"> <b>{{ ucfirst($course->alias) }} Training Schedule</b></h2>
                            </div>

                            @if(!empty($batch))
                            <div class="batch_shedule_box">
                                <div class="row align-items-center">
                                    <div class="col-md-9">

                                        <ul>
                                            @foreach ($oc_vm_pointer as $row)
                                            <li><i aria-hidden="true" class="far fa-check-circle"></i> @php echo
                                                html_entity_decode($row) @endphp</li>
                                            @endforeach
                                        </ul>

                                        @if(!empty($batch_detail))
                                        <table class="batch_table table">
                                            <tbody>
                                                <tr class="pdd_14">
                                                    <td width="20">
                                                        <div>DATE</div>
                                                    </td>
                                                    <td width="40">
                                                        <div>SCHEDULE </div>
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
                                                        <div>@php echo html_entity_decode($row['schedule'])
                                                            @endphp<span class="text_red">@php echo
                                                                html_entity_decode($row['remark'])
                                                                @endphp</span></div>
                                                    </td>
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
                                                    <td>
                                                        <div><b>24*7</b></div>
                                                    </td>
                                                    <td>
                                                        <div>Self Paced Learning <span class="text_red">Live
                                                                Recorded Lectures</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><b class="text_blue"><a
                                                                    href="https://lms.attariclasses.in/">Always
                                                                    Available</a></b></div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                        @endif

                                    </div>


                                    <div class="col-md-3">
                                        <div class="button_main getin_touch_bx">
                                            <p class="gettouch">Get In Touch to Avail <span>{{ $batch->off_percentage }}
                                                    OFF</span>
                                            </p>

                                            <button type="button" onclick="formModal('{{ url(route('component.form')) }}?section=Batch Section - Blog Detail Page&title=Book a FREE Demo&current_page={{ urlencode(url()->current()) }}')"
                                             class="btn bookfreedemo_button"> Book a Demo</button>

                                            <a class="view_coursebtn"
                                                href="{{ url($contact_slug) }}"
                                                target="_blank">View Course Details <i aria-hidden="true"
                                                    class="far fa-arrow-alt-circle-right"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>

            <!-----------------================== Batch vm Schema =========================------------------------------>

                            @php
                            echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]','[{start_date1}]','[{start_date2}]','[{end_date1}]','[{end_date2}]','[{start_time1}]','[{start_time2}]','[{end_time1}]','[{end_time2}]'], [$detail->meta_title, $detail->meta_description,$meta_url, $batch_start_date, $batch_start_date2, $batch_end_date, $batch_end_date2, $batch_startTime1, $batch_startTime2, $batch_endTime1,  $batch_endTime2], html_entity_decode($course_schema_vm->batch_section_schema));
                            @endphp

            <!-----------------================== Batch vm Schema =========================------------------------------>


                            @endif

                        </div>
                    </div>
                </section>                                              
            @endif
            <!------------------========================== schedule ===============================-------------------->

                        <!---------------------=========================== Testimonials ===============-------------------------->

                        @if($detail->video_testimonial === 1 || $detail->text_testimonial === 1)
                            <section id="testimonials" class="testiminilas_sec gradiant_bg pt-5 pb-5 dot_clr_white">

                                <div class="container">
                                    <h2 class="heading_title text-center pddtop_0 pb-3 textcolor_wht ">{{ ucfirst($course->alias) }} Training Testimonials</h2>

                                    @if($detail->video_testimonial === 1)
                                        <!-----------============= video testimonials ===============---------------------------------->

                                        @php
                                        $video_vm_review = DB::table('video_reviews')->where('status',
                                        1)->where('course_id', $detail->course_id)->get();
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

                                        <!--------------------- video Review schema -------------------------------------->

                                        @php
                                            echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],[$detail->meta_title,$detail->meta_description,$meta_url], html_entity_decode($course_schema_vm->video_section_schema));
                                        @endphp

                                        <!--------------------- video Review schema -------------------------------------->


                                        @endif
                                    <!-----------============= video testimonials ===============---------------------------------->

                                    @endif


                                    @if($detail->text_testimonial === 1)
                                        <!-----------============= Text testimonials ===============---------------------------------->

                                        @php
                                        $text_vm_review = DB::table('text_reviews')->where('status',
                                        1)->where('course_id', $detail->course_id)->whereIn('type', ['google', 'google_mcse'])->get();
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

                                            <!--------------------- Text vm Review -------------------------------------->

                                            @php
                                                echo str_replace(['[{meta_title}]','[{meta_desc}]','[{current_url}]'],[$detail->meta_title,$detail->meta_description,$meta_url],html_entity_decode($course_schema_vm->testimonials_section_schema));
                                            @endphp

                                            <!--------------------- Text vm Review -------------------------------------->



                                        @endif
                                        <!-----------============= Text testimonials ===============---------------------------------->
                                    @endif

                                </div>
                            </section>
                        @endif




                    </div>
                </div>
                <div class="bookdemofreeform_course blue_gradianbg blogdt_from">
                    <div class="container">
                        @include('frontend.component.common_form', [
                            'section' => 'Book a Free Demo - Blog Detail Page',
                            'title'  => 'Book a <b>FREE</b> Demo',
                            'Headingclassname'  => 'color_white',
                        ])
                    </div>
                </div>
            </div>


            <div class="col-md-3 col-12 d-none d-md-block">
                <div class="succes_page_form d-block sticky-top blue_gradianbg blog_rights">
                @include('frontend.component.common_form', [
                    'section' => 'Book a Free Demo - Blog Detail Page',
                    'title'  => 'Book a <b>FREE</b> Demo',
                    'Headingclassname'  => 'color_white',
                ])
                </div>

            </div>
        </div>
    </div>
</section>

@if(count($blog) > 0)


<section class="related_courses1 pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section_heading pb-3 text-left"> Related Articles</h2>
            </div>

            @foreach ($blog as $row)
            <div class="col-md-3">
                <div class="related_boxex1">
                    <div class="related_img">
                        <img src="{{ asset('storage/' . $row->main_image) }}" alt="" class="blog_img" />
                    </div>
                    <div class="related_content">
                      
                            <a target="_blank" href="{{ url(route('blog.detail', ['category' => $url, 'slug' => strtolower(str_replace(' ', '-',$row->slug))] )) }}">{{ $row->title }}</a>
                        
                    </div>

                    <div class="related_updated">
                        <p>Last Updated: {{ date('F j, Y', strtotime($detail->updated_at)) }} </p>
                    </div>
                </div>
            </div>


            @endforeach


        </div>
    </div>
    </div>
</section>
@endif


@php
    $learning = DB::table('cms')
    ->join('courses', 'cms.course_id', '=', 'courses.id')
    ->where('cms.status', 1)
    ->where('cms.zone', 0)
    ->get([
        'cms.course_id',
        'cms.slug',
        'courses.thumbnail'
    ]);
@endphp

<section class="bggray1 other_courses pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section_heading pb-3 text-left"> Courses we offer </h2>
                <div class="owl-carousel owl-theme trending_course">

                    @php $filtered1 = $learning->where('course_id', 5)->first(); @endphp
                    @if($filtered1)
                        <div class="item">
                            <div class="other_crs_box">
                                <a href="{{ url(route('course.detail', ['slug' => $filtered1->slug] )) }}"><img src="{{ asset('storage/' . $filtered1->thumbnail) }}" /></a>
                            </div>
                        </div>
                    @endif

                    @php $filtered2 = $learning->where('course_id', 7)->first(); @endphp
                    @if($filtered2)
                        <div class="item">
                            <div class="other_crs_box">
                                <a href="{{ url(route('course.detail', ['slug' => $filtered2->slug] )) }}"><img src="{{ asset('storage/' . $filtered2->thumbnail) }}" /></a>
                            </div>
                        </div>
                    @endif

                    @php $filtered3 = $learning->where('course_id', 8)->first(); @endphp
                    @if($filtered3)
                        <div class="item">
                            <div class="other_crs_box">
                                <a href="{{ url(route('course.detail', ['slug' => $filtered3->slug] )) }}"><img src="{{ asset('storage/' . $filtered3->thumbnail) }}" /></a>
                            </div>
                        </div>
                    @endif    

                    @php $filtered4 = $learning->where('course_id', 11)->first(); @endphp
                    @if($filtered4)
                        <div class="item">
                            <div class="other_crs_box">
                                <a href="{{ url(route('course.detail', ['slug' => $filtered4->slug] )) }}"><img src="{{ asset('storage/' . $filtered4->thumbnail) }}" /></a>
                            </div>
                        </div>
                    @endif
                    
                    @php $filtered5 = $learning->where('course_id', 10)->first(); @endphp
                    @if($filtered5)
                        <div class="item">
                            <div class="other_crs_box">
                                <a href="{{ url(route('course.detail', ['slug' => $filtered5->slug] )) }}"><img src="{{ asset('storage/' . $filtered5->thumbnail) }}" /></a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!----------========= blog detail end ========== ------------------->

@endsection