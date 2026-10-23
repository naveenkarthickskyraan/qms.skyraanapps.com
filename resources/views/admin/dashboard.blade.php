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

    {{-- <!-- Templat{{ asset('e Main CSS File --> --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/preloader.css') }}" rel="stylesheet">
    <style>
        canvas {
            max-width: 100%;
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
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-xxl-12 col-md-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h4 class="card-title mb-1 fw-bold text-primary">Dashboard Overview</h4>
                                    <p class="text-muted small mb-0">Welcome back! Here's what's happening today.</p>
                                </div>
                                <div class="badge bg-light text-dark p-2">
                                    <i class="bi bi-calendar3 me-2"></i>
                                    <span>{{ 'Today, ' . now()->format(' F j, Y') }}</span>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <!-- Total Quizzes Card -->
                                <div class="col-md-3">
                                    <div class="card bg-primary bg-gradient text-white mb-3 mb-md-0">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="card-subtitle mb-2 bg-primary">Total Quizzes</h6>
                                                    <h3 class="card-title mb-0 fw-semibold text-light">
                                                        {{ $totalQuizzes }}</h3>
                                                </div>
                                                <i class="bi bi-collection-play fs-1 opacity-50"></i>
                                            </div>
                                            <div class="mt-2">
                                                <span class="badge bg-white text-primary"><a
                                                        class="bg-white text-primary"
                                                        href="{{ url('admin/quiz_list') }}">Manage Quizzes</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Categories Card -->
                                <div class="col-md-3">
                                    <div class="card bg-success bg-gradient text-white mb-3 mb-md-0">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="card-subtitle mb-2 bg-success">Categories</h6>
                                                    <h3 class="card-title mb-0 fw-semibold text-light">
                                                        {{ $totalCategories }}</h3>
                                                </div>
                                                <i class="bi bi-tags fs-1 opacity-50"></i>
                                            </div>
                                            <div class="mt-2">
                                                <span class="badge bg-white text-success"><a
                                                        class="bg-white text-success"
                                                        href="{{ url('admin/nested_category_list') }}">Manage
                                                        Categories</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Applications Card -->
                                <div class="col-md-3">
                                    <div class="card bg-info bg-gradient text-white mb-3 mb-md-0">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="card-subtitle mb-2 bg-info">Applications</h6>
                                                    <h3 class="card-title mb-0 fw-semibold text-light">
                                                        {{ $totalApplications }}</h3>
                                                </div>
                                                <i class="bi bi-file-earmark-text fs-1 opacity-50"></i>
                                            </div>
                                            <div class="mt-2">
                                                <span class="badge bg-white text-info"><a class="bg-white text-info"
                                                        href="{{ url('admin/app_list') }}">Review
                                                        Applications</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Active Users Card -->
                                <div class="col-md-3">
                                    <div class="card bg-warning bg-gradient text-white">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="card-subtitle mb-2 bg-warning border-dark">Active Users
                                                    </h6>
                                                    <h3 class="card-title mb-0 fw-semibold text-light">
                                                        {{ $activeUsers }}</h3>
                                                </div>
                                                <i class="bi bi-people fs-1 opacity-50"></i>
                                            </div>
                                            <div class="mt-2">
                                                <span class="badge bg-white text-warning"><a
                                                        class="bg-white text-warning"
                                                        href="{{ url('admin/superadmin') }}">View Users</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chart Section -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="card-title mb-0 fw-semibold">Quiz Performance</h5>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown">
                                                Last 30 Days
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                                                <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                                                <li><a class="dropdown-item" href="#">Last 90 Days</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="height: 300px;">
                                        <canvas id="activityChart" data-dates='{{ json_encode($dates) }}'
                                            data-quizzes='{{ json_encode($quizData) }}'
                                            data-categories='{{ json_encode($categoryData) }}'
                                            data-applications='{{ json_encode($appData) }}'
                                            data-batches='{{ json_encode($batchData) }}'></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Quick Actions -->
                                <div class="col-md-5 mb-4 mb-md-0">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <h5 class="card-title fw-semibold">Quick Actions</h5>
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <a href="{{ url('admin/add_quiz') }}"
                                                        class="btn btn-outline-primary w-100 h-100 py-3 d-flex flex-column align-items-center">
                                                        <i class="bi bi-plus-circle fs-3 mb-2"></i>
                                                        <span>Create Quiz</span>
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ url('admin/add_nested_category') }}"
                                                        class="btn btn-outline-success w-100 h-100 py-3 d-flex flex-column align-items-center">
                                                        <i class="bi bi-folder-plus fs-3 mb-2"></i>
                                                        <span>Add Category</span>
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ url('admin/superadmin') }}"
                                                        class="btn btn-outline-info w-100 h-100 py-3 d-flex flex-column align-items-center">
                                                        <i class="bi bi-people fs-3 mb-2"></i>
                                                        <span>Manage Users</span>
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ url('admin/profile_update') }}"
                                                        class="btn btn-outline-warning w-100 h-100 py-3 d-flex flex-column align-items-center">
                                                        <i class="bi bi-gear fs-3 mb-2"></i>
                                                        <span>Settings</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Recent Activity -->
                                <div class="col-md-7">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title mb-0 fw-semibold">Recent Activity</h5>
                                                <a href="#" class="small">View All</a>
                                            </div>
                                            <div class="list-group list-group-flush px-3 pt-3"
                                                style="min-height:100px;max-height: 300px;overflow-y: scroll;">
                                                @forelse($recentActivities as $key => $activity)
                                                    @php
                                                        $textColorClasses = [
                                                            'success',
                                                            'danger',
                                                            'primary',
                                                            'info',
                                                            'warning',
                                                            'muted',
                                                        ];

                                                        $colorIndex = $key % count($textColorClasses);
                                                        $textColorClass = $textColorClasses[$colorIndex];

                                                        $url = $activity->url;
                                                        $path = parse_url($url, PHP_URL_PATH);
                                                        $segments = explode('/', trim($path, '/'));

                                                        // Get last two segments safely
                                                        $lastSegment = $segments[count($segments) - 1] ?? '';
                                                        $secondLastSegment = $segments[count($segments) - 2] ?? '';

                                                        // Default action sentence
                                                        $actionSentence = 'Viewed ' . ucfirst($lastSegment);

                                                        // If URL contains 'edit_' in secondLastSegment → it's an edit action
                                                        if (
                                                            Str::startsWith($secondLastSegment, 'edit_') &&
                                                            is_numeric($lastSegment)
                                                        ) {
                                                            $entity = Str::ucfirst(
                                                                str_replace(
                                                                    'list',
                                                                    ' ',
                                                                    str_replace(
                                                                        '_',
                                                                        ' ',
                                                                        str_replace('edit_', '', $secondLastSegment),
                                                                    ),
                                                                ),
                                                            );
                                                            $actionSentence = "Edited {$entity} (ID: {$lastSegment})";

                                                            // If URL contains 'create_' in lastSegment → it's a create action
                                                        } elseif (Str::startsWith($lastSegment, 'add_')) {
                                                            $entity = ucfirst(str_replace('add_', '', $lastSegment));
                                                            $actionSentence = "Created a new {$entity}";

                                                            // Special case for login/logout
                                                        } elseif (in_array($lastSegment, ['login', 'logout'])) {
                                                            $actionSentence = ucfirst($lastSegment);
                                                        }
                                                    @endphp

                                                    <div class="list-group-item border-0 px-0 py-2 card">
                                                        <div class="d-flex align-items-center card-body">
                                                            <div class="bg-light rounded p-2 me-3">
                                                                <i
                                                                    class="bi bi-{{ $lastSegment == 'login' || $lastSegment == 'logout' ? 'person-plus' : 'exclamation-triangle' }} text-{{ $textColorClass }}"></i>
                                                            </div>
                                                            <div>
                                                                <p class="mb-0 small">
                                                                    {{ $actionSentence }} At
                                                                    {{ \Carbon\Carbon::parse($activity->time)->format('D d, M Y - h:i a') }}
                                                                    <br>
                                                                    URL: <a href="{{ $url ?? '#' }}"
                                                                        target="_blank">{{ $url ?? 'N/A' }}</a>,<br>
                                                                    IP: {{ $activity->ip ?? 'N/A' }},<br>
                                                                    Email: {{ $activity->email ?? 'N/A' }}
                                                                </p>
                                                                <span
                                                                    class="text-muted small">{{ \Carbon\Carbon::parse($activity->time)->format('D d - h:i a') }} ({{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }})</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="list-group-item border-0 px-0 py-2">
                                                        <p class="text-muted mb-0">No recent activity</p>
                                                    </div>
                                                @endforelse

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <li class="dropdown-header text-start">
                                    <h6>App Filter</h6>
                                </li>
                                <li>
                                    <center><a class="dropdown-item" href="{{ url('admin/app_list') }}">View</a>
                                    </center>
                                </li>
                                <li>
                                    <center><a class="dropdown-item" href="{{ url('admin/admin_add_app') }}">Add</a>
                                    </center>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Apps <span>| Today</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-card-checklist"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ count($apps) }}</h6>
                                    <span class="text-success small pt-1 fw-bold">100%</span> <span
                                        class="text-muted small pt-2 ps-1">increase</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li>
                                    <center><a class="dropdown-item" href="{{ url('admin/category_list') }}">View</a>
                                    </center>
                                </li>
                                <li>
                                    <center><a class="dropdown-item" href="{{ url('admin/add_category') }}">Add</a>
                                    </center>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Categories <span>| Today</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-file-earmark-font-fill"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ count($category) }}</h6>
                                    <span class="text-success small pt-1 fw-bold">100%</span> <span
                                        class="text-muted small pt-2 ps-1">increase</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <li class="dropdown-header text-start">
                                    <h6>Fonts Filter</h6>
                                </li>
                                <li>
                                    <center><a class="dropdown-item" href="{{ url('admin/prayers_list') }}">View</a>
                                    </center>
                                </li>
                                <li>
                                    <center><a class="dropdown-item" href="{{ url('admin/add_prayers') }}">Add</a>
                                    </center>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Quiz <span>| Today</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-file-earmark-font-fill"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ count($prayer) }}</h6>
                                    <span class="text-success small pt-1 fw-bold">100%</span> <span
                                        class="text-muted small pt-2 ps-1">increase</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- End Recent Sales -->
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
        </div>
    </footer>
    <!-- End Footer -->

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get chart data from canvas element attributes
            const ctx = document.getElementById('activityChart').getContext('2d');
            const dates = JSON.parse(document.getElementById('activityChart').dataset.dates);
            const quizData = JSON.parse(document.getElementById('activityChart').dataset.quizzes);
            const categoryData = JSON.parse(document.getElementById('activityChart').dataset.categories);
            const appData = JSON.parse(document.getElementById('activityChart').dataset.applications);
            const batchData = JSON.parse(document.getElementById('activityChart').dataset.batches);

            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                            label: 'Quizzes',
                            data: quizData,
                            borderColor: 'rgba(13, 110, 253, 1)',
                            backgroundColor: 'rgba(13, 110, 253, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Categories',
                            data: categoryData,
                            borderColor: 'rgba(25, 135, 84, 1)',
                            backgroundColor: 'rgba(25, 135, 84, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Applications',
                            data: appData,
                            borderColor: 'rgba(13, 202, 240, 1)',
                            backgroundColor: 'rgba(13, 202, 240, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Batches',
                            data: batchData,
                            borderColor: 'rgba(255, 193, 7, 1)',
                            backgroundColor: 'rgba(255, 193, 7, 0.1)',
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    </script>



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
