@extends('frontend.layouts.app')

@section('page.title', ' ')

@section('page.description', ' ')

@section('page.type', 'website')

@section('page.content')

    <!----------========== Learning Page start ===============-------------------->


    <section class="sm-at banner1">
        <img class="inner-banner-image" src="assets/frontend/images/Learning.jpg"/>
        <div class="container mt235">
            <div class="row">

                <div class="col-12">
                    <div class="breadcrums_section paddtb80">
                        <h1 class="sm-aboutus color-white1">Learning</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item"><a>»</a></li>
                                <li class="breadcrumb-item"><a><b>Learning</b></a></li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </section>


    @php
        $learning = DB::table('learnings')->where('status', 1)->get(['course_id','slug','page']);
    @endphp


    <section class="services courses_learning">
        <div class="container">


            <div class="row">
                <div class="col-12 text-center my-4">
                    <h1 class="services_headign">Virtualization & Cloud Computing</h1>
                </div>

                @php $filtered1 = $learning->where('course_id', 5); @endphp

                @if(count($filtered1) > 0)
                    <div class="col-lg-4 col-md-6 box_services">
                        <img src="/assets/frontend/images/vmvare_coursimg.jpg" alt="" />
                        <div class="text_box">
                            <h5 class="text_services_heading">
                                <a href=""> VMware vSphere 8 </a>
                            </h5>
                            <div class="course_button">
                                @php
                                    $practice_vm = $filtered1->where('page','practice')->first();
                                    $book_vm = $filtered1->where('page','book')->first();
                                @endphp
                                @if($practice_vm)
                                    <a href="{{ url(route('learning.detail', ['slug' => $practice_vm->slug] )) }}">Practice Test</a>
                                @endif

                                @if($book_vm)
                                    <a href="{{ url(route('learning.detail', ['slug' => $book_vm->slug] )) }}">Books &amp; Guides</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @php $filtered2 = $learning->where('course_id', 7); @endphp

                @if(count($filtered2) > 0)
                    <div class="col-lg-4 col-md-6 box_services">
                        <img src="/assets/frontend/images/azure_courseimg.jpg" alt="" />
                        <div class="text_box">
                            <h5 class="text_services_heading">
                                <a href=""> AWS Cloud Solution Architect </a>
                            </h5>
                            <div class="course_button">
                                @php
                                    $practice_aws = $filtered2->where('page','practice')->first();
                                    $book_aws = $filtered2->where('page','book')->first();
                                @endphp
                                @if($practice_aws)
                                    <a href="{{ url(route('learning.detail', ['slug' => $practice_aws->slug] )) }}">Practice Test</a>
                                @endif

                                @if($book_aws)
                                    <a href="{{ url(route('learning.detail', ['slug' => $book_aws->slug] )) }}">Books &amp; Guides</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @php $filtered3 = $learning->where('course_id', 8); @endphp

                @if(count($filtered3) > 0)
                    <div class="col-lg-4 col-md-6 box_services">
                        <img src="/assets/frontend/images/aws_courseimg.jpg" alt="" />
                        <div class="text_box">
                            <h5 class="text_services_heading">
                                <a href="">AZURE Cloud Administrator</a>
                            </h5>
                            <div class="course_button">
                                @php
                                    $practice_azure = $filtered3->where('page','practice')->first();
                                    $book_azure = $filtered3->where('page','book')->first();
                                @endphp
                                @if($practice_azure)
                                    <a href="{{ url(route('learning.detail', ['slug' => $practice_azure->slug] )) }}">Practice Test</a>
                                @endif

                                @if($book_azure)
                                    <a href="{{ url(route('learning.detail', ['slug' => $book_azure->slug] )) }}">Books &amp; Guides</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

            </div>


        </div>
    </section>

    @php $filtered4 = $learning->whereIn('course_id', ['11','10']); @endphp
    <!----------------Server & Networking------------------  -->

    @if(count($filtered4) > 0)
        <section class="services courses_learning">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center my-4">
                        <h1 class="services_headign">Server & Networking</h1>
                    </div>

                    @php $filtered5 = $learning->where('course_id', 11); @endphp

                    @if(count($filtered5) > 0)
                        <div class="col-lg-4 col-md-6 box_services">
                            <img src="/assets/frontend/images/vmvare_coursimg.jpg" alt="" />
                            <div class="text_box">
                                <h5 class="text_services_heading">
                                    <a href=""> Windows Server Hybrid </a>
                                </h5>
                                <div class="course_button">
                                    @php
                                        $practice_mcse = $filtered5->where('page','practice')->first();
                                        $book_mcse = $filtered5->where('page','book')->first();
                                    @endphp
                                    @if($practice_mcse)
                                        <a href="{{ url(route('learning.detail', ['slug' => $practice_mcse->slug] )) }}">Practice Test</a>
                                    @endif
    
                                    @if($book_mcse)
                                        <a href="{{ url(route('learning.detail', ['slug' => $book_mcse->slug] )) }}">Books &amp; Guides</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @php $filtered6 = $learning->where('course_id', 10); @endphp

                    @if(count($filtered6) > 0)
                        <div class="col-lg-4 col-md-6 box_services">
                            <img src="/assets/frontend/images/azure_courseimg.jpg" alt="" />
                            <div class="text_box">
                                <h5 class="text_services_heading">
                                    <a href=""> Cisco Networking CCNA </a>
                                </h5>
                                <div class="course_button">
                                    @php
                                        $practice_ccna = $filtered6->where('page','practice')->first();
                                        $book_ccna = $filtered6->where('page','book')->first();
                                    @endphp
                                    @if($practice_ccna)
                                        <a href="{{ url(route('learning.detail', ['slug' => $practice_ccna->slug] )) }}">Practice Test</a>
                                    @endif
    
                                    @if($book_ccna)
                                        <a href="{{ url(route('learning.detail', ['slug' => $book_ccna->slug] )) }}">Books &amp; Guides</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </section>
    @endif


    <!-------------=============== Learning Page end =============== -------------------->

@endsection