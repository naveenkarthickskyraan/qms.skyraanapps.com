<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Quiz App - Category Info</title>
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

    {{-- <!-- Templat{{ asset('e Main CSS File --> --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
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
            <h1> Batch Info List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/batches') }}">Batch Info List</a></li>
                    <li class="breadcrumb-item active">List of Batch Info  Table</li>
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
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
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
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <style>
                    .batch-tree-view {
                        font-size: 13px;
                        border: 1px solid #eee;
                        border-radius: 4px;
                        padding: 6px 10px;
                        background-color: #f9f9f9;
                    }

                    .tree-list, .tree-list ul {
                        padding-left: 15px;
                        list-style: none;
                        margin: 0;
                    }

                    .tree-node {
                        cursor: pointer;
                        padding: 2px 5px;
                        border-radius: 3px;
                    }

                    .tree-node:hover {
                        background-color: #f0f0f0;
                    }

                    .toggle-icon {
                        cursor: pointer;
                        font-size: 10px;
                        transition: transform 0.2s ease;
                    }

                    .nested-tree {
                        padding-left: 16px;
                        margin-top: 3px;
                    }

                    #savedBatchesTable td {
                        vertical-align: top;
                    }
                </style>

                <!-- Recent Sales -->
                <div class="col-12">
                    
                    @include('admin.accounts.permission', [
                        'menu' => 'batch_menu',
                        'name' => 'Batch Info',
                    ])


                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Batch List <span>| Today</span></h5>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <div class="action-btn" align="right" style="padding-top:20px;padding-right:20px;">
                                        <a href="{{ url('admin/add_batch') }}"
                                            class="btn btn-sm btn-primary btn-add">
                                            <i class="ri-add-line"></i> Add New Batch </a>
                                    </div>
                                </div>
                            </div>
                            <table id="savedBatchesTable" class="table table-bordered table-hover yajra-datatable text-center">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" scope="col">Id</th>
                                        <th class="text-center" scope="col">App Name</th>
                                        <th class="text-center" scope="col">Tree Name</th>
                                        <th class="text-center" scope="col">Starting Point</th>
                                        <th class="text-center" scope="col">Tree Structure</th>
                                        <th class="text-center" scope="col">created_at</th>
                                        <th class="text-center" scope="col">Status</th>
                                        <th class="text-center" scope="col">Action</th>
                                        <th class="text-center" scope="col">Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- End Recent Sales -->
            </div>
        </section>

        </div>
        </div>
        </div>
        <!-- page-body-wrapper ends -->
        <footer id="footer" class="footer">
            <div class="copyright">
            </div>
        </footer>

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
            // Check if alert was dismissed
            const alertDismissed = localStorage.getItem('BatchPermissionAlertDismissed');
            const dismissTime = localStorage.getItem('BatchPermissionAlertDismissTime');
            const now = new Date().getTime();
            
            // Show alert only if not dismissed or dismissed more than 1 hour ago
            if (!alertDismissed || (dismissTime && now - dismissTime > 3600000)) {
                document.getElementById('permissionAlert').style.display = 'block';
            } else {
                document.getElementById('permissionAlert').style.display = 'none';
            }
        
            let autoHideTimeout;
        
            function pauseAutoHide() {
                clearTimeout(autoHideTimeout);
            }
        
            function dismissPermissionAlert(permanent = false) {
                const alert = document.getElementById('permissionAlert');
                if (alert) {
                    alert.style.animation = 'fadeIn 0.4s ease-in-out reverse';
                    setTimeout(() => {
                        alert.remove();
                        if (permanent) {
                            // Store dismissal for 1 hour
                            localStorage.setItem('BatchPermissionAlertDismissed', 'true');
                            localStorage.setItem('BatchPermissionAlertDismissTime', new Date().getTime());
                        }
                    }, 400);
                }
            }
        </script>

        <script>
            $(document).ready(function() {
                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    ajax: "{{ route('batch.list') }}",
                    columns: [{
                            data: 'id',
                            name: 'id',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'apps.app_name',
                            name: 'apps.app_name'
                        },
                        {
                            data: 'tree_name',
                            name: 'tree_name'
                        },
                        {
                            data: 'starting_point_name',
                            name: 'starting_point_name'
                        },
                        {
                            data: 'tree_structure',
                            name: 'tree_structure',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    return renderTreeStructure(data);
                                }
                                return '';
                            },
                            width: '40%' // You can apply width here instead of in a second "columns"
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
                    order: [
                        [0, 'desc']
                    ],
                });
            });


            function renderTreeStructure(nodes) {
                if (!Array.isArray(nodes)) {
                    return '<div class="text-muted">No tree structure available</div>';
                }

                const nodeMap = {};
                nodes.forEach(node => {
                    nodeMap[node.node_id] = { ...node, children: [] };
                });

                // Assign children to their parents
                nodes.forEach(node => {
                    if (node.parent_id && nodeMap[node.parent_id]) {
                        nodeMap[node.parent_id].children.push(nodeMap[node.node_id]);
                    }
                });

                const treeRoots = nodes.filter(node => !node.parent_id || !nodeMap[node.parent_id]);

                // Recursive function to render each node
                function renderNode(node) {
                    const hasChildren = node.children && node.children.length > 0;

                    let html = `
                        <li>
                            <div class="tree-node d-flex align-items-center">
                                ${hasChildren ? `<i class="fas fa-chevron-right toggle-icon me-1" onclick="toggleTreeNode(this)"></i>` : `<i class="fas fa-circle me-2 text-secondary" style="font-size:6px;"></i>`}
                                <i class="fas fa-folder me-1 text-warning"></i>
                                <span>${node.node_name}</span>
                            </div>
                    `;

                    if (hasChildren) {
                        html += `<ul class="nested-tree" >`;
                        node.children.forEach(child => {
                            html += renderNode(child);
                        });
                        html += `</ul>`;
                    }

                    html += `</li>`;
                    return html;
                }

                let treeHtml = `
                    <div class="batch-tree-view">
                        <ul class="tree-list" style="list-style-type: none; padding-left: 10px;">
                `;

                treeRoots.forEach(node => {
                    treeHtml += renderNode(nodeMap[node.node_id]);
                });

                treeHtml += `
                        </ul>
                    </div>
                `;

                return treeHtml;
            }

            // Toggle function to expand/collapse tree
            function toggleTreeNode(iconElement) {
                const $icon = $(iconElement);
                const $nested = $icon.closest('li').children('.nested-tree');
                $nested.slideToggle(150);
                $icon.toggleClass('fa-chevron-right fa-chevron-down');
            }
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
