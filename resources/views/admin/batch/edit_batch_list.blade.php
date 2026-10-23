<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Quiz App - Info </title>
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


    <style>
        .tree-container {
            max-height: 500px;
            overflow-x: auto;
            overflow-y: auto;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            white-space: nowrap;
            display: block;
            width: max-content;
            min-width: 100%;
        }

        .tree-node {
            position: relative;
            margin: 5px 0;
            padding-left: 20px;
            border-left: 2px solid #33333340;
            white-space: nowrap;
        }

        .tree-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.2s;
            border-radius: 5px;
            white-space: nowrap;
        }

        .tree-label.expandable {
            background: #e3f2fd;
            font-weight: 400;
        }

        .tree-label.leaf {
            background: #f0f4c3;
            font-weight: bold;
        }

        .tree-toggle {
            cursor: pointer;
            font-size: 14px;
            margin-right: 5px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-left: auto;
            position: relative;
        }

        input[type='checkbox'] {
            appearance: none;
            position: relative;
            width: 20px;
            height: 20px;
            border: 0.125em solid #33333357;
            font: inherit;
            vertical-align: middle;
            font-size: 1.25em;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type='checkbox']:before,
        input[type='checkbox']:after {
            content: "";
            position: absolute;
            background: #002aff;
            width: 0.25em;
        }

        input[type='checkbox']:before {
            height: 45%;
            top: 30%;
            left: 11%;
            border-bottom-left-radius: 0;
            transform: scale(0) rotate(-32deg);
            transform-origin: top left;
        }

        input[type='checkbox']:after {
            height: 130%;
            left: 41%;
            top: -75%;
            transform: scale(0) rotate(35deg);
            transform-origin: bottom left;
        }

        input[type='checkbox']:before,
        input[type='checkbox']:after {
            transition: transform 0s;
        }

        input[type='checkbox']:checked:before {
            transform: scale(1) rotate(-50deg);
        }

        input[type='checkbox']:checked:after {
            transform: scale(1) rotate(41deg);
        }

        input[type='checkbox']:checked:before {
            transition: transform 0.15s;
            transition-delay: 0s;
        }

        input[type='checkbox']:checked:after {
            transition: transform 0.25s;
            transition-delay: 0s;
        }
        input[type='checkbox']:disabled {
            cursor: not-allowed;
            opacity: 0.5;
            appearance: auto;
        }

        .hidden { display: none; }

        .message-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            font-size: 18px;
            color: gray;
        }

        .node-selected {
            border: 2px solid #007bff;
            background-color: #f0f7ff;
        }

        .node-starting-point {
            border: 2px solid #ffc107;
            background-color: #fffbf0;
        }

        .selected-count {
            font-size: 12px;
            color: #6c757d;
            margin-left: 5px;
        }

        .edit-mode-banner {
            background-color: #ffc107;
            color: #000;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .preview-section {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .preview-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #0d6efd;
        }

        .preview-item {
            margin-bottom: 8px;
        }

        .preview-label {
            font-weight: 500;
            color: #495057;
        }

        .preview-value {
            color: #212529;
        }

        .invalid-selection {
            color: #dc3545;
            font-weight: 500;
        }

        .valid-selection {
            color: #198754;
            font-weight: 500;
        }

        .selection-status-card {
            border-left: 4px solid #6c757d;
        }

        .selection-status-card.valid {
            border-left-color: #198754;
        }

        .selection-status-card.invalid {
            border-left-color: #dc3545;
        }

        .node-path {
            font-size: 0.8em;
            color: #6c757d;
            margin-top: 3px;
        }

        .btn-toggle {
            min-width: 100px;
        }

        .btn-toggle.selected {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }

        .btn-toggle-starting {
            min-width: 120px;
        }

        .btn-toggle-starting.selected {
            background-color: #ffc107;
            color: #212529;
            border-color: #ffc107;
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
            <h1>Batch Info  List (Edit Form)</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/batches') }}">Batch Info  List</a></li>
                    <li class="breadcrumb-item active">List of Batch Info  Table</li>
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

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card" style="background-color: #fff;">
                    <div class="card-body">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0" style="color: #012970 !important;"><i class="fas fa-folder-tree me-2"></i>Edit App Form</h4>
                        </div>

                        <div class="container mt-4">
                            <div class="edit-mode-banner">
                                <i class="fas fa-edit me-2"></i> EDIT MODE - Editing Batch ID: <span id="current-batch-id"></span>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="alert alert-warning mt-3 d-flex align-items-center" role="alert">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div>
                                            <strong>Editing Instructions:</strong>
                                            <ol class="mb-0">
                                                <li>Select a tree (root category)</li>
                                                <li>Choose a starting point within that tree</li>
                                                <li>Select the nodes you want to include</li>
                                                <li>Validate your selection before updating</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <div class="mb-3 d-flex justify-content-between">
                                        <div>
                                            <button id="resetSelectionBtn" class="btn btn-sm btn-outline-secondary me-2">
                                                <i class="fas fa-undo me-1"></i> Reset
                                            </button>
                                            <span id="selectedCount" class="selected-count">0 nodes selected</span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <input type="text" id="searchInput" class="form-control" placeholder="Search subcategories...">
                                        </div>
                                    </div>

                                    <div class="alert alert-info mb-3 d-flex align-items-center" role="alert">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div id="selection-status">
                                            Please select a tree first.
                                        </div>
                                    </div>

                                    <div id="tree-container" class="tree-container"></div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card selection-status-card mb-3" id="selection-status-card">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-clipboard-check me-2"></i>Selection Status</h5>
                                            <div class="preview-section">
                                                <div class="preview-item">
                                                    <span class="preview-label">Selected Tree:</span>
                                                    <span class="preview-value" id="preview-tree">Not selected</span>
                                                </div>
                                                <div class="preview-item">
                                                    <span class="preview-label">Starting Point:</span>
                                                    <span class="preview-value" id="preview-start-point">Not selected</span>
                                                    <div class="node-path" id="start-point-path"></div>
                                                </div>
                                                <div class="preview-item">
                                                    <span class="preview-label">Selected Nodes:</span>
                                                    <span class="preview-value" id="preview-node-count">0</span>
                                                </div>
                                            </div>
                                            <div class="preview-item mt-3">
                                                <span class="preview-label">Validation:</span>
                                                <span class="preview-value" id="preview-validation">No validation performed</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mt-3">
                                        <div class="card-header bg-primary text-white mb-3">
                                            <i class="fas fa-tasks me-2"></i>Actions
                                        </div>
                                        <div class="card-body">
                                            <button id="validateSelectionBtn" class="btn btn-primary w-100 mb-2">
                                                <i class="fas fa-check-circle me-1"></i> Validate Selection
                                            </button>
                                            <button id="updateBatchBtn" class="btn btn-success w-100" disabled>
                                                <i class="fas fa-save me-1"></i> Update Batch
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Confirmation Modal -->
                        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Batch Update</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="confirmationModalBody">
                                        <p>Are you sure you want to update this batch with the following changes?</p>
                                        <div class="alert alert-info">
                                            <strong>Tree:</strong> <span id="confirm-tree"></span><br>
                                            <strong>Starting Point:</strong> <span id="confirm-start-point"></span><br>
                                            <strong>Selected Nodes:</strong> <span id="confirm-node-count"></span>
                                        </div>
                                        <p class="text-muted">Batch ID: <span id="confirm-batch-id"></span></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="confirmUpdate">Update Batch</button>
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
        const baseUrl = '/admin/subcategories';
        const batchesApiUrl = '/admin/batches';
        let allNodes = [];
        let selectedNodes = new Set();
        let currentSelection = {
            selectedTree: null,
            startingPoint: null
        };
        let currentBatchId = null;
        let originalBatchData = null;

        // Get batch ID from URL
        function getBatchIdFromUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('id');
        }

        // Get node path for display
        function getNodePath(nodeId) {
            let path = [];
            let currentNode = document.getElementById(`node-${nodeId}`);

            while (currentNode) {
                const nodeName = currentNode.dataset.name;
                path.unshift(nodeName);
                const parentId = currentNode.dataset.parentId;
                currentNode = parentId ? document.getElementById(`node-${parentId}`) : null;
            }

            return path.join(' > ');
        }

        $(document).ready(function () {
            currentBatchId = "{{  $edit->id }}";
            if (!currentBatchId) {
                alert('No batch ID specified in URL');
                window.location.href = '/';
                return;
            }

            $('#current-batch-id').text(currentBatchId);
            $('#confirm-batch-id').text(currentBatchId);

            // Load the batch for editing
            loadBatchForEditing(currentBatchId);

            // Event listeners
            $('#searchInput').on('input', filterTree);
            $('#resetSelectionBtn').on('click', resetCurrentSelection);
            $('#validateSelectionBtn').on('click', validateSelection);
            $('#updateBatchBtn').on('click', showUpdateConfirmation);
            $('#confirmUpdate').on('click', confirmUpdate);
        });

        function fetchAndRenderTree(searchQuery = '') {
            $.ajax({
                url: baseUrl,
                method: 'GET',
                data: { search: searchQuery },
                success: function (data) {
                    allNodes = JSON.parse(JSON.stringify(data));

                    if (!data || data.length === 0) {
                        document.getElementById('tree-container').innerHTML = '<div class="message-container">No subcategories found</div>';
                        return;
                    }

                    document.getElementById('tree-container').innerHTML = renderNode(data);
                    updateUIBasedOnCurrentSelection();
                    updateSelectedCount();
                    updatePreview();
                },
                error: function (error) {
                    console.error("Error fetching subcategories:", error);
                    document.getElementById('tree-container').innerHTML =
                        '<div class="message-container">Error loading subcategories. Please try again.</div>';
                    showTemporaryAlert('Error loading subcategories', 'danger');
                }
            });
        }

        function renderNode(nodes, parentId = null) {
            return nodes.map(node => {
                const hasChildren = Array.isArray(node.children) && node.children.length > 0;
                const isSelected = selectedNodes.has(node.id);
                const isCurrentTree = currentSelection.selectedTree && currentSelection.selectedTree.id === node.id;
                const isStartingPoint = currentSelection.startingPoint && currentSelection.startingPoint.id === node.id;

                return `
                <div class="tree-node ${isCurrentTree ? 'node-selected' : ''} ${isStartingPoint ? 'node-starting-point' : ''}"
                    id="node-${node.id}" data-name="${node.name}" data-id="${node.id}" data-parent-id="${parentId}">
                    <div class="tree-label ${hasChildren ? 'expandable' : 'leaf'}">
                        <div class="d-flex align-items-center flex-grow-1">
                            <input type="checkbox" class="node-checkbox" id="checkbox-${node.id}"
                                data-id="${node.id}"
                                ${isSelected ? 'checked' : ''}
                                onchange="handleCheckboxChange(this, ${node.id}, ${hasChildren})">

                            ${hasChildren ?
                                `<span class="tree-toggle" onclick="toggleChildren(${node.id})"><i class="fa-solid fa-angle-down"></i></span>` :
                                '<span class="tree-toggle" style="width: 14px; display: inline-block;"></span>'
                            }
                            <span class="node-name" data-id="${node.id}">${node.name}</span>
                        </div>
                        <div class="actions">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-outline-primary btn-toggle select-tree-btn ${isCurrentTree ? 'selected' : ''}"
                                    data-id="${node.id}"
                                    data-name="${node.name}"
                                    onclick="selectTree(${node.id}, '${node.name}')">
                                    <i class="fas ${isCurrentTree ? 'fa-check-circle' : 'fa-check'} me-1"></i>
                                    ${isCurrentTree ? 'Selected' : 'Select Tree'}
                                </button>
                                <button class="btn btn-sm btn-outline-warning ms-1 btn-toggle-starting start-from-btn ${isStartingPoint ? 'selected' : ''}"
                                    data-id="${node.id}"
                                    data-name="${node.name}"
                                    onclick="setStartingPoint(${node.id}, '${node.name}')">
                                    <i class="fas ${isStartingPoint ? 'fa-flag-checkered' : 'fa-flag'} me-1"></i>
                                    ${isStartingPoint ? 'Starting Point' : 'Set Start'}
                                </button>
                            </div>
                        </div>
                    </div>
                    ${hasChildren ?
                        `<div class="children" id="children-${node.id}" style="display: block;">${renderNode(node.children, node.id)}</div>` : ''
                    }
                </div>`;
            }).join('');
        }

        function toggleChildren(id) {
            const childrenContainer = document.getElementById(`children-${id}`);
            const toggleIcon = document.querySelector(`#node-${id} .tree-toggle i`);

            if (childrenContainer.style.display === "none") {
                childrenContainer.style.display = "block";
                if (toggleIcon) toggleIcon.className = "fa-solid fa-angle-down";
            } else {
                childrenContainer.style.display = "none";
                if (toggleIcon) toggleIcon.className = "fa-solid fa-angle-right";
            }
        }

        function handleCheckboxChange(checkbox, id, hasChildren) {
            const nodeId = parseInt(id);

            if (checkbox.checked) {
                selectedNodes.add(nodeId);
                if (hasChildren) selectAllChildren(nodeId);
                selectParentsIfAllSiblingsSelected(nodeId);
            } else {
                selectedNodes.delete(nodeId);
                if (hasChildren) unselectAllChildren(nodeId);

                // If unchecking the starting point, clear it
                if (currentSelection.startingPoint && currentSelection.startingPoint.id === nodeId) {
                    currentSelection.startingPoint = null;
                    document.getElementById('selection-status').innerHTML =
                        `Tree "<strong>${currentSelection.selectedTree.name}</strong>" selected. Please select a starting point.`;
                }
            }

            updateCheckboxStates();
            updateSelectedCount();
            updatePreview();
            validateSelection();
        }

        function selectAllChildren(parentId) {
            const childrenContainer = document.getElementById(`children-${parentId}`);
            if (!childrenContainer) return;

            const childNodes = childrenContainer.querySelectorAll('.tree-node');
            childNodes.forEach(childNode => {
                const childId = parseInt(childNode.dataset.id);
                selectedNodes.add(childId);

                const childCheckbox = document.getElementById(`checkbox-${childId}`);
                if (childCheckbox) childCheckbox.checked = true;

                if (childNode.querySelector('.children')) {
                    selectAllChildren(childId);
                }
            });
        }

        function unselectAllChildren(parentId) {
            const childrenContainer = document.getElementById(`children-${parentId}`);
            if (!childrenContainer) return;

            const childNodes = childrenContainer.querySelectorAll('.tree-node');
            childNodes.forEach(childNode => {
                const childId = parseInt(childNode.dataset.id);
                selectedNodes.delete(childId);

                const childCheckbox = document.getElementById(`checkbox-${childId}`);
                if (childCheckbox) childCheckbox.checked = false;

                if (childNode.querySelector('.children')) {
                    unselectAllChildren(childId);
                }
            });
        }

        function selectParentsIfAllSiblingsSelected(id) {
            const nodeElement = document.getElementById(`node-${id}`);
            if (!nodeElement) return;

            const parentId = nodeElement.dataset.parentId;
            if (!parentId) return;

            const parentElement = document.getElementById(`node-${parentId}`);
            if (!parentElement) return;

            const siblingsContainer = parentElement.querySelector('.children');
            if (!siblingsContainer) return;

            const siblingNodes = siblingsContainer.querySelectorAll('.tree-node');
            let allSiblingsSelected = true;

            siblingNodes.forEach(sibling => {
                const siblingId = parseInt(sibling.dataset.id);
                if (!selectedNodes.has(siblingId)) {
                    allSiblingsSelected = false;
                }
            });

            if (allSiblingsSelected) {
                selectedNodes.add(parseInt(parentId));
                const parentCheckbox = document.getElementById(`checkbox-${parentId}`);
                if (parentCheckbox) parentCheckbox.checked = true;
                selectParentsIfAllSiblingsSelected(parentId);
            }
        }

        function updateCheckboxStates() {
            document.querySelectorAll('.node-checkbox').forEach(checkbox => {
                const id = parseInt(checkbox.dataset.id);
                checkbox.checked = selectedNodes.has(id);
            });
        }

        function updateSelectedCount() {
            document.getElementById('selectedCount').textContent = `${selectedNodes.size} node${selectedNodes.size !== 1 ? 's' : ''} selected`;
        }

        function selectTree(id, name) {
            const nodeId = parseInt(id);

            // If clicking the already selected tree, deselect it
            if (currentSelection.selectedTree && currentSelection.selectedTree.id === nodeId) {
                resetCurrentSelection();
                return;
            }

            // If selecting a different tree, reset starting point and selections
            currentSelection = {
                selectedTree: { id: nodeId, name: name },
                startingPoint: null
            };

            // Clear selected nodes
            selectedNodes.clear();

            // Update UI
            updateUIBasedOnCurrentSelection();
            updateCheckboxStates();
            updateSelectedCount();

            // Update status message
            document.getElementById('selection-status').innerHTML =
                `Tree "<strong>${name}</strong>" selected. Please select a starting point.`;

            // Update preview
            updatePreview();

            // Disable update button until validation passes
            $('#updateBatchBtn').prop('disabled', true);
        }

        function setStartingPoint(id, name) {
            const nodeId = parseInt(id);

            // If clicking the already selected starting point, deselect it
            if (currentSelection.startingPoint && currentSelection.startingPoint.id === nodeId) {
                currentSelection.startingPoint = null;
                updateUIBasedOnCurrentSelection();
                updatePreview();
                $('#updateBatchBtn').prop('disabled', true);
                document.getElementById('selection-status').innerHTML =
                    `Tree "<strong>${currentSelection.selectedTree.name}</strong>" selected. Please select a starting point.`;
                return;
            }

            // Validate selection
            if (!currentSelection.selectedTree) {
                showTemporaryAlert('Please select a tree first before setting a starting point', 'warning');
                return;
            }

            // Check if starting point is within the selected tree
            let currentNode = document.getElementById(`node-${nodeId}`);
            let isInSelectedTree = false;

            while (currentNode) {
                if (parseInt(currentNode.dataset.id) === currentSelection.selectedTree.id) {
                    isInSelectedTree = true;
                    break;
                }
                currentNode = document.getElementById(`node-${currentNode.dataset.parentId}`);
            }

            if (!isInSelectedTree) {
                showTemporaryAlert('Starting point must be within the selected tree', 'danger');
                return;
            }

            // Update starting point
            currentSelection.startingPoint = { id: nodeId, name: name };

            // Auto-select the starting point node and all its descendants
            selectedNodes.add(nodeId);
            const checkbox = document.getElementById(`checkbox-${nodeId}`);
            if (checkbox) checkbox.checked = false;

            // Select all children of the starting point
            const childrenContainer = document.getElementById(`children-${nodeId}`);
            if (childrenContainer) {
                const childNodes = childrenContainer.querySelectorAll('.tree-node');
                childNodes.forEach(childNode => {
                    const childId = parseInt(childNode.dataset.id);
                    selectedNodes.add(childId);
                    const childCheckbox = document.getElementById(`checkbox-${childId}`);
                    if (childCheckbox) childCheckbox.checked = true;

                    // Recursively select all descendants
                    if (childNode.querySelector('.children')) {
                        selectAllChildren(childId);
                    }
                });
            }

            // Update UI
            updateUIBasedOnCurrentSelection();
            updateCheckboxStates();
            updateSelectedCount();

            // Update status message
            document.getElementById('selection-status').innerHTML =
                `Ready to update: Tree "<strong>${currentSelection.selectedTree.name}</strong>" with starting point "<strong>${name}</strong>"`;

            // Update preview
            updatePreview();

            // Auto-validate
            validateSelection();
        }

        function updateUIBasedOnCurrentSelection() {
            // Reset all node classes
            document.querySelectorAll('.tree-node').forEach(node => {
                node.classList.remove('node-selected', 'node-starting-point');
            });

            // Reset all select buttons
            document.querySelectorAll('.select-tree-btn').forEach(btn => {
                btn.classList.remove('selected');
                btn.innerHTML = `<i class="fas fa-check me-1"></i> Select Tree`;
            });

            // Reset all starting point buttons
            document.querySelectorAll('.start-from-btn').forEach(btn => {
                btn.classList.remove('selected');
                btn.innerHTML = `<i class="fas fa-flag me-1"></i> Set Start`;
            });

            // Highlight selected tree if exists
            if (currentSelection.selectedTree) {
                const selectedNode = document.getElementById(`node-${currentSelection.selectedTree.id}`);
                if (selectedNode) {
                    selectedNode.classList.add('node-selected');
                    const selectBtn = selectedNode.querySelector('.select-tree-btn');
                    if (selectBtn) {
                        selectBtn.classList.add('selected');
                        selectBtn.innerHTML = `<i class="fas fa-check-circle me-1"></i> Selected`;
                    }
                }
            }

            // Highlight starting point if exists
            if (currentSelection.startingPoint) {
                const startingNode = document.getElementById(`node-${currentSelection.startingPoint.id}`);
                if (startingNode) {
                    startingNode.classList.add('node-starting-point');
                    const startBtn = startingNode.querySelector('.start-from-btn');
                    if (startBtn) {
                        startBtn.classList.add('selected');
                        startBtn.innerHTML = `<i class="fas fa-flag-checkered me-1"></i> Starting Point`;
                    }
                }
            }
        }

        function updatePreview() {
            // Update tree preview
            const treePreview = document.getElementById('preview-tree');
            if (currentSelection.selectedTree) {
                treePreview.textContent = currentSelection.selectedTree.name;
                treePreview.className = 'preview-value valid-selection';
            } else {
                treePreview.textContent = 'Not selected';
                treePreview.className = 'preview-value';
            }

            // Update starting point preview
            const startPointPreview = document.getElementById('preview-start-point');
            const startPointPath = document.getElementById('start-point-path');
            if (currentSelection.startingPoint) {
                startPointPreview.textContent = currentSelection.startingPoint.name;
                startPointPreview.className = 'preview-value valid-selection';
                startPointPath.textContent = getNodePath(currentSelection.startingPoint.id);
                startPointPath.style.display = 'block';
            } else {
                startPointPreview.textContent = 'Not selected';
                startPointPreview.className = 'preview-value';
                startPointPath.style.display = 'none';
            }

            // Update node count
            document.getElementById('preview-node-count').textContent = selectedNodes.size;

            // Update confirmation modal preview
            if (currentSelection.selectedTree) {
                $('#confirm-tree').text(currentSelection.selectedTree.name);
            }
            if (currentSelection.startingPoint) {
                $('#confirm-start-point').text(currentSelection.startingPoint.name);
            }
            $('#confirm-node-count').text(`${selectedNodes.size} node${selectedNodes.size !== 1 ? 's' : ''}`);
        }

        function validateSelection() {
            const validationElement = document.getElementById('preview-validation');
            const statusCard = document.getElementById('selection-status-card');

            // Reset validation state
            statusCard.classList.remove('valid', 'invalid');
            $('#updateBatchBtn').prop('disabled', true);

            // Check if tree is selected
            if (!currentSelection.selectedTree) {
                validationElement.textContent = 'Please select a tree first';
                validationElement.className = 'preview-value invalid-selection';
                statusCard.classList.add('invalid');
                return false;
            }

            // Check if starting point is selected
            if (!currentSelection.startingPoint) {
                validationElement.textContent = 'Please select a starting point';
                validationElement.className = 'preview-value invalid-selection';
                statusCard.classList.add('invalid');
                return false;
            }

            // Check if nodes are selected
            if (selectedNodes.size === 0) {
                validationElement.textContent = 'Please select at least one node';
                validationElement.className = 'preview-value invalid-selection';
                statusCard.classList.add('invalid');
                return false;
            }

            // Check if starting point is in selected nodes
            if (!selectedNodes.has(currentSelection.startingPoint.id)) {
                validationElement.textContent = 'Starting point must be one of the selected nodes';
                validationElement.className = 'preview-value invalid-selection';
                statusCard.classList.add('invalid');
                return false;
            }

            // All checks passed
            validationElement.textContent = 'Selection is valid and ready to update';
            validationElement.className = 'preview-value valid-selection';
            statusCard.classList.add('valid');
            $('#updateBatchBtn').prop('disabled', false);
            return true;
        }

        function resetCurrentSelection() {
            currentSelection = {
                selectedTree: null,
                startingPoint: null
            };
            selectedNodes.clear();

            updateUIBasedOnCurrentSelection();
            updateCheckboxStates();
            updateSelectedCount();
            updatePreview();

            document.getElementById('selection-status').innerHTML = 'Please select a tree first.';
            $('#updateBatchBtn').prop('disabled', true);

            // Reset search input
            $('#searchInput').val('');
            fetchAndRenderTree();
        }

        function showUpdateConfirmation() {
            if (!validateSelection()) {
                showTemporaryAlert('Please fix validation errors before updating', 'warning');
                return;
            }

            const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            modal.show();
        }

        function confirmUpdate() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
            modal.hide();

            if (!validateSelection()) {
                showTemporaryAlert('Validation failed. Cannot update batch.', 'danger');
                return;
            }

            // Prepare selected nodes data
            const selectedNodeDetails = [];
            selectedNodes.forEach(id => {
                const nodeElement = document.getElementById(`node-${id}`);
                if (nodeElement) {
                    selectedNodeDetails.push({
                        node_id: id,
                        node_name: nodeElement.dataset.name,
                        parent_id: nodeElement.dataset.parentId ? parseInt(nodeElement.dataset.parentId) : null
                    });
                }
            });

            // Prepare batch data
            const batchData = {
                tree_id: currentSelection.selectedTree.id,
                tree_name: currentSelection.selectedTree.name,
                starting_point_id: currentSelection.startingPoint.id,
                starting_point_name: currentSelection.startingPoint.name,
                selected_nodes: selectedNodeDetails,
                status: 'updated'
            };

            // Show loading state
            const updateBtn = $('#updateBatchBtn');
            updateBtn.prop('disabled', true);
            updateBtn.html('<i class="fas fa-spinner fa-spin me-1"></i> Updating...');

            // Send update request
            $.ajax({
                url: `${batchesApiUrl}/${currentBatchId}`,
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: batchData,
                success: function(response) {
                    showTemporaryAlert('Batch updated successfully!', 'success');
                    // Reload the batch to reflect changes
                    loadBatchForEditing(currentBatchId);
                    updateBtn.html('<i class="fas fa-save me-1"></i> Update Batch');
                },
                error: function(error) {
                    console.error("Error updating batch:", error);
                    showTemporaryAlert('Error updating batch. Please try again.', 'danger');
                    updateBtn.prop('disabled', false);
                    updateBtn.html('<i class="fas fa-save me-1"></i> Update Batch');
                }
            });
        }

        function loadBatchForEditing(batchId) {
            $.ajax({
                url: `${batchesApiUrl}/${batchId}`,
                method: 'GET',
                success: function(response) {
                    const batch = response.data;
                    originalBatchData = batch;

                    // Parse selected nodes
                    const selectedNodesData = typeof batch.selected_nodes === 'string' ?
                        JSON.parse(batch.selected_nodes) : batch.selected_nodes;

                    // Set current selection
                    currentSelection = {
                        selectedTree: {
                            id: batch.tree_id,
                            name: batch.tree_name
                        },
                        startingPoint: {
                            id: batch.starting_point_id,
                            name: batch.starting_point_name
                        }
                    };

                    // Set selected nodes
                    selectedNodes = new Set();
                    selectedNodesData.forEach(node => {
                        selectedNodes.add(parseInt(node.node_id));
                    });

                    // Render the tree
                    fetchAndRenderTree();

                    // Update UI
                    updateUIBasedOnCurrentSelection();
                    updateCheckboxStates();
                    updateSelectedCount();
                    updatePreview();

                    document.getElementById('selection-status').innerHTML =
                        `Editing batch: Tree "<strong>${batch.tree_name}</strong>" with starting point "<strong>${batch.starting_point_name}</strong>"`;

                    // Auto-validate
                    validateSelection();
                },
                error: function(error) {
                    console.error("Error loading batch:", error);
                    showTemporaryAlert('Error loading batch for editing', 'danger');
                }
            });
        }

        function filterTree() {
            const searchQuery = $('#searchInput').val().toLowerCase();
            fetchAndRenderTree(searchQuery);
        }

        function showTemporaryAlert(message, type) {
            // Create the alert container if it doesn't exist
            let alertContainer = document.querySelector('.alert-container');
            if (!alertContainer) {
                alertContainer = document.createElement('div');
                alertContainer.className = 'alert-container position-fixed bottom-0 end-0 m-3';
                alertContainer.style.zIndex = '9999';
                document.body.appendChild(alertContainer);
            }

            // Remove any existing alerts inside the container
            alertContainer.innerHTML = '';

            // Create the alert element
            const alertElement = document.createElement('div');
            alertElement.className = `alert alert-${type} alert-dismissible fade show`;
            alertElement.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;

            // Append to alert container
            alertContainer.appendChild(alertElement);

            // Auto-remove the alert after 3 seconds
            setTimeout(() => {
                alertElement.classList.remove('show');
                setTimeout(() => {
                    alertElement.remove();

                    // Optional: clean up empty container
                    if (alertContainer.children.length === 0) {
                        alertContainer.remove();
                    }

                }, 150);
            }, 1000);
        }

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
    </script>


</body>

</html>
