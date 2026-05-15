<!------------------------- Add Form ------------------------------------>

<section>
    <form id="add_learning_form" action="{{ url(route('learning.create')) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
                <div class="card">
                    <div class="card-body">

                        <input type="hidden" class="form-control" name="course_id" value="{{ $course->id }}">


                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label>Slug <span class="red">*</span></label>
                                <input maxlength="255" type="text" class="form-control" name="slug" required>
                            </div>

                            <br>
                            <input type="hidden" class="form-control" name="page" value="practice">
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label>More Info <span class="red">*</span></label>
                                <input maxlength="255" type="text" class="form-control" name="more_info" required>
                            </div>

                            <br>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="header-title"><b>PDF Manage</b></h4>
                                <hr>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label>Heading Title <span class="red">*</span></label>
                                    <input type="text" class="form-control" name="heading_pdf_title" value="" required>
                                </div>
                            </div>
                                    
                            <div class="col-sm-8">
                                <div class="form-group mb-3">
                                    <label>PDF File <span class="red">*</span></label>
                                    <div id="progress_bar_add_more" style="margin: 10px;">
                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-11">
                                                <div class="row">
                                                    <input type="text" style="margin-bottom: 5px;" class="form-control" name="pdf_title[]" placeholder="Enter Title here..." required>
                                                    <span class="glyphicon form-control-feedback"></span>
                                                    <input class="form-control" type="file" name="pdf_0" required>
                                                </div>
                                            </div>
                                            <div class="col-md-1"><i style="font-size: 25px; color: #0b0; cursor: pointer; margin-left: 10px;" class="ri-add-circle-fill" id="add_progress_bar"></i></div>
                                            </div>
                                            </br>
                                        </div>
                                    </div>
                                </div>
                            </div> 



                        </div>
<!-------==========================================================-------------------->

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="header-title"><b>Video Section</b></h4>
                                <hr>
                            </div>
                    
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label>Statement <!--<span class="red">*</span>--></label>
                                    <textarea class="form-control trumbowyg" name="statement" rows="4" placeholder="Enter statement here..."></textarea>
                                </div>
                            </div>
                                    
                    
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label>Youtube Video URL<!--<span class="red">*</span>--></label>
                                    <input type="url" class="form-control" name="youtube_url">
                                </div>
                            </div>
                    
                        </div>

<!-------==========================================================-------------------->

<!-------==========================================================-------------------->

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="header-title"><b>Schedule / Testimonials</b></h4>
                                <hr>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label>Schedule Heading <span class="red">*</span></label>
                                    <input type="text" class="form-control" name="schedule_title" value="" required>
                                </div>
                            </div>
                                    

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label>Testimonials Heading <span class="red">*</span></label>
                                    <input type="text" class="form-control" name="testimonials_title" value="" required>
                                </div>
                            </div>

                        </div>
<!-------==========================================================-------------------->

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="header-title"><b>Faq Manage</b></h4>
                                <hr>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label>FAQ Heading <span class="red">*</span></label>
                                    <input type="text" class="form-control" name="faq_title" value="" required>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label>FAQs</label>
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
                                    


                        </div>

<!------===========================================================------------------>
                        
                        <div class="col-sm-12">
                            {{--
                            <div class="d-flex justify-content-start">
                                <div class="form-check form-switch">

                                    <input id="learning_check" class="form-check-input" type="checkbox"
                                        name="learning_check" value="0">

                                    <label class="form-check-label" for="learning_check">Hide Batch Schedule
                                    </label>

                                </div>
                            </div> --}}
                            <div class="d-flex justify-content-end">
                                <div class="form-group d-grid mb-3 text-end">
                                    <button type="submit" class="btn btn-block btn-primary">Create</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


        </div>
    </form>
</section>

<!------------------------- Add Form ------------------------------------>
@section('component.scripts')
    <script>
        $(document).ready(function() {
            initValidate('#add_learning_form');
            initTrumbowyg('#trumbowyg_0');
        });

        $("#add_learning_form").submit(function(e) {
            var form = $(this);
            ajaxSubmit(e, form, responseHandler);
        });

        $("#updating_heading_form").submit(function(e) {
            var form = $(this);
            ajaxSubmit(e, form, responseHandler);
        });


        var responseHandler = function(response) {
            location.reload();
        }

        function remove_progress_bar(_this) {
            _this.closest(".progress_bar").remove();
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

        var pdfCounter = 0;

        $("#add_progress_bar").on("click", function() {
            pdfCounter++;

        var new_progress_bar = `
            <div class="progress_bar form-group">
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <input type="text" style="margin-bottom: 3px;" class="form-control" name="pdf_title[]" placeholder="Enter Title here..." required>
                            <span class="glyphicon form-control-feedback"></span>

                            <input class="form-control" type="file" name="pdf_${pdfCounter}" required>

                        </div>
                    </div>
                    <div class="col-md-1"><i style="font-size: 25px; color: red; cursor: pointer; margin-left: 10px;" class="ri-delete-bin-2-fill" onclick="remove_progress_bar($(this));"></i></div>
                </div>
                </br>
            </div>
        `;

        $("#progress_bar_add_more").append(new_progress_bar);
        });



    </script>
@endsection