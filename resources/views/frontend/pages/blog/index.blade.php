@extends('frontend.layouts.app')

@section('page.title', 'VMware, AWS, AZURE, MCSE / MCSA, and CCNA -Attari Classes Blog')

@section('page.description',
    'Attari Classes blog is the right place to get latest content related to VMware, AWS Cloud , Azure Cloud, MCSE, and CCNA.')

@section('page.type', 'blogs')

@section('page.content')


<style>
    .post_box .text_box_post p {
     margin-bottom: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    padding-bottom: 4px;
    padding-top: 0px !important;
    padding-right: 0px;
    font-size:13px !important;
}

.text_box_post {
    height: 128px;
}
</style>
    <!----------------=============== blog start ================------------->
    <section class="blog_banner pb-md-5 pb-3">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="breadcrums_section pt-4 pb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url(route('index')) }}">Home</a></li>
                                <li class="breadcrumb-item"><a>»</a></li>
                                <li class="breadcrumb-item"><a><b>Blog</b></a></li>
                            </ol>
                        </nav>
                    </div>
                </div>


                <div class="col-12">
                    <div class="banner_boxs">
                        <h4 class="py-2">What you want to learn</h4>
                        <div class="row">
                            <div class="col-md-2">
                                <a href="{{ route('blog-course-view', ['course' => 'VMware']) }}">
                                    <div class="boxtop_box">
                                            <i aria-hidden="true" class="fas fa-laptop"></i>
                                            <p>VMware vSphere</p>
                                        
                                    </div>
                                </a>
                            </div>
                            
                            
                            <div class="col-md-2">
                                <a href="{{ route('blog-course-view', ['course' => 'AWS']) }}">
                                    <div class="boxtop_box">
                                            <i aria-hidden="true" class="fab fa-amazon"></i>
                                            <p>AWS Cloud</p>
                                    </div>
                                </a>
                            </div>
                            
                            
                            <div class="col-md-2">
                                 <a href="{{ route('blog-course-view', ['course' => 'Azure']) }}">
                                    <div class="boxtop_box">
                                            <i aria-hidden="true" class="fab fa-microsoft"></i>
                                            <p>Azure Cloud</p>
                                    </div>
                                </a>
                            </div>
                            
                            
                            <div class="col-md-2">
                                <a href="{{ route('blog-course-view', ['course' => 'Windows Server Hybrid']) }}">
                                    <div class="boxtop_box">
                                        
                                            <i aria-hidden="true" class="fab fa-windows"></i>
                                            <p>Windows Server Hybrid</p>
                                    </div>
                                 </a>
                            </div>
                            
                            
                            <div class="col-md-2">
                                <a href="{{ route('blog-course-view', ['course' => 'CCNA']) }}">
                                <div class="boxtop_box">
                                        <i aria-hidden="true" class="fas fa-certificate"></i>
                                        <p>Computer Networks(CCNA)</p>
                                </div>
                                 </a>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-----------------------------Recent Posts------------------------ -->
    <section class="recent_post py-5 bggray1">
    <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <h3 class="pb-2">Recent Posts</h3>
                 <div class="row">
                @foreach($blog as $blogs)
               
                <div class="col-md-4 mb-4">
                    <div class="post_box">
                        <div class="row align-items-center">
                            <div class="col-md-12 img">
                                <a href="{{ url(route('blog.detail', ['category' =>'blog','slug' => $blogs->slug] )) }}"><img src="{{ asset('storage/' . $blogs->main_image) }}" alt="" /></a>
                            </div>
                            <div class="col-md-12 text_box_post">
                                <h6><a href="{{ url(route('blog.detail', ['category' =>'blog','slug' => $blogs->slug] )) }}">{{ $blogs->title }}</a></h6>
                                <p class="d-none">{{ $blogs->short_description }}</p>
                                <p class="pt-3"><strong>Last Update:</strong> {{ $blogs->updated_at->format('F j, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                @endforeach
                <div class="pagination">
                    {{ $blog->links('pagination::newbootstrap-5') }}
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
    <section class="other_courses pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="section_heading pb-3 text-left"> Trending Courses</h4>
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


    <section class="bggray1 other_courses pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="section_heading pb-3 text-left"> Interview Questions</h4>
                    <div class="owl-carousel owl-theme trending_course">
                        <div class="item">
                            <div class="other_crs_box">
                                <a href="/blog/top-30-vmware-interview-questions-and-answers-to-prepare-in-2024"><img src="/storage/assets/image/blog/dEM6Rsxqkpoj3xiwFgWrissi83JLZlGpt7RSREAI.jpg" /></a>
                            </div>
                        </div>

                        <div class="item">
                            <div class="other_crs_box">
                                <a href="/blog/top-50-aws-solution-architect-associate-interview-questions-and-answers-2024"><img src="/storage/assets/image/blog/PTWzquiba80P5Ov1dndoY2CMHYgvepOyLYOWA2dQ.jpg" /></a>
                            </div>
                        </div>

                        <div class="item">
                            <div class="other_crs_box">
                                <a href="/blog/top-best-40-microsoft-azure-interview-questions-and-answers-2024"><img src="/storage/assets/image/blog/pRSZbQUBiHjdjZclVAM6hRlhHk9yMZLKvsOMTdSR.jpg" /></a>
                            </div>
                        </div>

                        <div class="item">
                            <div class="other_crs_box">
                                <a href="/blog/top-50-mcse-interview-questions-and-answers-2024"><img src="/storage/assets/image/blog/zTqVXzs83nssJDUXIjPpdVdfjYI1x8lHGnutmnSX.jpg" /></a>
                            </div>
                        </div>

                        <div class="item">
                            <div class="other_crs_box">
                                <a href="/blog/top-essential-50-ccna-interview-questions-and-answers-2024"><img src="/storage/assets/image/blog/ib41sKbVBe6mnLM7hm8nvy4whmGZnWnK1jeXtbF7.jpg" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!----------------=============== blog end ================------------->
@endsection
