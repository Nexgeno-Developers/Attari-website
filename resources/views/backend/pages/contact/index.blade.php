@extends('backend.layouts.app')

@section('page.name', 'contact')

@section('page.content')

@include('backend.pages.contact.manage_email')

<style>
    .contact-filter-panel {
        border: 1px solid #eef2f7;
        border-radius: 12px;
        padding: 18px;
        margin-bottom: 22px;
        background: #fbfcfe;
    }

    .contact-filter-panel label {
        font-weight: 600;
        margin-bottom: 6px;
        color: #4f5d75;
    }

    .contact-filter-panel .form-control,
    .contact-filter-panel .select2-container .select2-selection--single {
        min-height: 42px;
    }

    .contact-filter-panel .select2-container {
        width: 100% !important;
        display: block;
    }

    .contact-filter-panel .select2-container--default .select2-selection--single {
        border: 1px solid #d9e2ec;
        border-radius: 0.375rem;
        display: flex;
        align-items: center;
    }

    .contact-filter-panel .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px;
        padding-left: 12px;
        padding-right: 28px;
    }

    .contact-filter-panel .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
        right: 8px;
    }

    .contact-filter-panel .select2-dropdown {
        border-color: #d9e2ec;
    }

    .contact-filter-panel .select2-search--dropdown {
        padding: 8px;
    }

    .contact-filter-panel .select2-search--dropdown .select2-search__field {
        border: 1px solid #d9e2ec;
        border-radius: 0.375rem;
        height: 38px;
        padding: 8px 12px;
    }

    .contact-filter-panel .select2-results__options {
        max-height: 240px;
    }

    .contact-filter-actions {
        display: flex;
        align-items: end;
        justify-content: flex-end;
        gap: 12px;
        height: 100%;
    }

    .contact-filter-actions .btn {
        min-width: 110px;
    }

    .contact-filter-actions .btn-reset {
        min-width: 46px;
        padding-left: 0;
        padding-right: 0;
    }

    .leads-contact1 .justify-content-sm-between {
        display: block !important;
    }

    .leads-contact1 .mt-4 {
        margin-top: 15px !important;
    }

    .leads-contact1 .col-md-8 ul {
        float: right !important;
    }

    .leads-contact1 .col-md-8 ul a.page-link {
        border-radius: 100px;
        margin-right: 4px;
        text-align: center;
    }

    .leads-contact1 .col-md-8 ul span {
        border-radius: 100px;
        margin-right: 4px;
        text-align: center;
    }

    @media(max-width:767px) {
        body .leads-contact1 .justify-content-sm-between {
            display: none !important;
        }

        .leads-contact1 .justify-content-sm-between {
            display: flex !important;
        }

        .contact-filter-panel {
            padding: 14px;
        }

        .contact-filter-actions {
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .contact-filter-actions .btn {
            min-width: unset;
        }
    }
</style>

<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ url(route('contact.index')) }}">
            <div class="contact-filter-panel">
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-6 col-xl-3">
                        <label>Universal Search</label>
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Name, email, phone, page URL, source URL..."
                        >
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <label>Course</label>
                        <select name="course" class="form-control contact-filter-select">
                            <option value="">-- Select --</option>
                            @foreach($uniqueCourses as $alias)
                                <option value="{{ $alias }}" @if(request('course') == $alias) selected @endif>{{ ucwords(strtolower($alias)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <label>Source</label>
                        <select name="source" class="form-control contact-filter-select">
                            <option value="">-- Select --</option>
                            @foreach($sources as $source)
                                <option value="{{ $source }}" @if(request('source') == $source) selected @endif>{{ ucwords(strtolower($source)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <label>Medium</label>
                        <select name="medium" class="form-control contact-filter-select">
                            <option value="">-- Select --</option>
                            @foreach($media as $medium)
                                <option value="{{ $medium }}" @if(request('medium') == $medium) selected @endif>{{ ucwords(strtolower($medium)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <label>Search term</label>
                        <select name="utm_term" class="form-control contact-filter-select">
                            <option value="">-- Select --</option>
                            @foreach($utmTerms as $utmTerm)
                                <option value="{{ $utmTerm }}" @if(request('utm_term') == $utmTerm) selected @endif>{{ $utmTerm }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <label>Records</label>
                        <select name="per_page" class="form-control contact-filter-select">
                            @foreach([10, 25, 50, 100, 250, 500, 1000] as $size)
                                <option value="{{ $size }}" @if((int) request('per_page', $perPage) === $size) selected @endif>{{ $size }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <label>From</label>
                        <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <label>To</label>
                        <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="contact-filter-actions">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ url(route('contact.export', request()->query())) }}" class="text-center btn btn-success">Export CSV</a>
                            <a href="{{ url(route('contact.index')) }}" class="text-center btn btn-danger btn-reset" title="Reset"><i class="mdi mdi-reload"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table id="basic-datatable-with-laravel-pagination" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Course</th>
                        <th>Medium</th>
                        <th>Source</th>
                        <th>Search term</th>
                        <th>Page</th>
                        <th>Section</th>
                        <th>gad_campaignid</th>
                        <th>gclid</th>
                        <th>Country Code</th>
                        <th>Country Phone</th>
                        <th>Syllabus Status</th>
                        <th>Email Status</th>
                        <th>IP</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $start = ($contacts->currentPage() - 1) * $contacts->perPage() + 1;
                    @endphp
                    @foreach($contacts as $row)
                    <tr>
                        <td>{{ $start++ }}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->phone}}</td>
                        <td>{{$row->services}}</td>
                        <td>{{ $row->medium ?: '-' }}</td>
                        <td>{{ $row->source ?: '-' }}</td>
                        <td>{{ $row->utm_term ?: '-' }}</td>
                        <td>
                            <a target="_blank" href="{{$row->url}}">
                                {{$row->url}}
                            </a>
                        </td>
                        <td>{{$row->section}}</td>
                        <td>{{ $row->gad_campaign_id ?: '-' }}</td>
                        <td>{{ $row->gclid ?: '-' }}</td>
                        <td>{{$row->w_countrycode}}</td>
                        <td>{{$row->w_phone}}</td>
                        <td>
                            @if ($row->w_syllabus == '1')
                            <span class="badge bg-success">SENT</span>
                            @else
                            <span class="badge bg-danger">FAILED</span>
                            @endif
                        </td>
                        <td>
                            @if ($row->email_sent == 1)
                            <span class="badge bg-success">SENT</span>
                            @else
                            <span class="badge bg-danger">PENDING</span>
                            @endif
                        </td>
                        <td>{{ $row->ip ?: '-' }}</td>
                        <td>{{ optional($row->created_at)->format('d M Y h:iA') }}</td>
                        <td>
                            <a href="javascript:void(0);" class="action-icon" onclick="largeModal('{{ url(route('contact.view',['id' => $row->id])) }}', 'View')"> <i class="mdi mdi-account-eye"></i></a>
                            {{--<a href="javascript:void(0);" class="action-icon" onclick="confirmModal('{{ url(route('contact.delete', $row->id)) }}', responseHandler)"><i class="mdi mdi-delete"></i></a>--}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination links -->
        <div class="leads-contact1">
            {{-- $contacts->links('pagination.custom') --}}
            {{ $contacts->appends(request()->query())->links('pagination.custom') }}
        </div>
    </div>
    <!-- end card-body-->
</div>
@endsection

@section("page.scripts")
<script>
    var responseHandler = function(response) {
        location.reload();
    };

    $(document).ready(function () {
        $('.contact-filter-select').each(function () {
            const $select = $(this);
            const $panel = $select.closest('.contact-filter-panel');

            if ($select.hasClass('select2-hidden-accessible')) {
                $select.select2('destroy');
            }

            $select.select2({
                width: '100%',
                dropdownParent: $panel,
                minimumResultsForSearch: 0
            });
        });
    });
</script>
@endsection
