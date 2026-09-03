@php
    $lmsCoursesResponse = lms_publish_courses_api();
    $lmsCourses = $lmsCoursesResponse['success'] ? $lmsCoursesResponse['data'] : [];
@endphp
<section>
    <form id="add_course_form" action="{{url(route('course.create'))}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            

            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="" required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <label>Lms course sync</label>
                    <select class="form-control select2" name="lms_course_id">
                        <option value="">Select LMS course</option>
                        @foreach($lmsCourses as $lmsCourse)
                            <option value="{{ $lmsCourse['id'] }}">{{ $lmsCourse['name'] }}</option>
                        @endforeach
                    </select>
                    @if(!$lmsCoursesResponse['success'])
                        <small class="text-danger d-block mt-1">{{ $lmsCoursesResponse['error'] ?? 'Unable to load LMS courses' }}</small>
                    @endif
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <label>Home Thumbnail  <span class="font-size11">(Max file size 80kb - 1125*196)</span></label>
                    <input class="form-control" type="file" id="thumbnail" name="thumbnail" required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <label>Youtube Thumbnail  <span class="font-size11">(Max file size 80kb - 1125*196)</span></label>
                    <input class="form-control" type="file" id="thumbnail" name="other_thumbnail" required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <label>Youtube URL</label>
                    <input type="url" class="form-control" name="url" value="" >
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <label>Rating</label>
                    <input type="text" class="form-control" name="rating" value="" required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <label>Total Review</label>
                    <input type="text" class="form-control" name="total_review" value="" required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <label>Slug ( Url-course alias )</label>
                    <input type="text" class="form-control" name="slug_url" value="" required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <label>Meta Title </label>
                    <input type="text" class="form-control" name="meta_title" value="" required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <label>Meta Description </label>
                    <textarea class="form-control" name="meta_description" rows="2" required></textarea>
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <label>Key Features Title </label>
                    <input type="text" class="form-control" name="key_title" value="" required>
                </div>
            </div>
            
            {{---
            <div class="col-sm-12">
                <div class="form-group mb-3">
                    <label>Description</label>
                    <textarea class="form-control trumbowyg" name="description" rows="2" required></textarea>
                </div>
            </div> ---}}

            <div class="col-sm-12">
                <div class="form-group mb-3">
                    <label>Course Overview Section Heading</label>
                    <input type="text" class="form-control" name="overview_section_heading" value="" >
                </div>
            </div>
    
            <div class="col-sm-12">
                <div class="form-group mb-3">
                    <label>Course Overview</label>
                    <textarea class="form-control trumbowyg" name="course_overview" rows="2" required></textarea>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group mb-3">
                    <label>Course Overview FAQs</label>
                    <div id="faq_add_more" style="margin: 10px;">
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-11">
                                <div class="row">
                                    <input type="text" style="margin-bottom: 5px;" class="form-control" name="faq[]" placeholder="Enter Question here...">
                                    <span class="glyphicon form-control-feedback"></span>
                                    <textarea id="trumbowyg_0" class="form-control" name="faq_description[]" rows="2" placeholder="Enter Answer here..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-1"><i style="font-size: 25px; color: #0b0; cursor: pointer; margin-left: 10px;" class="ri-add-circle-fill" id="add_faq"></i></div>
                            </div>
                            </br>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="col-sm-12 d-flex justify-content-end">
                <div class="form-group d-grid mb-3 text-end">
                    <button type="submit" class="btn btn-block btn-primary">Create</button>
                </div>
            </div>
  
            
        </div>
    </form>
</section>


<script>
$(document).ready(function() {
    initValidate('#add_course_form');
    initSelect2('.select2');
    initTrumbowyg('.trumbowyg');
    initTrumbowyg('#trumbowyg_0');
});

$("#add_course_form").submit(function(e) {
    var form = $(this);
    ajaxSubmit(e, form, responseHandler);
});

var responseHandler = function(response) {
    location.reload();
}

function remove_faq(_this) {
    _this.closest(".faq").remove();
}

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
                        <textarea id="trumbowyg_${textareaIdCounter}" class="trumbowyg form-control" name="faq_description[]" rows="2" placeholder="Enter Answer here..."></textarea>
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


