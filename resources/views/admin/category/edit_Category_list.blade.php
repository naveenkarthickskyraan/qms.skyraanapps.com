<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Quiz App - Edit Category Info</title>
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
    <link href="{{ asset('assets/css/preloader.css') }}" rel="stylesheet">

    <style>
        /* ====== Image Handling ====== */
        .image-preview {
            max-width: 100px;
            max-height: 100px;
            margin-top: 0.5rem;
            border-radius: 4px;
            border: 1px solid var(--border-color);
            display: none;
        }

        .current-image-container {
            margin-top: 0.5rem;
        }

        .current-image {
            max-width: 100px;
            max-height: 100px;
            border-radius: 4px;
            border: 1px solid var(--border-color);
        }

        /* Image Modal */
        .image-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .image-modal-content {
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 90%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .close-image-modal {
            position: absolute;
            top: 1rem;
            right: 2rem;
            color: #f1f1f1;
            font-size: 2.5rem;
            font-weight: bold;
            transition: 0.2s;
            cursor: pointer;
        }

        .close-image-modal:hover {
            color: var(--danger-color);
        }
    </style>
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
            <h1>Nested Category List (Manage Form)</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/nested_category_list') }}">Nested Category
                            List</a></li>
                    <li class="breadcrumb-item active">List of Nested Category Table</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-9 grid-margin stretch-card">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li> <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                        @endforeach
                    </div>
                @endif
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
                <hr class="mb-4" style="border: 1px solid #012970 !important;">
                <div class="card" style="background-color: #fff;">
                    <div class="card-body">
                        <br>
                        @foreach ($edit_category_id as $edit_category_id)
                            <form class="forms-sample mb-3"
                                action="{{ url('admin/edit_nested_category_list/' . $edit_category_id->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <h4 class="card-header fw-bold">Edit Nested Category Form</h4>
                                <br>
                                <div class="container px-4">
                                    <div class="form-group row mb-3">
                                        <label for="name" class="col-sm-12 col-form-label h2 text-dark"
                                            style="padding-left: 10px">Category Name <span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="floatingInput" name="name"
                                                value="{{ $edit_category_id->name }}"
                                                placeholder="Enter a Category Name">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="nodeDescription" class="col-sm-12 col-form-label h2 text-dark"
                                            style="padding-left: 10px">Description <span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-sm-12">
                                            <textarea id="nodeDescription" class="form-control" name="description" rows="3" placeholder="Enter a brief description (optional)">{{ $edit_category_id->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="Image" class="col-sm-12 col-form-label h2 text-dark"
                                            style="padding-left: 10px">Image <span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <input type="file" id="nodeImage" name="image" class="form-control"
                                                    accept="image/*" onchange="previewImage(this)">
                                                <small class="text-muted">Optional: Upload an image for this Category
                                                    (JPEG, PNG, max
                                                    2MB)</small>
                                                <img id="imagePreview" class="image-preview mt-2"
                                                    alt="Image preview">

                                                <div id="currentImageContainer" class="current-image-container"
                                                    style="display: none;">
                                                    <p class="mb-1">Current Image:</p>
                                                    <img id="currentImage" class="current-image" src=""
                                                        alt="Current image">
                                                    <div class="form-check mt-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="removeImage" name="remove_image" value="1">
                                                        <label class="form-check-label" for="removeImage">
                                                            Remove current image
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="container px-5">
                                        <div class="row">
                                            <div class="col-sm-12 text-end">
                                                <button type="submit" name="submit" class="btn btn-primary"
                                                    id="susubmitbmit"><i class="fas fa-save me-1"></i> Submit</button>
                                                <button id="loading" class="btn btn-primary" type="button"
                                                    disabled=""><span class="spinner-grow spinner-grow-sm"
                                                        role="status" aria-hidden="true"></span>Loading...</button>
                                                <a href="{{ url('admin/nested_category_list') }}"
                                                    class="btn btn-dark" type="button">cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     toastr.options = {
        //         "closeButton": true,
        //         "progressBar": true
        //     }
        //     @if (Session::has('error'))
        //         toastr.error("{{ Session::get('error') }}");
        //     @elseif (Session::has('message'))
        //         toastr.success("{{ Session::get('message') }}");
        //     @endif
        // });
    </script>
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


        function previewImage(input) {
            const file = input.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }

        if("{{ $edit_category_id->image }}"){
            document.getElementById('currentImageContainer').style.display = 'block';
            document.getElementById('currentImage').src = "{{ asset('storage/') }}/{{ $edit_category_id->image }}";
        }
        document.getElementById('removeImage').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('currentImage').style.display = 'none';
                document.getElementById('nodeImage').value = '';
            } else {
                document.getElementById('currentImage').style.display = 'block';
            }
        });
    </script>

</body>

</html>
