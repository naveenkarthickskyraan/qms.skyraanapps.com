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
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/dual-listbox@1.0.9/dist/dual-listbox.css" rel="stylesheet" />
    <style>
        /* Styling for the dual-listbox container */
        .dual-listbox {
            display: flex;
            justify-content: space-between;
            /* align-items: center; */
            padding: 10px;

        }

        .dd {
            float: right;
        }

        .dual-listbox__title {
            font-size: 18px !important;
            font-weight: bold !important;
            margin-bottom: 10px !important;
            /* Adjust as needed */
            color: #333 !important;
            /* Set your desired text color */
        }

        /* Styling for the available options list */
        .available-options select {
            width: 100%;
            height: 200px;
            /* Set a specific height or adjust as needed */
        }

        /* Styling for the controls (Add and Remove buttons) */
        .dual-listbox__buttons button:hover {
            /* margin: 5px !important; */
            /* padding: 5px 10px !important; */
            background-color: #007bff !important;
            color: #fff !important;
            /* border: none !important; */
            cursor: pointer !important;
        }

        .dual-listbox__buttons button {
            /* margin: 5px !important; */
            /* padding: 5px 10px !important; */
            background-color: #c3e0f1 !important;
            color: #fff !important;
            /* border: none !important; */
            cursor: pointer !important;
        }

        /* Highlight selected options */
        .dual-listbox__selected li:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/Proposed.jpg') }}" />
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
                    <li class="breadcrumb-item"><a href="{{ url('admin/app_list') }}">App List</a></li>
                    <li class="breadcrumb-item active">List of App Table</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card ff">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.mapping_cat', $edit->id) }}">
                            @csrf
                            <section class="section card-body text-dark">
                                <h4 class="card-title text-dark">Select by List of Font With Language</h4>
                                <hr class="text-dark">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="card-header h5 text-dark" style="padding-right: 40px">Total Available
                                            Fonts : {{ count($category_list) }}</h4>
                                    </div>
                                    <div class="col-md-4" style="padding-right: 50px">
                                        <h4 class="card-header h5 text-dark">Total selected Fonts
                                            :{{ count($mapped_app) }}</h4>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <select class="select1" multiple="multiple" name="countries[]">
                                        @foreach ($category_list as $row)
                                            @if (in_array($row->id, $mapped_app))
                                                <option value="{{ $row->id }}" selected="selected">
                                                    {{ $row->font_name }} - {{ $row->language->language_name }}
                                                </option>
                                            @elseif($edit->language_code == $row->id)
                                                <option value="{{ $row->id }}">{{ $row->font_name }} -
                                                    {{ $row->language->language_name }}</option>
                                            @else
                                                <option value="{{ $row->id }}">{{ $row->font_name }} -
                                                    {{ $row->language->language_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <button type="submit" name="submit" class="btn btn-primary"
                                    id="susubmitbmit">Submit</button>
                                <button id="loading" class="btn btn-primary" type="button" disabled=""><span
                                        class="spinner-grow spinner-grow-sm" role="status"
                                        aria-hidden="true"></span>Loading...</button>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
        </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.8.1/prism.min.js"></script>

    <script src="{{ asset('assets/new/dist/dual-listbox.js')}}"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
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
        $('#loading').hide();
        $('#susubmitbmit').on('click', function() {
            $('#loading').show();
            $('#susubmitbmit').hide();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.dual-listbox__search').addClass('form-control');
            $('.dual-listbox__available').addClass('card');
            $('.dual-listbox__selected').addClass('card');
            $('.dual-listbox__title').addClass('card-title border-1');
            $('.dual-listbox__title').css('border', '1px solid #d4d4d4');
            $('.dual-listbox__title').css('border-radius', '6px');
        })
        let dualListbox = new DualListbox(".select1", {
            addEvent: function(value) {
                // Should use the event listeners
                console.log(value);
            },
            removeEvent: function(value) {
                // Should use the event listeners
                console.log(value);
            },
            availableTitle: "Available Fonts List",
            selectedTitle: "Selected Fonts List",
            addButtonText: ">",
            removeButtonText: "<",
            addAllButtonText: ">>",
            removeAllButtonText: "<<",

            sortable: true,
            upButtonText: "ᐱ",
            downButtonText: "ᐯ",

            draggable: true,
        });

        dualListbox.addEventListener("added", function(event) {
            console.log(event);
            console.log(event.addedElement);
        });
        dualListbox.addEventListener("removed", function(event) {
            console.log(event);
            console.log(event.removedElement);
        });
    </script>
    <script>
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
