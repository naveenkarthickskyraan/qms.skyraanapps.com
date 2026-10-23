<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Quiz App - Add Category Info</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">

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

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> --}}

    {{-- <!-- Templat{{ asset('e Main CSS File --> --}}

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/preloader.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/category_custom.css') }}" rel="stylesheet">

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
            <h1>Nested Category List (Add Form)</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/nested_category_list') }}">Nested Category List</a></li>
                    <li class="breadcrumb-item active">List of Nested Category Table</li>
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

        <div class="alert-container"></div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card" style="background-color: #fff;">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0" style="color: #012970 !important;"><i class="fas fa-folder-tree me-2"></i>Nested Category Form</h4>
                        <button class="btn btn-add text-white fw-bold" onclick="openForm('add', null)">
                            <i class="fas fa-plus me-1"></i> Add Root Category
                        </button>
                    </div>

                    <div class="card-body">
                        <hr class="text-dark">
                            <div class="search-container mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Search categories..."
                                        id="searchInput" onkeyup="searchTree()">
                                </div>
                            </div>

                            <div id="tree-container" class="tree-container">
                                <div class="empty-message">
                                    <i class="fas fa-folder-open fa-2x mb-2"></i>
                                    <p>No categories found. Start by adding a root category.</p>
                                </div>
                            </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>


        <!-- Bootstrap Modal for Form -->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header all-clour">
                        <h5 class="modal-title" id="formModalLabel">Manage Category</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="formType">
                        <input type="hidden" id="nodeId">
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label h2 text-dark">Category Name <span class="text-danger">*</span></label>
                            <input type="text" id="nodeName" class="form-control" placeholder="Enter Category name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label h2 text-dark">Description</label>
                            <textarea id="nodeDescription" class="form-control" rows="3" placeholder="Enter a brief description (optional)"></textarea>
                        </div>
                        <!-- Direction Based Category -->
                        <div class="mb-3">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="isDirectionBasedCategory">
                                    <label class="form-check-label" for="isDirectionBasedCategory">
                                    Is Direction Based Category
                                </label>
                            </div>
                            <small class="text-muted">
                                Enable this if the category contains questions with a direction / passage.
                            </small>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-12 col-form-label h2 text-dark">Image</label>
                            <input type="file" id="nodeImage" class="form-control" accept="image/*"
                                onchange="previewImage(this)">
                            <small class="text-muted">Optional: Upload an image for this Category (JPEG, PNG, max
                                2MB)</small>
                            <img id="imagePreview" class="image-preview mt-2" alt="Image preview">

                            <div id="currentImageContainer" class="current-image-container" style="display: none;">
                                <p class="mb-1">Current Image:</p>
                                <img id="currentImage" class="current-image" src="" alt="Current image">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="removeImage">
                                    <label class="form-check-label" for="removeImage">
                                        Remove current image
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="saveNode">
                            <i class="fas fa-save me-1"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Modal -->
        <div id="imageModal" class="image-modal">
            <span class="close-image-modal">&times;</span>
            <img class="image-modal-content" id="modalImage">
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header all-clour bg-danger text-white" style="background: #f25961 !important;border-color: #f25961 !important;">
                        <h5 class="modal-title">Confirm Deletion</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Category? All child categories will also be removed.
                        </p>
                        <p class="fw-bold">This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
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

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/js/nested_category.js') }}"></script>

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
