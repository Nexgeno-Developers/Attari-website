@php
  
  $mcseCourse = DB::table('courses')->where('id', 11)->first();
  $ccnaCourse = DB::table('courses')->where('id', 10)->first();

@endphp

<section class="services mrgtop50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center mt-1 mb-lg-3 mb-0">
                <h4 class="services_headign">Server & Networking</h4>
            </div>

            <div class="col-md-4 box_services"> 
                <a href="{{ url($mcseCourse->slug_url)}}-online">
            <img src="{{ asset('storage/' . $mcseCourse->thumbnail_1) }}" width="380"
                    height="224" class="image_width1" alt="VMware vSphere 7 ">
                
                    <div class="text_box">
                        <h5 class="text_services_heading">
                            {{$mcseCourse->alias4}}
                        </h5>
                        <p class="text_services_para"> <i class="fa fa-clock-o" aria-hidden="true"></i> 40 Hours Approx.
                            <br /> <i class="fa fa-calendar-check-o" aria-hidden="true"></i> View Batch Schedule
                        </p>
                    </div>
                </a>
            </div>

            <div class="col-md-4 box_services"> 
                <a href="{{ url($ccnaCourse->slug_url)}}-online">
            <img src="{{ asset('storage/' . $ccnaCourse->thumbnail_1) }}" width="380"
                    height="224" class="image_width1" alt="VMware vSphere 7 ">
                
                    <div class="text_box">
                        <h5 class="text_services_heading">
                            {{$ccnaCourse->alias4}}
                        </h5>
                        <p class="text_services_para"> <i class="fa fa-clock-o" aria-hidden="true"></i> 45 Hours Approx.
                            <br /> <i class="fa fa-calendar-check-o" aria-hidden="true"></i> View Batch Schedule
                        </p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>

