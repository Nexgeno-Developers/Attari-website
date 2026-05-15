<div id="contact-details">
    @if($contact->name)
    <p><strong>Name:</strong> {{$contact->name}}</p>
    @endif   
    @if($contact->email)
    <p><strong>Email:</strong> {{$contact->email}}</p>
    @endif
    @if($contact->phone)
    <p><strong>Phone:</strong> {{$contact->phone}}</p>
    @endif
    @if($contact->services)
    <p><strong>Course:</strong> {{$contact->services}}</p>
    @endif
    @if($contact->description)
    <p><strong>Message:</strong> {{$contact->description}}</p>
    @endif
    @if($contact->other_info)
    <p><strong>Other Info:</strong> {{$contact->other_info}}</p>
    @endif
    @if($contact->cv)
    <p><strong>CV:</strong> <a target="_blank" href="{{ asset('storage/' . $contact->cv) }}">View</a></p>
    @endif
    @if($contact->qualification)
    <p><strong>Qualification:</strong> {{$contact->qualification}}</p>
    @endif    
    @if($contact->url)
    <p><strong>Page:</strong> <a target="_blank" href="{{$contact->url}}">{{$contact->url}}</a></p>
    @endif
    @if($contact->section)
    <p><strong>Section:</strong> {{$contact->section}}</p>
    @endif
   
    <p><strong>Country Code:</strong> {{$contact->w_countrycode}}</p>
    
    
    <p><strong>Country Phone:</strong> {{$contact->w_phone}}</p>
    
    @if ($contact->w_syllabus == '1')
    <p><strong>Syllabus Status:</strong> <span class="badge bg-success">SYLLABUS SENT</span></p>
    @elseif ($contact->w_syllabus == '0')
    <p><strong>Syllabus Status:</strong> <span class="badge bg-danger">SYLLABUS NOT SENT</span></p>
    @endif
    
    @if($contact->source_url)
    <p><strong>Source URL:</strong> <a target="_blank" href="{{$contact->source_url}}">{{$contact->source_url}}</a></p>
    {{-- <p><strong>Source:</strong> {{$contact->source}}</p> --}}
    @endif
    
    @if($contact->medium)
    <p><strong>medium :</strong> {{$contact->medium}}</p>
    @endif
</div>