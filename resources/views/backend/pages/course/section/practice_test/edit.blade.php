<!---------------------------------- edit form --------------------------------------->

<section>
    <form id="edit_learning_form" action="{{ url(route('learning.update')) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
                <div class="card">
                    <div class="card-body">

                        <input type="hidden" class="form-control" name="id" value="{{ $learning->id }}">

                        <input type="hidden" class="form-control" name="course_id" value="{{ $course->id }}">

                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label>Slug <span class="red">*</span></label>
                                <input maxlength="255" type="text" class="form-control" name="slug" value="{{ $learning->slug }}" required>
                            </div>

                            <br>
                            <input type="hidden" class="form-control" name="page" value="practice">
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label>More Info <span class="red">*</span></label>
                                <input maxlength="255" type="text" class="form-control" name="more_info" value="{{ $learning->more_info }}"  required>
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
                                    <input type="text" class="form-control" name="heading_pdf_title" value="{{ $learning->heading_pdf_title }}" required>
                                </div>
                            </div>
                                   
                            
                            <div class="col-sm-8">
                                <div class="form-group mb-3">
                                    <label>PDF File</label>
                                    <div id="progress_bar_add_more" style="margin: 10px;"> 

                                    @php $p = 0; $pdf = json_decode($learning->pdf); 

                                    if(!empty($pdf)) { 
                                        foreach ($pdf as $row) { 
                                    @endphp

                                    <div class="progress_bar">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-11">
                                                            <div class="row">

                                                                <input type="text" style="margin-bottom: 3px;" class="form-control" name="pdf_title[]" placeholder="Enter Title here..." value="{{ $row->title }}"> 

                                                                <span class="glyphicon form-control-feedback"></span>

                                                                <input class="form-control" type="file" name="pdf_{{$p}}">

                                                                <input type="hidden" name="view[]" value="{{ $row->pdf }}" >

                                                                <a target="_blank" href="{{ asset('storage/' . $row->pdf) }}">
                                                                    View
                                                                </a>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-1"> @if($p == 0) <i style="font-size: 25px; color: #0b0; cursor: pointer; margin-left: 10px;" class="ri-add-circle-fill" id="add_progress_bar"></i> @else <i style="font-size: 25px; color: red; cursor: pointer; margin-left: 10px;" class="ri-delete-bin-2-fill" onclick="remove_progress_bar($(this));"></i> @endif </div>
                                                    </div>
                                                </div>
                                                </br>
                                            </div> @php $p++; } @endphp @php } else { @endphp
                                                <div class="form-group">
                                                <div class="row">
                                                <div class="col-md-11">
                                                    <div class="row">
                                                        <input type="text" style="margin-bottom: 5px;" class="form-control" name="pdf_title[]" placeholder="Enter Title here...">
                                                        <span class="glyphicon form-control-feedback"></span>
                                                        <input class="form-control" type="file" name="pdf_0" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-1"><i style="font-size: 25px; color: #0b0; cursor: pointer; margin-left: 10px;" class="ri-add-circle-fill" id="add_progress_bar"></i></div>
                                                </div>
                                                </br>
                                            </div> @php } @endphp 
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
                <label>Statement <span class="red">*</span></label>
                <textarea class="form-control trumbowyg" name="statement" rows="4" placeholder="Enter statement here...">{{$learning->statement}}</textarea>
            </div>
        </div>
                

        <div class="col-sm-12">
            <div class="form-group mb-3">
                <label>Youtube Video URL<span class="red">*</span></label>
                <input type="url" class="form-control" name="youtube_url" value="{{$learning->youtube_url}}">
            </div>
        </div>

    </div>

<!-------==========================================================-------------------->

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="header-title"><b>Schedule / Testimonials</b></h4>
                                <hr>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label>Schedule Heading <span class="red">*</span></label>
                                    <input type="text" class="form-control" name="schedule_title" value="{{ $learning->schedule_title }}" required>
                                </div>
                            </div>
                                    

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label>Testimonials Heading <span class="red">*</span></label>
                                    <input type="text" class="form-control" name="testimonials_title" value="{{ $learning->testimonials_title }}" required>
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
                                    <input type="text" class="form-control" name="faq_title" value="{{ $learning->faq_title }}" required>
                                </div>
                            </div>
                                    
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label>FAQs</label>
                                    <div id="faq_add_more" style="margin: 10px;"> @php $i = 1; $faq = json_decode($learning->faq); if (!empty($faq)) { foreach ($faq as $fkey => $fvalue) { $farr_value = (array)$fvalue; foreach ($farr_value as $fkey1 => $fvalue1) { @endphp
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


                        </div>

<!------===========================================================------------------>
                        
                        <div class="col-sm-12">
                           {{-- <div class="d-flex justify-content-start">
                                <div class="form-check form-switch">

                                    <input id="learning_check" class="form-check-input" type="checkbox"
                                    name="learning_check" value="0" @if($learning->status == '0') checked @endif>

                                    <label class="form-check-label" for="learning_check">Hide Batch Schedule
                                    </label>

                                </div>
                            </div> --}}
                            <div class="d-flex justify-content-end">
                                <div class="form-group d-grid mb-3 text-end">
                                    <button type="submit" class="btn btn-block btn-primary">Update</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


        </div>
    </form>
</section>

<!---------------------------------- edit form --------------------------------------->

@section('component.scripts')
    <script>
        function remove_progress_bar(_this) {
            _this.closest(".progress_bar").remove();
        }

        function remove_faq(_this) {
            _this.closest(".faq").remove();
        }


        $(document).ready(function() {
            initValidate('#edit_learning_form');
            initTrumbowyg('#trumbowyg');
        });


		initTrumbowyg('.trumbowyg');


        $("#edit_learning_form").submit(function(e) {
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

        var pdfCounter = {{ $p }};

        $("#add_progress_bar").on("click", function() {
            

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
        
        pdfCounter++;

        $("#progress_bar_add_more").append(new_progress_bar);
        });

        

    </script>
@endsection