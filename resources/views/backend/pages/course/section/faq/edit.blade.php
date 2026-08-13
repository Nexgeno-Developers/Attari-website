<!----------======================Text edit Form =============================----------------->
<section>
    <form id="edit_faq_form" action="{{ url(route('faq.update')) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <input type="hidden" name="id" value="{{ $faq->id }}">
            <input type="hidden" class="form-control" name="course_id" value="{{ $faq->course_id }}">
            <div class="col-sm-2">
                <div class="form-group mb-3">
                    <label>Sr No <span class="red">*</span></label>
                    <input maxlength="255" type="text" class="form-control" name="title_no" value="{{ $faq->title_no }}" required>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="form-group mb-3">
                    <label>Question <span class="red">*</span></label>
                    <input maxlength="255" type="text" class="form-control" name="question"
                        value="{{ $faq->question }}" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <label>Zone</label>
                    <select class="form-select" name="zone" required>
                        <option value="0" @if($faq->zone == "0") selected @endif>Main</option>
                        <option value="1" @if($faq->zone == "1") selected @endif>City/Country</option>
                    </select> 
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group mb-3">
                    <label>Answer <span class="red">*</span></label>
                    <textarea class="trumbowyg form-control" id="trumbowyg" name="answer" rows="5" required>{{ $faq->answer }}</textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group mb-3 text-end">
                    <button type="submit" class="btn btn-block btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
</section>


    <script>
        $(document).ready(function() {
            initValidate('#edit_faq_form');
            initTrumbowyg('#trumbowyg');
        });

        $("#edit_faq_form").submit(function(e) {
            var form = $(this);
            ajaxSubmit(e, form, responseHandler);
        });

        var responseHandler = function(response) {
            if (window.courseFaqSection) {
                window.courseFaqSection.onUpdated(response);
            } else {
                location.reload();
            }
        }
    </script>

<!----------======================Text edit Form =============================----------------->