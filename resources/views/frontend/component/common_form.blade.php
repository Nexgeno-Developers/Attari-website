@php
$session_data = json_decode(session('user_ip'), true);
// Define the amount you want to increment by
$amount = 1; // Change this to your desired amount

// Increment a session value by a specific amount and dump it
$value = Session()->increment('key', $amount);
$class = "form_" . $value;
$honeypotFieldName = 'website_' . strtolower(\Illuminate\Support\Str::random(12));

    // Clear the session data
    session()->forget('enquiry_id');
    session()->forget('course_name');

@endphp

<style>
    .honeypot-trap {
        position: absolute !important;
        left: -9999px !important;
        width: 1px !important;
        height: 1px !important;
        overflow: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }
</style>

<form class="{{$class}} enquiry_form" action="{{url(route('contact.create'))}}" method="post" enctype="multipart/form-data">
    @csrf

    <!-- <p class="enquiry_form_title text-center {{ isset($Headingclassname) ? $Headingclassname : '' }}">{!! isset($title) ? $title : '' !!}</p> -->

    <input type="hidden" name="section" value="{{$section}}" data-aos-once="true" data-aos="fade-up" />
    <input type="hidden" name="url" value="{{ request()->fullUrl() }}" data-aos-once="true" data-aos="fade-up" />
    <input type="hidden" name="ip" value="{{ $session_data['ip'] }}" data-aos-once="true" data-aos="fade-up" />
    <input type="hidden" name="ref_url" value="{{ url()->previous() }}" data-aos-once="true" data-aos="fade-up" />  
    
    <input type="hidden" name="source_url" value="{{ session('source_url') ?? '-' }}" data-aos-once="true" data-aos="fade-up" />
    {{-- <input type="hidden" name="source" value="{{ session('source') ?? '-' }}" data-aos-once="true" data-aos="fade-up" /> --}}

    <input type="hidden" name="medium" value="{{ get_medium('value') ?? '-' }}" data-aos-once="true" data-aos="fade-up" />
    <input type="hidden" name="honeypot_field_name" value="{{ $honeypotFieldName }}" />

    <div class="honeypot-trap" aria-hidden="true">
        <label for="{{ $honeypotFieldName }}">Enquiry</label>
        <input
            type="text"
            id="{{ $honeypotFieldName }}"
            name="{{ $honeypotFieldName }}"
            value=""
            tabindex="-1"
            autocomplete="off"
        />
    </div>

    <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Enter Name *" autocomplete="off" maxlength="50" aria-label="Full Name" required />
    </div>

    <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Enter Email *" autocomplete="off" maxlength="50" aria-label="Email Address" required />
    </div>

    <div class="form-group">
        <input type="text" class="form-control" name="country" placeholder="Your Country *" autocomplete="off" maxlength="50" aria-label="Country" required />
    </div>

    <div class="form-group">
        <input type="tel" class="form-control" name="phone" placeholder="Mobile no with country code *" autocomplete="off" maxlength="20" pattern="^\+?[0-9][0-9\s\-\(\)]{6,19}$" aria-label="Mobile Number" required />
    </div>

    @if(!empty($course_name))
        <div class="form-group">
            <input type="text" class="form-control enquiry_form_course" name="services" value="{{$course_name}}" placeholder="{{$course_name}} *" readonly="">
        </div>
    @else
        <div class="form-group">
            <select aria-label="services"  name="services" class="form-select form-control"  autocomplete="off" required>
                <option value="">--Select Course-</option>
                @php
                  $coursesData = getCourses();
                @endphp
                @foreach($coursesData as $row)
                <option value="{{$row->menu_title}}">{{$row->menu_title}}</option>
                @endforeach
            </select>
        </div>
    @endif

        <div class="form-group">
            <textarea aria-label="Message" name="description" class="form-control" placeholder="Message" autocomplete="off" maxlength="200"></textarea>
        </div>

    <div class="form-group text-center">
        <button class="btn btn-primary submit_button" type="submit" value="send">Submit</button>
        <!--<input class="btn btn-primary submit_button" type="submit" value="send" />-->
    </div>

</form>
<script>

$(document).ready(function() {
    
    $('input[name="ref_url"]').val($("#refUrl").attr('href'));
    $('input[name="url"]').val($("#fullUrl").attr('href'));
    
    initValidate(".{{$class}}");
    $("body").on("submit", ".{{$class}}", function (e) {
        e.preventDefault();
        var form = $(this);
        ajaxSubmit(e, form, responseHandler);
                // Close keyboard in mobile view
        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            $("input, textarea").blur(); // Trigger blur event on input and textarea elements
        }
    });
    
    var responseHandler = function (response) {
        var form = $("form.{{$class}}"); // Find the form element
        form[0].reset(); // Reset the form
        $("select", form).prop("selectedIndex", 0); // Reset select dropdowns
        $("#formModal").modal("hide");
        $("#enquiry_modal").modal("hide");
        $(".query_form.active").removeClass("active");
        setTimeout(function() {
            $("#getsyllabusModal").modal("show");
        }, 300);
        //dataLayerWEB('webformsubmit', 'web_enquiry', 'form successfully submit');
        console.log("regular form");
        
        // Access the data property
        const data = response.data;
        
       $("#getsyllabus").find('input[name="course"]').val(data.course);   
       $("#getsyllabus").find('input[name="enquiry_id"]').val(data.enquiry_id);   
       dataLayerWEB('webformsubmit', 'web_enquiry', 'form successfully submit');//
    };
});


</script>