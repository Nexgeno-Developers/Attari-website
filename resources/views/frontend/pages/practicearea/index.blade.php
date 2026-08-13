@extends('frontend.layouts.app')

@section('page.title', ' ')

@section('page.description', 'Seedling & Associates is one of the best law firms in Delhi, India. We provide legal assistance for startups, FDI, Property law, IP, and more')

@section('page.type', 'practice area')

@section('page.content')


    <!-------===========practicearea list start===================------------>

    <!-- --------------- blog banner start ---------------- -->
    <section class="blog_banner text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="heading fs-2">Practice Areas</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb d-flex justify-content-center mb-0">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item home"><a href="{{ url(route('index')) }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Practice Areas</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- --------------- blog banner end ---------------- -->

    <!-- --------------- blog image start ---------------- -->

    <section class="blog_image">
        <div class="container">
            <div class="row">

                @foreach($practiceAreas as $row)
                    <div class="col-md-3">
                        <div class="practice_listing_box" data-aos="fade-up"data-aos-once="true">
                            <img src="{{ asset('storage/' . $row->thumnail_image) }}" alt="{{ $row->alt_thumnail_image }}" class="blog_img" />
                            <div class="practice_listing_content">
                                <h4>{{ $row->title }}</h4>
                                <a href="{{ url(route('practicearea-detail', ['slug' => $row->slug] )) }}">Learn More <img src="assets/frontend/images/right_arrow1.png"></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- --------------- blog image end ---------------- -->

    <!-- -------------------- Blog Start --------------- -->

    @include('frontend.component.random_blog_list_section')

    <!-- -------------------- Blog End --------------- -->

    <!-------===========practicearea end===================------------>
@endsection

