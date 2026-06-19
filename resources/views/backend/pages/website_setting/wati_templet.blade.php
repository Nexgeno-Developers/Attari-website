@extends('backend.layouts.app')

@section('page.name', 'WATI Templet Setting')

@section('page.content')
<div class="card">
    <div class="card-body">
        <form id="wati-template-form" action="{{ route('website_setting.wati_templet.update') }}" method="post">
            @csrf
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <div>
                    <h4 class="mb-1">WATI Templet Configuration</h4>
                    <p class="text-muted mb-0">Manage local and international WATI template names course-wise.</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="enable-editing">
                    <label class="form-check-label" for="enable-editing">Enable Editing</label>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="min-width: 220px;">Course</th>
                            <th style="min-width: 260px;">WATI Local</th>
                            <th style="min-width: 260px;">WATI International</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            @php
                                $template = $templates->get($course->id);
                                $config = is_array(optional($template)->config) ? $template->config : [];
                                $courseTitle = $course->menu_title ?: $course->name;
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ $courseTitle }}</strong>
                                    <input type="hidden" name="course_ids[]" value="{{ $course->id }}">
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        class="form-control wati-input"
                                        name="local[{{ $course->id }}]"
                                        value="{{ $config['local'] ?? '' }}"
                                        placeholder="Enter local template name"
                                        disabled
                                    >
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        class="form-control wati-input"
                                        name="international[{{ $course->id }}]"
                                        value="{{ $config['international'] ?? '' }}"
                                        placeholder="Enter international template name"
                                        disabled
                                    >
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary wati-submit" disabled>Update All</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('page.scripts')
<script>
    $(document).ready(function() {
        initValidate('#wati-template-form');

        $('#wati-template-form').on('submit', function(e) {
            ajaxSubmit(e, $(this), responseHandler);
        });

        $('#enable-editing').on('change', function() {
            const isEnabled = $(this).is(':checked');
            $('.wati-input, .wati-submit').prop('disabled', !isEnabled);
        });
    });

    var responseHandler = function(response) {
        location.reload();
    }
</script>
@endsection
