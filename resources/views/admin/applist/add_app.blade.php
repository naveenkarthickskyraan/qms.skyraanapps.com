<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Quiz App - Add App Info</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
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
    {{-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet"> --}}
    {{-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> --}}



    {{-- <!-- Templat{{ asset('e Main CSS File --> --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/preloader.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('admin.navbar')
    <!-- ======= Sidebar ======= -->
    @include('admin.sidebar')
    <div id="pre-loader" class="pre-loader is-active">
        <div class="loader">
        </div>
    </div>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>App Info Batch List (Add Form)</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/app_list') }}">App Info Batch List</a></li>
                    <li class="breadcrumb-item active">List of App Info Batch Table</li>
                </ol>
            </nav>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li> <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                @endforeach
            </div>
        @endif

        {{-- <div class="alert-container"></div> --}}

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card" style="background-color: #fff;">
                    <div class="card-body">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0" style="color: #012970 !important;"><i class="fas fa-folder-tree me-2"></i>App List Form</h4>
                        </div>

                        <hr class="text-dark">
                        <div class="container pt-2">
                            <div class="form-group row mb-3">
                                <label for="app_name" class="col-sm-12 col-form-label h2 text-dark"
                                    style="padding-left: 10px">App Name <span style="color:red;">&nbsp;*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="app_name" name="app_name"
                                        placeholder="Enter a app name" value="{{ $_GET['app_name'] ?? '' }}" {{ isset($_GET['app_name']) && $_GET['app_name'] ? 'disabled' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="container pt-2">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="alert alert-warning mt-3 d-flex align-items-center" role="alert">
                                        <i class="fas fa-info-circle me-2"></i> <!-- Info icon -->
                                        <div>
                                            <strong>Note:</strong> Each selected tree must have its own starting point. First select a tree, then specify its starting point, then select the next tree.
                                        </div>
                                    </div>

                                    <div class="mb-3 d-flex justify-content-between">
                                        <div>
                                            <button id="resetSelectionBtn" class="btn btn-sm btn-outline-secondary me-2">Reset Selection</button>
                                            <button id="addToBatchBtn" class="btn btn-sm btn-outline-primary" disabled>Add to Batch</button>
                                            <span id="selectedCount" class="selected-count">0 selected</span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <input type="text" id="searchInput" class="form-control" placeholder="Search subcategories...">
                                        </div>
                                    </div>

                                    <div class="alert alert-info mb-3 d-flex align-items-center selection-status" role="alert">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div id="selection-status">
                                            Please select a tree first.
                                        </div>
                                    </div>

                                    <div id="tree-container" class="tree-container"></div>
                                </div>

                                <div class="col-md-4">
                                    <div class="alert alert-info mt-3">
                                        <h5><i class="fas fa-clipboard-list me-2"></i>Selection Details</h5>
                                        <div id="current-selection">No selection in progress</div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card mt-3">
                                            <div class="card-header bg-primary text-white">
                                                <i class="fas fa-layer-group me-2"></i>Batch Queue
                                            </div>
                                            <div class="card-body p-2" id="batch-list">
                                                <div class="text-center py-3 text-muted">No items in batch</div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="d-flex justify-content-between">
                                                    <span class="badge bg-secondary" id="batch-count">0 items</span>
                                                    <button id="saveBatchBtn" class="btn btn-sm btn-success" disabled>
                                                        <i class="fas fa-save me-1"></i> Save Batch
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mt-3">
                                            <div class="card-header bg-info text-white">
                                                <i class="fas fa-database me-2"></i>Saved Batches
                                            </div>
                                            <div class="card-body p-2" id="saved-batches-container">
                                                <div class="text-center py-3 text-muted">Loading saved batches...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
        </div>
        <!-- <div class="credits"> -->
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div> -->
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        $('#loading').hide();
        $('#susubmitbmit').on('click', function() {
            $('#loading').show();
            $('#susubmitbmit').hide();
        });
        // JavaScript for Preloader
        document.addEventListener("DOMContentLoaded", function() {
            const preloader = document.getElementById('pre-loader');

            // Wait until the entire page is loaded
            window.onload = function() {
                // Add fade-out effect
                let opacity = 1; // Start fully visible
                const fadeOutEffect = setInterval(() => {
                    if (opacity > 0) {
                        opacity -= 0.1; // Decrease opacity
                        preloader.style.opacity = opacity;
                    } else {
                        clearInterval(fadeOutEffect); // Stop interval when fully transparent
                        preloader.classList.remove('is-active');
                        preloader.classList.add('active-is'); // Optional to ensure hidden state
                    }
                }, 100); // Adjust interval for smoother fade
            };
        });
    </script>

</body>

</html>

{{-- @else --}}
{{-- abort(403, 'Unauthorized action.'); --}}
{{-- @endif --}}
