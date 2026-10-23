{{-- =====================================================================
     CHANGES SUMMARY:
     1. Added <checkbox> column in thead / tfoot
     2. Added "Select All" checkbox in the header
     3. Added "Direction Value" button beside "Add New"
     4. Added modal  (#directionValueModal) with a single text input
     5. Updated DataTable columns[] to include the checkbox column
     6. Added JS: select-all toggle, direction-value AJAX submit
     ===================================================================== --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Quiz App - Quiz Info</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/Proposed.jpg') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/preloader.css') }}" rel="stylesheet">

    <style>
        .search-highlight {
            background-color: #ffff00 !important;
            padding: 2px !important;
            border-radius: 3px !important;
            font-weight: bold !important;
            color: #000 !important;
        }

        .highlight-row {
            background-color: #ffffd0 !important;
            transition: background-color 1s !important;
        }

        .search-highlight:hover {
            background-color: #ffa500 !important;
            transition: background-color 0.3s !important;
        }

        /* ── Checkbox column ─────────────────────────────────── */
        .row-checkbox {
            width: 17px;
            height: 17px;
            cursor: pointer;
            accent-color: #012970;
        }

        .row-checkbox:disabled {
            cursor: not-allowed;
            opacity: 0.35;
        }

        #selectAllCheckbox {
            width: 17px;
            height: 17px;
            cursor: pointer;
            accent-color: #012970;
        }

        /* ── Direction Value button ──────────────────────────── */
        #directionValueBtn {
            display: none; /* hidden until ≥1 checkbox is ticked */
        }

        /* highlight selected rows */
        tr.checkbox-selected-row {
            background-color: #e8f0fe !important;
        }
    </style>
</head>

<body>
    @include('admin.navbar')
    @include('admin.sidebar')

    <div id="pre-loader" class="pre-loader is-active">
        <div class="loader"></div>
    </div>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><i class="fa fa-coins"></i>&nbsp;&#11162;&nbsp;Quizzes or Questions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/quiz_list') }}">Quizzes or Questions List</a></li>
                    <li class="breadcrumb-item active">List of Quizzes or Questions Table</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">

                @if (Session::has('error'))
                    <div class="alert-container">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <div>{{ Session::get('error') }}</div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                @if (Session::has('message'))
                    <div class="alert-container">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2"></i>
                                <div>{{ Session::get('message') }}</div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <div class="col-12">
                    @include('admin.accounts.permission', ['menu' => 'quiz_menu', 'name' => 'Quiz'])

                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Quizzes or Questions List <span>| Today</span></h5>
                                </div>
                                <div class="col-md-6">
                                    {{-- ── Action buttons (right-aligned) ── --}}
                                    <div class="d-flex justify-content-end gap-2" style="padding-top:20px; padding-right:20px;">

                                        {{-- Direction Value button — visible only when rows are selected --}}
                                        <button id="directionValueBtn"
                                                class="btn btn-sm btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#directionValueModal">
                                            <i class="ri-arrow-right-circle-line"></i>
                                            Direction Value
                                            <span id="selectedCount" class="badge bg-dark ms-1">0</span>
                                        </button>

                                        <a href="{{ url('admin/add_quiz') }}" class="btn btn-sm btn-primary btn-add">
                                            <i class="ri-add-line"></i> Add New Quizzes or Questions
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- ── DataTable ── --}}
                            <table class="table table-bordered table-hover yajra-datatable table-responsive text-center">
                                <thead>
                                    <tr>
                                        {{-- NEW: checkbox column --}}
                                        <th scope="col" style="width:40px;">
                                            <input type="checkbox" id="selectAllCheckbox" title="Select all eligible rows">
                                        </th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Question Name</th>
                                        <th scope="col">Option Count</th>
                                        <th scope="col">Option 1</th>
                                        <th scope="col">Option 2</th>
                                        <th scope="col">Option 3</th>
                                        <th scope="col">Option 4</th>
                                        <th scope="col">Option 5</th>
                                        <th scope="col">Option 6</th>
                                        <th scope="col">Answer Option</th>
                                        <th scope="col">Answer Value</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Active</th>
                                    </tr>
                                </thead>
                                <style>
                                    table.table-bordered.dataTable thead tr:first-child th,
                                    table.table-bordered.dataTable thead tr:first-child td { text-align: center; }
                                    table.table-bordered.dataTable th,
                                    table.table-bordered.dataTable td { text-align: center; }
                                    .btn_status {
                                        font-size: .70rem;
                                        font-weight: 500;
                                        letter-spacing: 1px;
                                        padding: 5px 10px;
                                        border-radius: 0.25rem;
                                        text-transform: uppercase;
                                        box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
                                    }
                                </style>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col" style="width:40px;"></th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Question Name</th>
                                        <th scope="col">Option Count</th>
                                        <th scope="col">Option 1</th>
                                        <th scope="col">Option 2</th>
                                        <th scope="col">Option 3</th>
                                        <th scope="col">Option 4</th>
                                        <th scope="col">Option 5</th>
                                        <th scope="col">Option 6</th>
                                        <th scope="col">Answer Option</th>
                                        <th scope="col">Answer Value</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Active</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer id="footer" class="footer">
            <div class="copyright"></div>
        </footer>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up-short"></i>
        </a>
    </main>

    {{-- ════════════════════════════════════════════════════════════
         DIRECTION VALUE MODAL
         Opens when the "Direction Value" button is clicked.
         Contains one text input; on submit sends selected IDs + value
         via AJAX to  POST admin/quiz_direction_value
         ════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="directionValueModal" tabindex="-1" aria-labelledby="directionValueModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header" style="background:#012970; color:#fff;">
                    <h5 class="modal-title" id="directionValueModalLabel">
                        <i class="ri-arrow-right-circle-line me-1"></i> Set Direction Value
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Info badge showing how many rows are selected --}}
                    <div class="alert alert-info py-2 mb-3" id="modalSelectedInfo">
                        <i class="bi bi-info-circle me-1"></i>
                        <span id="modalSelectedCountText">0 record(s) selected.</span>
                        <br>
                        <small class="text-muted">Only quizzes with <strong>Quiz Type&nbsp;=&nbsp;5</strong> can be selected.</small>
                    </div>

                    <div class="mb-3">
                        <label for="directionValueInput" class="form-label fw-semibold">
                            Direction Value <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="directionValueInput"
                               class="form-control"
                               placeholder="Enter direction value…"
                               autocomplete="off">
                        <div class="invalid-feedback" id="directionValueError">
                            Please enter a direction value.
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="directionValueSubmitBtn" class="btn btn-primary">
                        <i class="ri-save-line me-1"></i> Apply to Selected
                    </button>
                </div>

            </div>
        </div>
    </div>
    {{-- ── end modal ── --}}


    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>

    {{-- ── Permission alert logic (unchanged) ── --}}
    <script>
        const alertDismissed = localStorage.getItem('QuizPermissionAlertDismissed');
        const dismissTime    = localStorage.getItem('QuizPermissionAlertDismissTime');
        const now            = new Date().getTime();

        if (!alertDismissed || (dismissTime && now - dismissTime > 3600000)) {
            document.getElementById('permissionAlert') &&
                (document.getElementById('permissionAlert').style.display = 'block');
        } else {
            document.getElementById('permissionAlert') &&
                (document.getElementById('permissionAlert').style.display = 'none');
        }

        function dismissPermissionAlert(permanent = false) {
            const alert = document.getElementById('permissionAlert');
            if (alert) {
                alert.style.animation = 'fadeIn 0.4s ease-in-out reverse';
                setTimeout(() => {
                    alert.remove();
                    if (permanent) {
                        localStorage.setItem('QuizPermissionAlertDismissed', 'true');
                        localStorage.setItem('QuizPermissionAlertDismissTime', new Date().getTime());
                    }
                }, 400);
            }
        }
    </script>

    <script>
    $(document).ready(function () {

        // ── 1. DataTable init ────────────────────────────────────────────
        var table = $('.yajra-datatable').DataTable({
            processing : true,
            serverSide : true,
            stateSave  : true,
            order      : [[1, 'desc']],   // col index shifted +1 because of new checkbox col
            scrollX    : true,
            ajax       : '{{ route('quiz.list') }}',
            rowId      : 'id',
            columns    : [
                // ── NEW: checkbox column ──────────────────────────────
                {
                    data       : 'checkbox',
                    name       : 'checkbox',
                    orderable  : false,
                    searchable : false
                },
                // ── existing columns (unchanged) ──────────────────────
                { data: 'id',               name: 'id'               },
                { data: 'question_name',    name: 'question_name',    searchable: true },
                { data: 'option_count',     name: 'option_count',     searchable: true },
                { data: 'option_1',         name: 'option_1',         searchable: true },
                { data: 'option_2',         name: 'option_2',         searchable: true },
                { data: 'option_3',         name: 'option_3',         searchable: true },
                { data: 'option_4',         name: 'option_4',         searchable: true },
                { data: 'option_5',         name: 'option_5',         searchable: true },
                { data: 'option_6',         name: 'option_6',         searchable: true },
                { data: 'quiz_answer',      name: 'quiz_answer',      searchable: true },
                { data: 'quiz_answer_value',name: 'quiz_answer_value',searchable: true },
                { data: 'category.name',    name: 'category.name',    searchable: true },
                { data: 'created_at',       name: 'created_at'       },
                { data: 'status',           name: 'status'           },
                { data: 'action',           name: 'action',           orderable: false },
                { data: 'status_update',    name: 'is_active'        }
            ],
            language: {
                paginate: { previous: '<<', next: '>>' }
            },
            drawCallback: function (settings) {
                // ── search highlight ──────────────────────────────────
                var searchTerm = table.search();
                if (searchTerm && searchTerm.trim() !== '') {
                    $('.yajra-datatable tbody tr td:not(:has(form)):not(:first-child)').each(function () {
                        var $cell = $(this);
                        if ($cell.find('button, input').length === 0) {
                            $cell.html(highlightSearchTerm($cell.html(), searchTerm));
                        }
                    });
                }

                // ── re-apply checked state for rows that are still selected ──
                updateCheckboxStates();

                // ── hash-based row scroll (unchanged) ────────────────
                if (window.location.hash) {
                    var rowId    = window.location.hash.substring(1);
                    var targetRow = $('div[id="' + rowId + '"]').closest('tr');
                    if (targetRow.length) {
                        setTimeout(function () {
                            $('html, body').animate({ scrollTop: targetRow.offset().top - 100 }, 500);
                            targetRow.addClass('highlight-row');
                            setTimeout(function () { targetRow.removeClass('highlight-row'); }, 3000);
                        }, 200);
                    }
                }
            }
        });


        // ── 2. Checkbox selection logic ──────────────────────────────────

        /**
         * selectedIds  — Set of quiz IDs currently ticked (persists across pages)
         */
        var selectedIds = new Set();

        /** Sync DOM checkboxes to selectedIds and refresh the counter badge */
        function updateCheckboxStates() {
            $('.row-checkbox').each(function () {
                var id = $(this).val();
                if (!$(this).prop('disabled')) {
                    $(this).prop('checked', selectedIds.has(id));
                    $(this).closest('tr').toggleClass('checkbox-selected-row', selectedIds.has(id));
                }
            });
            refreshSelectionUI();
        }

        /** Show/hide the Direction Value button and update counters */
        function refreshSelectionUI() {
            var count = selectedIds.size;
            $('#selectedCount').text(count);
            $('#directionValueBtn').toggle(count > 0);
            $('#modalSelectedCountText').text(count + ' record(s) selected.');

            // Select-all checkbox indeterminate state
            var enabledBoxes  = $('.row-checkbox:not(:disabled)');
            var checkedBoxes  = $('.row-checkbox:not(:disabled):checked');
            var allChecked    = enabledBoxes.length > 0 && enabledBoxes.length === checkedBoxes.length;
            $('#selectAllCheckbox')
                .prop('indeterminate', checkedBoxes.length > 0 && !allChecked)
                .prop('checked', allChecked);
        }

        // Individual checkbox click
        $(document).on('change', '.row-checkbox', function () {
            var id = $(this).val();
            if ($(this).is(':checked')) {
                selectedIds.add(id);
                $(this).closest('tr').addClass('checkbox-selected-row');
            } else {
                selectedIds.delete(id);
                $(this).closest('tr').removeClass('checkbox-selected-row');
            }
            refreshSelectionUI();
        });

        // Select-all (only enabled/eligible checkboxes on the current page)
        $('#selectAllCheckbox').on('change', function () {
            var checked = $(this).is(':checked');
            $('.row-checkbox:not(:disabled)').each(function () {
                $(this).prop('checked', checked);
                var id = $(this).val();
                if (checked) {
                    selectedIds.add(id);
                    $(this).closest('tr').addClass('checkbox-selected-row');
                } else {
                    selectedIds.delete(id);
                    $(this).closest('tr').removeClass('checkbox-selected-row');
                }
            });
            refreshSelectionUI();
        });


        // ── 3. Direction Value modal submit ──────────────────────────────

        $('#directionValueModal').on('show.bs.modal', function () {
            // Reset input & error on open
            $('#directionValueInput').val('').removeClass('is-invalid');
            $('#directionValueError').hide();
            $('#modalSelectedCountText').text(selectedIds.size + ' record(s) selected.');
        });

        $('#directionValueSubmitBtn').on('click', function () {
            var value = $('#directionValueInput').val().trim();

            // Client-side validation
            if (!value) {
                $('#directionValueInput').addClass('is-invalid');
                return;
            }
            $('#directionValueInput').removeClass('is-invalid');

            var $btn = $(this);
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving…');

            // AJAX call to the new backend route
            $.ajax({
                url   : '{{ url('admin/quiz_direction_value') }}',
                method: 'POST',
                data  : {
                    _token         : '{{ csrf_token() }}',
                    quiz_ids       : Array.from(selectedIds),
                    direction_value: value
                },
                success: function (res) {
                    $('#directionValueModal').modal('hide');

                    if (res.success) {
                        toastr.success(res.message || 'Direction value updated successfully!');
                        selectedIds.clear();          // clear selection
                        refreshSelectionUI();
                        table.ajax.reload(null, false); // reload table, keep page
                    } else {
                        toastr.error(res.message || 'Something went wrong.');
                    }
                },
                error: function (xhr) {
                    $('#directionValueModal').modal('hide');
                    toastr.error('Server error: ' + (xhr.responseJSON?.message ?? xhr.statusText));
                },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="ri-save-line me-1"></i> Apply to Selected');
                }
            });
        });


        // ── 4. Search highlight helper (unchanged) ───────────────────────
        function highlightSearchTerm(text, searchTerm) {
            if (!searchTerm || searchTerm.trim() === '') return text;

            if (typeof text === 'string' && text.indexOf('<') > -1) {
                var matches = [];
                var textOnly = text.replace(/<[^>]*>/g, function (match) {
                    matches.push(match);
                    return '\u0001';
                });
                var re = new RegExp('(' + searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi');
                textOnly = textOnly.replace(re, '<span class="search-highlight">$1</span>');
                return textOnly.replace(/\u0001/g, function () { return matches.shift(); });
            } else {
                var re = new RegExp('(' + searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi');
                return text.replace(re, '<span class="search-highlight">$1</span>');
            }
        }

        $('.dataTables_filter input').on('keyup', function () { table.draw(); });

        setTimeout(function () {
            if (window.location.hash) {
                history.replaceState(null, null, window.location.pathname + window.location.search);
            }
        }, 4000);


        // ── 5. Preloader (unchanged) ─────────────────────────────────────
        window.onload = function () {
            const preloader = document.getElementById('pre-loader');
            let opacity = 1;
            const fade = setInterval(() => {
                if (opacity > 0) {
                    opacity -= 0.1;
                    preloader.style.opacity = opacity;
                } else {
                    clearInterval(fade);
                    preloader.classList.remove('is-active');
                    preloader.classList.add('active-is');
                }
            }, 100);
        };
    });


    // ── 6. Delete confirmation (unchanged) ───────────────────────────────
    function validateform(val) {
        Swal.fire({
            title: 'Confirmation',
            text: 'Are you sure you want to delete?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#form_submit_' + val).submit();
            }
        });
    }
    </script>

</body>
</html>