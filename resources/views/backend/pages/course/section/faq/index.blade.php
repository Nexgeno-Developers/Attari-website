<!-----==================== Text Review Course ==========----------------------->
<div class="card">
    <div class="card-body">
        <div class="col-md-12">
            <h4 class="header-title"><b>FAQs</b></h4>
            <hr>
        </div>

        <!--============== Text Review ==============---------->
        @include('backend.pages.course.section.faq.add')
        <!--============== Text Review ==============---------->

    </div>
    <!-- end card-body-->
</div>
<!---==================================== text review table ==============------------------->
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="faq-zone-filter" class="form-label">Filter By Zone</label>
                <select class="form-select" id="faq-zone-filter">
                    <option value="" selected>All</option>
                    <option value="0">Main</option>
                    <option value="1">City/Country</option>
                </select>
            </div>
        </div>
        <div class="table-responsive">
            <table id="basic-datatable" class="table dt-responsive nowrap1 w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Status</th>
                        <th>Zone</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="faq-table-body">
                    @include('backend.pages.course.section.faq._rows', ['faqs' => $course->faqs ?? collect()])
                </tbody>
            </table>
        </div>
        <!-- end card-body-->
    </div>
</div>
    <!---==================================== text review table ==============------------------->

@section('component.scripts')
    @parent
    <script>
        window.courseFaqSection = (function() {
            const selectors = {
                filter: '#faq-zone-filter',
                table: '#basic-datatable',
                smallModal: '#smallModal'
            };

            const routeList = @json(url(route('faq.list', ['course' => $course->id])));
            let dataTableInstance = null;

            function getCurrentFilter() {
                return $(selectors.filter).val();
            }

            function getDataTable() {
                if (dataTableInstance) {
                    return dataTableInstance;
                }

                if ($.fn.DataTable.isDataTable(selectors.table)) {
                    dataTableInstance = $(selectors.table).DataTable();
                }

                return dataTableInstance;
            }

            function buildRowsFromHtml(html) {
                const rows = $.parseHTML($.trim(html), document, true) || [];
                return $(rows).filter('tr');
            }

            function replaceTableRows(html, resetPaging = false) {
                const dataTable = getDataTable();
                const rows = buildRowsFromHtml(html);

                if (!dataTable) {
                    $('#faq-table-body').html(html);
                    return;
                }

                dataTable.clear();

                if (rows.length) {
                    dataTable.rows.add(rows);
                } else {
                    dataTable.rows.add($('<tr class="js-faq-empty-row"><td colspan="7" class="text-center">No FAQs found.</td></tr>'));
                }

                dataTable.draw(resetPaging);
            }

            function refreshList(resetPaging = true) {
                $.ajax({
                    url: routeList,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        zone: getCurrentFilter()
                    },
                    success: function(response) {
                        if (response.status) {
                            replaceTableRows(response.html, resetPaging);
                        }
                    }
                });
            }

            function toggleStatus(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            Command: toastr["success"](response.notification, "Success");
                            refreshList(false);
                        }
                    },
                    error: function() {
                        Command: toastr["error"]('Unable to update status.', "Alert");
                    }
                });
            }

            function openEdit(url) {
                smallModal(url, 'Edit Faq');
            }

            function confirmDelete(url) {
                confirmModal(url, function(response) {
                    if (response.deleted_id) {
                        closeConfirmModel();
                        refreshList(false);
                    }
                });
            }

            function onCreated() {
                refreshList(true);
            }

            function onUpdated() {
                refreshList(false);
                $(selectors.smallModal).modal('hide');
            }

            return {
                onCreated,
                onUpdated,
                refreshList,
                toggleStatus,
                openEdit,
                confirmDelete
            };
        })();

        $(document).ready(function() {
            initValidate('#add_faq_form');
            initValidate('#updating_heading_form');
            initTrumbowyg('.trumbowyg');

            $('#faq-zone-filter').on('change', function() {
                window.courseFaqSection.refreshList(true);
            });

            $("#add_faq_form").on('submit', function(e) {
                var form = $(this);
                ajaxSubmit(e, form, function() {
                    window.courseFaqSection.onCreated();

                    const formElement = $('#add_faq_form')[0];
                    if (formElement) {
                        formElement.reset();
                    }

                    $('#add_faq_form textarea[name="answer"]').trumbowyg('empty');
                });
            });

            $("#updating_heading_form").on('submit', function(e) {
                var form = $(this);
                ajaxSubmit(e, form, function() {
                    location.reload();
                });
            });
        });

        function courseFaqToggleStatus(url) {
            window.courseFaqSection.toggleStatus(url);
        }

        function courseFaqOpenEdit(url) {
            window.courseFaqSection.openEdit(url);
        }

        function courseFaqConfirmDelete(url) {
            window.courseFaqSection.confirmDelete(url);
        }
    </script>
@endsection
