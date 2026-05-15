

@php
//$course = DB::table('cms')->where('status', 1)->where('zone', 0)->get(['menu_title','slug','status']);
$course = getcmsCourses();
@endphp


<!--header  start-->
<style>
    .inner-banner-image
    {
            width: 100%;
    height: 235px;
    object-fit: cover;
    object-position: center;
    }
    
    .mt235
    {
        margin-top:-235px;
    }
    .color-white1
    {
        color:#fff;
    }
    @media(max-width:767px)
    {
        .inner-banner-image
    {
           
    height: 123px;
    }
    
    .mt235
    {
        margin-top:-123px;
    }
    }
</style>


<!--<div class="mobile-whatsapp-channel">-->
<!--    <div class="container">-->
<!--        <div class=""><a target="_blank" href="https://whatsapp.com/channel/0029Va9JnmaHAdNWUTJFhc2O ">Join Attari Classes channel on <i aria-hidden="true" class="fab fa-whatsapp"></i></a></div>-->
<!--    </div>-->
<!--</div>-->
    
</div>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="nav_row v_center">
                        <div class="header_item item_left">
                            <div class="logo">
                                <a href="{{ url(route('index')) }}" aria-label="Logo Link">
                                    <img class="sm-logo-size" src="/assets/frontend/images/cropped-header-logo-1.webp" width="180"
                                        height="50" alt="Logo" />
                                </a>
                            </div>
                        </div>
                        <div class="nav-sections1 header_item item_center">
                            <div class="menu_overlay"></div>
                            <nav id="nav-menu" class="menu">
                                <div class="mobile_menu_head">
                                    <div class="go_back"><i class="fa fa-angle-left"></i></div>
                                    <div class="current_menu_title"></div>
                                    <div class="mobile_menu_close">&times;</div>
                                </div>
                                <ul class="manu_main">
                                    <li class="menu_item_has_children">
                                        <span class="course_heds">Courses
                                            <i class="nav-arrow fa fa-angle-down" aria-hidden="true" role="img"></i>
                                        </span>
                                        <div class="sub_menu single_column_menu">
                                            <ul>
                                                @foreach ($course as $row)
                                                        @php
                                                            $slug = $row->slug === 'mcsa-mcse-windows-server-training-online' 
                                                                ? 'windows-server-hybrid-training-certification-online' 
                                                                : $row->slug;
                                                        @endphp
                                                    <li>
                                                        <a href="{{ url(route('course.detail', ['slug' => $slug] )) }}">
                                                            <span class="icon_text">
                                                                <i class="fa
                                                                @switch(strtolower($row->menu_title))
                                                                    @case('vmware')
                                                                        fa-laptop
                                                                        @break
                                                        
                                                                    @case('aws cloud')
                                                                        fa-brands fa-amazon
                                                                        @break
                                                        
                                                                    @case('azure cloud')
                                                                        fa-brands fa-microsoft
                                                                        @break
                                                        
                                                                    @case('mcse')
                                                                        fa-brands fa-windows
                                                                        @break
                                                        
                                                                    @case('ccna')
                                                                        fa-solid fa-certificate
                                                                        @break
                                                        
                                                                    @default
                                                                        fa-laptop
                                                                @endswitch"
                                                                aria-hidden="true"></i>          
                                                                {{ $row->menu_title }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                    <li><a href="{{ url(route('training-option')) }}">Training Options</a></li>
                                    <li><a href="{{ url(route('batch')) }}">Batch Schedule</a></li>
                                    <li><a href="{{ url(route('about')) }}">About Us</a></li>
                                    <li><a href="{{ url(route('reviews')) }}">Reviews</a></li>
                                    <li><a href="{{ url(route('success-stories')) }}">Success Stories</a></li>
                                    <li><a href="{{ url(route('blog')) }}">Blog</a></li>
                                    <li><a href="{{ url(route('contact')) }}">Contact Us</a></li>

                                </ul>
                            </nav>
                        </div>
                        <div class="header_item item_right">
                            <div class="mobile_menu_trigger">
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

