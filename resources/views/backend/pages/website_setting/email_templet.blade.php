@extends('backend.layouts.app')

@section('page.name', 'Email Templet Setting')

@section('page.content')
<div class="col-12">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="col-xl-4">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-1">Email Templet Generator</h4>
            <p class="text-muted mb-4">Select course and type, upload or replace the main banner and YouTube thumbnail, then generate the rendered Blade email preview.</p>

            <form id="email-template-form" action="{{ route('website_setting.email_templet.generate') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 form-group">
                    <label class="form-label">Course *</label>
                    <select class="form-select select2" name="course_id" required>
                        <option value="">Select course</option>
                        @foreach($courses as $course)
                            <option
                                value="{{ $course->course_id }}"
                                data-menu-title="{{ $course->menu_title }}"
                                data-breadcrumb-title="{{ $course->breadcrumb_title }}"
                                {{ (string) old('course_id', $selectedCourseId) === (string) $course->course_id ? 'selected' : '' }}
                            >
                                {{ $course->menu_title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 form-group">
                    <label class="form-label">Type *</label>
                    <select class="form-select" name="type" required>
                        <option value="">Select type</option>
                        <option value="local" {{ old('type', $selectedType) === 'local' ? 'selected' : '' }}>Local</option>
                        <option value="international" {{ old('type', $selectedType) === 'international' ? 'selected' : '' }}>International</option>
                    </select>
                </div>

                <div class="mb-3 form-group">
                    <label class="form-label">Visit Website URL *</label>
                    <input type="url" class="form-control" name="website_url" value="{{ old('website_url', $selectedWebsiteUrl ?? '') }}" placeholder="https://attariclasses.in/..." required>
                </div>

                <div class="mb-3 form-group">
                    <label class="form-label">Main Image Upload *</label>
                    <input type="file" class="form-control" name="image" accept="image/*" required>
                    <small class="text-muted">New upload replaces the old image for the selected course and type.</small>
                </div>

                <div class="mb-3 form-group">
                    <label class="form-label">YouTube Image Upload *</label>
                    <input type="file" class="form-control" name="youtube_image" accept="image/*" required>
                    <small class="text-muted">New upload replaces the old YouTube thumbnail for the selected course and type.</small>
                </div>

                <div class="mb-3 form-group">
                    <label class="form-label">YouTube URL *</label>
                    <input type="url" class="form-control" name="youtube_url" value="{{ old('youtube_url', $selectedYoutubeUrl ?? '') }}" placeholder="https://www.youtube.com/watch?v=..." required>
                </div>

                <div class="border rounded p-3 bg-light mb-3 d-none">
                    <div class="fw-semibold mb-2">Selected Course Data</div>
                    <div class="small text-muted">Course</div>
                    <div id="selected-menu-title" class="mb-2">-</div>
                    <div class="small text-muted">Title</div>
                    <div id="selected-breadcrumb-title">-</div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-xl-8">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="mb-1">Preview</h4>
                    <p class="text-muted mb-0">Rendered Blade output for the selected course and type.</p>
                </div>
            </div>

            @if(!empty($previewHtml))
                <iframe
                    id="email-template-preview-frame"
                    title="Email Template Preview"
                    style="width:100%; min-height:1100px; border:1px solid #dee2e6; border-radius:8px; background:#fff;"
                ></iframe>
            @else
                <div class="border rounded p-5 text-center text-muted">
                    Generate a template to preview it here.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('page.scripts')
<script>
    $(document).ready(function() {
        initValidate('#email-template-form');
        initSelect2('.select2');

        const syncSelectedCourseData = function () {
            const selectedOption = $('select[name="course_id"] option:selected');
            $('#selected-menu-title').text(selectedOption.data('menu-title') || '-');
            $('#selected-breadcrumb-title').text(selectedOption.data('breadcrumb-title') || '-');
        };

        $('select[name="course_id"]').on('change', syncSelectedCourseData);
        syncSelectedCourseData();

        const previewFrame = document.getElementById('email-template-preview-frame');
        if (previewFrame) {
            previewFrame.srcdoc = @json($previewHtml);
        }
    });
</script>
@endsection