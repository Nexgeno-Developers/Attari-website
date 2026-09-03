@php
    $lmsCoursesResponse = lms_publish_courses_api();
    $lmsCourses = $lmsCoursesResponse['success'] ? $lmsCoursesResponse['data'] : [];
@endphp
<!-----==================== Edit Course ==========----------------------->

<div class="card">
    <div class="card-body">
        <div class="col-md-12">
            <h4 class="header-title"><b>Edit Key Feature & Course Overview</b></h4>
            <hr>
        </div>

        <section>
            <form id="edit_course_form" action="{{ url(route('course.update')) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <input type="hidden" class="form-control" name="id" value="{{ $course->id }}">
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $course->name }}" required>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label>Lms course sync</label>
                            <select class="form-control select2" name="lms_course_id">
                                <option value="">Select LMS course</option>
                                @foreach($lmsCourses as $lmsCourse)
                                    <option value="{{ $lmsCourse['id'] }}" @selected((string) $course->lms_course_id === (string) $lmsCourse['id'])>{{ $lmsCourse['name'] }}</option>
                                @endforeach
                            </select>
                            @if(!$lmsCoursesResponse['success'])
                                <small class="text-danger d-block mt-1">{{ $lmsCoursesResponse['error'] ?? 'Unable to load LMS courses' }}</small>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group mb-3">
                                    <label>Thumbnail <span class="font-size11">(Max file size 80kb -
                                            1125*196)</span></label>
                                    <input accept="image/*" class="form-control" type="file" id="thumbnail" name="thumbnail">
                                    @if ($course->thumbnail)
                                        <div class="form-check form-switch">

                                            <input id="thumbnail_check" class="form-check-input" type="checkbox"
                                                name="thumbnail_check" value="1">

                                            <label class="form-check-label" for="thumbnail_check">Remove thumnail
                                                icon</label>

                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if ($course->thumbnail)
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" class="img-thumbnail">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group mb-3">
                                    <label>Youtube Thumbnail</label>
                                    <input accept="image/*" class="form-control" type="file" id="thumbnail" name="other_thumbnail">
                                    @if ($course->other_thumbnail)
                                        <div class="form-check form-switch">

                                            <input id="thumbnail_check" class="form-check-input" type="checkbox"
                                                name="other_thumbnail_check" value="1">

                                            <label class="form-check-label" for="thumbnail_check">Remove Other Course thumnail
                                                icon</label>

                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if ($course->other_thumbnail)
                                    <img src="{{ asset('storage/' . $course->other_thumbnail) }}" class="img-thumbnail">
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label>Alias</label>
                            <input type="text" class="form-control" name="alias4" value="{{ $course->alias4 }}" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group mb-3">
                                    <label>Thumbnail Home <span class="font-size11">(Max file size 80kb -
                                            380*250)</span></label>
                                    <input accept="image/*" class="form-control" type="file" id="thumbnail_1" name="thumbnail_1">
                                    @if ($course->thumbnail_1)
                                        <div class="form-check form-switch">

                                            <input id="thumbnail_1_check" class="form-check-input" type="checkbox"
                                                name="thumbnail_1_check" value="1">

                                            <label class="form-check-label" for="thumbnail_1_check">Remove thumnail
                                                icon</label>

                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if ($course->thumbnail_1)
                                    <img src="{{ asset('storage/' . $course->thumbnail_1) }}" class="img-thumbnail">
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group mb-3">
                                    <label>Thumbnail Syllabus PDF <span class="font-size11">(Max file size 80kb -
                                            300*330)</span></label>
                                    <input accept="image/*" class="form-control" type="file" id="thumbnail_2" name="thumbnail_2">
                                    @if ($course->thumbnail_2)
                                        <div class="form-check form-switch">

                                            <input id="thumbnail_2_check" class="form-check-input" type="checkbox"
                                                name="thumbnail_2_check" value="1">

                                            <label class="form-check-label" for="thumbnail_2_check">Remove thumnail
                                                icon</label>

                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if ($course->thumbnail_2)
                                    <img src="{{ asset('storage/' . $course->thumbnail_2) }}" class="img-thumbnail">
                                @endif
                            </div>
                        </div>
                    </div>                   

                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label>Youtube URL</label>
                            <input type="url" class="form-control" name="url" value="{{ $course->url }}">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label>Rating</label>
                            <input type="text" class="form-control" name="rating"
                                value="{{ $course->rating }}" required>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label>Total Review</label>
                            <input type="text" class="form-control" name="total_review"
                                value="{{ $course->total_review }}" required>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label>Slug ( Url-course alias )</label>
                            <input type="text" class="form-control" name="slug_url" value="{{ $course->slug_url }}" required>
                        </div>
                    </div>
        
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label>Meta Title </label>
                            <input type="text" class="form-control" name="meta_title" value="{{ $course->meta_title }}" required>
                        </div>
                    </div>
        
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label>Meta Description </label>
                            <textarea class="form-control" name="meta_description" rows="2" required>{{ $course->meta_description }}</textarea>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label>Key Features Title </label>
                            <input type="text" class="form-control" name="key_title" value="{{ $course->key_title }}" required>
                        </div>
                    </div>

                    {{--
                    <div class="col-sm-12">
                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea class="form-control trumbowyg" name="description" rows="2">{{ $course->description }}</textarea>
                        </div>
                    </div> --}}

                    <div class="col-sm-12">
                        <div class="form-group mb-3">
                            <label>Course Overview Section Heading</label>
                            <input type="text" class="form-control" name="overview_section_heading" value="{{ $course->overview_section_heading }}" >
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group mb-3">
                            <label>Course Overview</label>
                            <textarea class="form-control trumbowyg" name="course_overview" rows="2">{{ $course->course_overview }}</textarea>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group mb-3">
                            <label>Course Overview FAQs</label>
                            <div id="faq_add_more" style="margin: 10px;"> @php $i = 1; $faq = json_decode($course->faq); if (!empty($faq)) { foreach ($faq as $fkey => $fvalue) { $farr_value = (array)$fvalue; foreach ($farr_value as $fkey1 => $fvalue1) { @endphp
                                <div class="faq">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="row">
                                                    <input type="text" style="margin-bottom: 3px;" class="form-control" name="faq[]" placeholder="Enter Question here..." value="{{ $fkey1 }}"> <span class="glyphicon form-control-feedback"></span>
                                                    <textarea class="form-control trumbowyg" name="faq_description[]" rows="5" placeholder="Enter Answer here...">{{ $fvalue1 }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-1"> @if($i == 1) <i style="font-size: 25px; color: #0b0; cursor: pointer; margin-left: 10px;" class="ri-add-circle-fill" id="add_faq"></i> @else <i style="font-size: 25px; color: red; cursor: pointer; margin-left: 10px;" class="ri-delete-bin-2-fill" onclick="remove_faq($(this));"></i> @endif </div>
                                        </div>
                                    </div>
                                    </br>
                                </div> @php $i++; } @endphp @php } @endphp @php } else { @endphp
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="row">
                                                <input type="text" style="margin-bottom: 3px;" class="form-control" name="faq[]" placeholder="Enter Question here..."> <span class="glyphicon form-control-feedback"></span>
                                                <textarea class="form-control trumbowyg" name="faq_description[]" rows="5" placeholder="Enter Answer here..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-1"> <i style="font-size: 25px; color: #0b0; cursor: pointer; margin-left: 10px;" class="ri-add-circle-fill" id="add_faq"></i> </div>
                                    </div>
                                    </br>
                                </div> @php } @endphp </div>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-end">
                        <div class="form-group d-grid mb-3 text-end">
                            <button type="submit" class="btn btn-block btn-primary">Update</button>
                        </div>
                    </div>

                </div>
            </form>
        </section>




    </div>
    <!-- end card-body-->
</div>

<!-----==================== Edit Course ==========----------------------->

@section('component.scripts')
    <script>
        function remove_faq(_this) {
            _this.closest(".faq").remove();
        }
    </script>
    
    <script>
		$(document).ready(function() {
			initTrumbowyg('.trumbowyg');
		});


        var textareaIdCounter = 0;
        $("#add_faq").on("click", function() {
            textareaIdCounter++;
            var newFaq = `
                <div class="faq form-group">
                    <div class="row" data-id="${textareaIdCounter}">
                        <div class="col-md-11">
                            <div class="row">
                                <input type="text" style="margin-bottom: 3px;" class="form-control" name="faq[]" placeholder="Enter Question here...">
                                <span class="glyphicon form-control-feedback"></span>
                                <textarea id="trumbowyg_${textareaIdCounter}" class="trumbowyg form-control" name="faq_description[]" rows="5" placeholder="Enter Answer here..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-1"><i style="font-size: 25px; color: red; cursor: pointer; margin-left: 10px;" class="ri-delete-bin-2-fill" onclick="remove_faq($(this));"></i></div>
                    </div>
                    </br>
                </div>
            `;
            $("#faq_add_more").append(newFaq);
            initTrumbowyg(`#trumbowyg_${textareaIdCounter}`);
        });
    </script>
@endsection    


