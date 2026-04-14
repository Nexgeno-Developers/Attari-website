@php
$session_data = json_decode(session('user_ip'), true);
@endphp

<form id="add_demo_form{{$form}}" action="{{url(route('contact.create'))}}" method="post"
enctype="multipart/form-data">
@csrf

    <input type="hidden" name="section" value="Book a FREE Demo Course Page" data-aos-once="true" data-aos="fade-up" />
    <input type="hidden" name="url" value="{{ url()->current() }}" data-aos-once="true" data-aos="fade-up" />

    <div class="form-group">
        <input type="text" name="services" class="form-control" value="{{ $courseName }}"
            placeholder="{{ $courseName }}" readonly>
    </div>

    <div class="form-group">
        <input type="text" name="name" class="form-control"
            placeholder="Enter Name" required>
    </div>

    <div class="form-group">
        <input type="text" name="email" class="form-control"
            placeholder="Enter Email" required>
    </div>

    <div class="form-group">
        <input type="text" name="country" class="form-control"
            placeholder="Your Country" required>
    </div>

    <div class="form-group">
        <input type="text" name="phone" class="form-control"
            placeholder="Mobile Number with Country code" required>
    </div>

    <input type="hidden" name="ip" value="{{ $session_data['ip'] }}" data-aos-once="true" data-aos="fade-up" />

    <input type="hidden" name="ref_url" value="{{ url()->previous() }}" data-aos-once="true" data-aos="fade-up" />

    {{-- <input type="hidden" name="source_url" value="{{ session('source_url') ?? '-' }}" data-aos-once="true" data-aos="fade-up" />
    <input type="hidden" name="source" value="{{ session('source') ?? '-' }}" data-aos-once="true" data-aos="fade-up" /> --}}

    <input type="hidden" name="medium" value="{{ get_medium('value') ?? '-' }}" data-aos-once="true" data-aos="fade-up" />

    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary">Send</button>
    </div>
</form>

