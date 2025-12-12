<!-----==================== Batch schedule Course ==========----------------------->
@php
    $seo_additional = DB::table('courses')
        ->select('id', 'seo_label', 'seo_description')
        ->where('id', $course->id) // Assuming the column is 'id' not 'course_id'
        ->first();
@endphp
<div class="card">
    <div class="card-body">
        <div class="col-md-12">
            <h4 class="header-title"><b>Additional SEO</b></h4>
            <hr>
        </div>


        <!---------------------------------- edit form --------------------------------------->

        <section>
            <form id="seo_form" action="{{ url(route('course.seo_update')) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">

                                <input type="hidden" class="form-control" name="id"
                                    value="{{ $seo_additional->id }}">


                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        {{-- <label>Title<span class="red">*</span></label> --}}
                                        <label>Title</label>
                                        <input maxlength="255" type="text" class="form-control" name="title"
                                            value="{{ $seo_additional->seo_label }}">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        {{-- <label>Description <span class="red">*</span></label> --}}
                                        <label>Description</label>
                                        <textarea class="form-control trumbowyg" name="description" rows="4" placeholder="Enter description here...">{{ $seo_additional->seo_description }}</textarea>
                                    </div>
                                </div>


                            </div>

                            <!-------==========================================================-------------------->


                            <div class="form-group d-grid mb-3 text-end">
                                <button type="submit" class="btn btn-block btn-primary">Update</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </section>

    </div>
</div>

@section('component.scripts')
    <script>
        $(document).ready(function() {
            initValidate('#seo_form');
        });

        initTrumbowyg('.trumbowyg');

        $("#seo_form").submit(function(e) {
            var form = $(this);
            ajaxSubmit(e, form, responseHandler);
        });

        var responseHandler = function(response) {
            location.reload();
        };
    </script>
@endsection
