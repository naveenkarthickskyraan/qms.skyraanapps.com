<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Quiz App - Info </title>
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
    {{-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet"> --}}
    {{-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> --}}



    {{-- <!-- Templat{{ asset('e Main CSS File --> --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>/* Custom toastr styles */
        #toast-container > div {
            background-color: #fff; /* White background */
            color: #333; /* Dark text color */
            border-radius: 8px; /* Rounded corners */
            padding: 15px; /* Custom padding */
            font-size: 16px; /* Custom font size */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            font-weight: bold; /* Bold text */
            position: relative; /* For positioning elements inside */
            animation: shake 0.5s ease-in-out; /* Shake animation */
            opacity: 1 !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 350px;
            max-width: 600px;
        }

        /* Success Toast */
        #toast-container .toast-success {
            border-left: 5px solid #28a745; /* Green left border */
            color: #012970;
        }

        /* Error Toast */
        #toast-container .toast-error {
            border-left: 5px solid #d10101; /* Red left border */
            color: #d10101;
        }

        /* Warning Toast */
        #toast-container .toast-warning {
            border-left: 5px solid #ff9800; /* Orange left border */
            color: #ff9800;
        }

        /* Info Toast */
        #toast-container .toast-info {
            border-left: 5px solid #17a2b8; /* Blue left border */
            color: #17a2b8;
        }

        /* Toastr close button customization */
        #toast-container > div .toast-close-button {
            color: #333; /* Custom close button color */
            font-size: 16px;
            position: absolute;
            right: 10px;
            top: 10px;
        }

        /* Toastr icon positioning */
        .toast-message {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        /* Custom toast icon styles */
        /* Add Font Awesome icon before the toast message */
        .toast-message::before {
            font-family: "Font Awesome 5 Free"; /* Ensure Font Awesome loads */
            font-weight: 900;
            content: "\f0f3"; /* Font Awesome bell icon */
            font-size: 20px;
            margin-right: 10px;
        }

        /* Toastr close button customization */
        #toast-container > div .toast-close-button {
            color: #333; /* Custom close button color */
            font-size: 16px;
            position: absolute;
            right: 10px;
            top: 10px;
        }


        /* Shake animation */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

    </style>
    <link href="{{ asset('assets/css/preloader.css') }}" rel="stylesheet">
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
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/prayers_list') }}">Font List</a></li>
                    <li class="breadcrumb-item active">List of Font Table</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Font List <span>| Today</span></h5>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <div class="action-btn" align="right" style="padding-top:20px;padding-right:20px;">
                                        <a href="{{ url('admin/add_prayers') }}"
                                            class="btn btn-sm btn-primary btn-add">
                                            <i class="ri-add-line"></i> Add New Font</a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover yajra-datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Font Name </th>
                                        <th scope="col">Font File</th>
                                        <th scope="col">Language Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Active</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <style>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- End Recent Sales -->
            </div>
        </section>

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

    <!-- category Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: "{{ route('admin.question') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'font_name',
                        name: 'font_name'
                    },
                    {
                        data: 'font_file',
                        name: 'font_file'
                    },
                    {
                        data: 'language_code',
                        name: 'language_code'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'active',
                        name: 'active',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [[0, 'desc']]
            });
        });

        function copyToClipboard(button) {
            var url = button.getAttribute('data-url');
            navigator.clipboard.writeText(url).then(function() {
                // Show success message
                let originalText = button.innerHTML;
                button.innerHTML = '<i class="fa fa-check"></i> Copied!';
                button.classList.remove('btn-secondary');
                button.classList.add('btn-success');

                // Reset button after 2 seconds
                setTimeout(function() {
                    button.innerHTML = '<i class="fa fa-copy"></i> Copy URL';
                    button.classList.remove('btn-success');
                    button.classList.add('btn-secondary');
                }, 2000);
            }).catch(function(error) {
                console.error('Failed to copy:', error);
            });
        }
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @elseif (Session::has('message'))
                toastr.success("{{ Session::get('message') }}");
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#members_list').DataTable();
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
