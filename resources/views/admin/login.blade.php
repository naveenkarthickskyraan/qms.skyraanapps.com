{{-- @include('layouts.admin_app') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title> Bible Quiz - Admin Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/skyraan-technologies.avif') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('assets/css/preloader.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/login_page.css') }}" rel="stylesheet">

    <style>
        .container-login100::before {
            content: "";
            display: block;
            position: absolute;
            z-index: -1;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-image: url('{{ url('assets/img/img-01.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>


<!-- Fonts and icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js" integrity="sha512-v/wOVTkoU7mXEJC3hXnw9AA6v32qzpknvuUF6J2Lbkasxaxn2nYcl+HGB7fr/kChGfCqubVr1n2sq1UFu3Gh1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    WebFont.load({
        google: {
            "families": ["Lato:300,400,700,900"]
        },
        custom: {
            "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                "simple-line-icons"
            ],
            urls: ['../assets/css/fonts.min.css']
        },
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>

<!-- Line Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" rel="stylesheet">

<style>
    :focus {
        outline: 0!important;
        -webkit-box-shadow: none!important;
        box-shadow: none!important
    }

    .alert,.brand,.btn-simple,.h1,.h2,.h3,.h4,.h5,.h6,.navbar,.td-name,a,body,button.close,h1,h2,h3,h4,h5,h6,p,td {
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        font-family: Lato,sans-serif
    }

    body {
        font-size: 16px;
        color: #575962
    }

    body {
        min-height: 100vh;
        position: relative;
        background: #f9fbfd
    }


    .form-floating-label {
        position: relative
    }

    .form-floating-label .placeholder {
        position: absolute;
        padding: .375rem .75rem;
        transition: all .2s;
        opacity: .8;
        margin-bottom: 0!important;
        font-size: 14px!important;
        font-weight: 400;
        top: 12px
    }

    .form-floating-label .form-control.filled+.placeholder,.form-floating-label .form-control:focus+.placeholder,.form-floating-label .form-control:valid+.placeholder {
        font-size: 85%!important;
        transform: translate3d(0,-10px,0);
        top: 0;
        opacity: 1;
        padding: .375rem 0 .75rem;
        font-weight: 600
    }

    .form-floating-label .form-control.filled+.placeholder {
        color: #1572e8!important
    }

    .form-floating-label .form-control ::-webkit-input-placeholder {
        color: transparent
    }

    .form-floating-label .form-control :-moz-placeholder {
        color: transparent
    }

    .form-floating-label .form-control ::-moz-placeholder {
        color: transparent
    }

    .form-floating-label .form-control :-ms-input-placeholder {
        color: transparent
    }

    .form-floating-label .input-border-bottom+.placeholder {
        padding: .375rem 0 .75rem
    }

    .form-inline label {
        margin-bottom: 0!important;
        display: flow-root
    }
    .col-form-label {
        font-size: 16px;
        font-weight: 600;
    }

    .select2-input {
        position: relative
    }

    .select2-input label.error,.select2-input label.success {
        position: absolute;
        bottom: -30px
    }

    .select2-input .select2 {
        margin-bottom: 15px
    }


    .alert {
        border: 0;
        position: relative;
        padding: .95rem 1.25rem;
        border-radius: 1px;
        color: inherit;
        background-color: #fff;
        -webkit-box-shadow: 1px 1px 14px 0 rgba(18,38,63,.26);
        -moz-box-shadow: 1px 1px 14px 0 rgba(18,38,63,.26);
        box-shadow: 1px 1px 14px 0 rgba(18,38,63,.26)
    }

    .alert [data-notify=icon] {
        display: block
    }

    .alert [data-notify=icon]::before {
        line-height: 35px;
        font-size: 22px;
        display: block;
        left: 15px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 35px;
        height: 35px;
        border-radius: 30px;
        text-align: center;
        color: #fff
    }

    .alert [data-notify=title] {
        display: block;
        color: #2b2b2b;
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 5px
    }

    .alert [data-notify=message] {
        font-size: 13px;
        color: #908e8e
    }

    .alert .close {
        background: rgba(255,255,255,.8);
        width: 25px;
        height: 25px;
        line-height: 25px;
        top: 12px!important;
        border-radius: 50%
    }

    .alert-default {
        border-left: 4px solid #1a2035
    }

    .alert-default [data-notify=icon]:before {
        background: #1a2035
    }

    .alert-primary {
        border-left: 4px solid #1572e8
    }

    .alert-primary [data-notify=icon]:before {
        background: #1572e8
    }

    .alert-secondary {
        border-left: 4px solid #6861ce
    }

    .alert-secondary [data-notify=icon]:before {
        background: #6861ce
    }

    .alert-info {
        border-left: 4px solid #48abf7
    }

    .alert-info [data-notify=icon]:before {
        background: #48abf7
    }

    .alert-success {
        border-left: 4px solid #31ce36
    }

    .alert-success [data-notify=icon]:before {
        background: #31ce36
    }

    .alert-warning {
        border-left: 4px solid #ffad46
    }

    .alert-warning [data-notify=icon]:before {
        background: #ffad46
    }

    .alert-danger {
        border-left: 4px solid #f25961
    }

    .alert-danger [data-notify=icon]:before {
        background: #f25961
    }

    .btn {
        padding: .65rem 1.4rem;
        font-size: 14px;
        opacity: 1;
        border-radius: 3px
    }

    .btn:focus,.btn:hover {
        opacity: .9;
        transition: all .3s
    }

    .btn .btn-label {
        display: inline-block
    }

    .btn .btn-label i {
        font-size: 16px;
        vertical-align: middle;
        margin-right: 2px;
        margin-left: -2px;
        line-height: 0;
        margin-top: -2.5px
    }

    .btn .btn-label.just-icon i {
        margin-left: 0!important;
        margin-right: 0!important
    }

    .btn-lg {
        font-size: 15px;
        border-radius: 3px;
        padding: 12.5px 27.5px;
        font-weight: 400
    }

    .btn-lg .btn-label i {
        font-size: 27px;
        vertical-align: middle;
        margin-right: 2px;
        margin-left: -7px;
        line-height: 0;
        margin-top: -2.5px
    }

    .btn-lg .btn-label.just-icon i {
        margin-left: 0!important;
        margin-right: 0!important
    }

    .btn-sm {
        font-size: 11px;
        padding: 7px 13px
    }

    .btn-xs {
        font-size: 10px;
        padding: 5px 9px
    }

    .btn.disabled:hover,.btn:hover:disabled {
        opacity: .65
    }

    .btn-icon {
        font-size: .9375rem;
        height: 2.5125rem;
        line-height: normal;
        min-width: 2.5125rem;
        overflow: hidden;
        padding: 0;
        position: relative;
        width: 2.5125rem
    }

    .btn-icon.btn-lg {
        height: 2.75rem;
        min-width: 2.75rem;
        width: 2.75rem
    }

    .btn-icon.btn-sm {
        height: 2rem;
        min-width: 2rem;
        width: 2rem
    }

    .btn-icon.btn-xs {
        height: 1.6875rem;
        min-width: 1.6875rem;
        width: 1.6875rem
    }

    .btn-white {
        background: #fff!important;
        color: #1a2035!important
    }

    .btn-white:disabled,.btn-white:focus,.btn-white:hover {
        background: #fff!important;
        color: #1a2035!important
    }

    .btn-default {
        background: #1a2035!important;
        color: #fff!important
    }

    .btn-default:disabled,.btn-default:focus,.btn-default:hover {
        background: #1a2035!important;
        color: #fff!important
    }

    .btn-primary {
        background: #1572e8!important;
        border-color: #1572e8!important
    }

    .btn-primary:disabled,.btn-primary:focus,.btn-primary:hover {
        background: #1572e8!important;
        border-color: #1572e8!important
    }

    .btn-secondary {
        background: #6861ce!important;
        border-color: #6861ce!important
    }

    .btn-secondary:disabled,.btn-secondary:focus,.btn-secondary:hover {
        background: #6861ce!important;
        border-color: #6861ce!important
    }

    .btn-info {
        background: #48abf7!important;
        border-color: #48abf7!important
    }

    .btn-info:disabled,.btn-info:focus,.btn-info:hover {
        background: #48abf7!important;
        border-color: #48abf7!important
    }

    .btn-success {
        background: #31ce36!important;
        border-color: #31ce36!important
    }

    .btn-success:disabled,.btn-success:focus,.btn-success:hover {
        background: #31ce36!important;
        border-color: #31ce36!important
    }

    .btn-warning {
        background: #ffad46!important;
        border-color: #ffad46!important;
        color: #fff!important
    }

    .btn-warning:disabled,.btn-warning:focus,.btn-warning:hover {
        background: #ffad46!important;
        border-color: #ffad46!important;
        color: #fff!important
    }

    .btn-danger {
        background: #f25961!important;
        border-color: #f25961!important
    }

    .btn-danger:disabled,.btn-danger:focus,.btn-danger:hover {
        background: #f25961!important;
        border-color: #f25961!important
    }

    .btn-light {
        background: #fff!important;
        border-color: transparent
    }

    .btn-light:disabled,.btn-light:focus,.btn-light:hover {
        background: #ebecec!important;
        border-color: transparent
    }

    .btn-dropdown-card-header {
        padding: 0;
        background: 0 0;
        color: inherit;
        font-size: 15px
    }

    .btn-dropdown-card-header:after {
        display: none
    }

    .btn-border {
        background: 0 0!important
    }

    .btn-border:focus,.btn-border:hover {
        background: 0 0!important
    }

    .btn-border.btn-white {
        color: #fff!important;
        border: 1px solid #fff!important
    }

    .btn-border.btn-default {
        color: #1a2035!important;
        border: 1px solid #1a2035!important
    }

    .btn-border.btn-primary {
        color: #1572e8!important;
        border: 1px solid #1572e8!important
    }

    .btn-border.btn-secondary {
        color: #6861ce!important;
        border: 1px solid #6861ce!important
    }

    .btn-border.btn-info {
        color: #48abf7!important;
        border: 1px solid #48abf7!important
    }

    .btn-border.btn-success {
        color: #31ce36!important;
        border: 1px solid #31ce36!important
    }

    .btn-border.btn-warning {
        color: #ffad46!important;
        border: 1px solid #ffad46!important
    }

    .btn-border.btn-danger {
        color: #f25961!important;
        border: 1px solid #f25961!important
    }

    .btn-border.btn-light {
        border: 1px solid #efefef;
        background: #fff!important
    }

    .btn-round {
        border-radius: 100px!important
    }

    .btn-link {
        border: 0!important;
        background: 0 0!important
    }

    .btn-link:focus,.btn-link:hover {
        text-decoration: underline!important;
        background: 0 0!important;
        border: 0!important
    }

    .btn-link.btn-default {
        color: #1a2035!important
    }

    .btn-link.btn-default:hover {
        color: #1a2035!important
    }

    .btn-link.btn-primary {
        color: #1572e8!important
    }

    .btn-link.btn-primary:hover {
        color: #1572e8!important
    }

    .btn-link.btn-secondary {
        color: #6861ce!important
    }

    .btn-link.btn-secondary:hover {
        color: #6861ce!important
    }

    .btn-link.btn-info {
        color: #48abf7!important
    }

    .btn-link.btn-info:hover {
        color: #48abf7!important
    }

    .btn-link.btn-success {
        color: #31ce36!important
    }

    .btn-link.btn-success:hover {
        color: #31ce36!important
    }

    .btn-link.btn-warning {
        color: #ffad46!important
    }

    .btn-link.btn-warning:hover {
        color: #ffad46!important
    }

    .btn-link.btn-danger {
        color: #f25961!important
    }

    .btn-link.btn-danger:hover {
        color: #f25961!important
    }

    .toggle-on.btn {
        color: #fff!important
    }

    .toggle-handle {
        background: #fff!important
    }

    .toggle-handle:hover {
        background: #fff!important
    }

    .btn-round .toggle-handle {
        border-radius: 50px
    }

    .btn-rounded {
        border-radius: 60px!important
    }

    .btn-full {
        width: 100%
    }

    .btn-no-radius {
        border-radius: 0
    }

    table.dataTable {
        clear: both;
        margin-top: 15px!important;
        margin-bottom: 15px!important;
        max-width: none!important;
        border-collapse: separate!important
    }

    table.dataTable td,table.dataTable th {
        -webkit-box-sizing: content-box;
        box-sizing: content-box
    }

    table.dataTable td.dataTables_empty,table.dataTable th.dataTables_empty {
        text-align: center
    }

    table.dataTable.nowrap td,table.dataTable.nowrap th {
        white-space: nowrap
    }

    div.dataTables_wrapper div.dataTables_length label {
        font-weight: 400;
        text-align: left;
        white-space: nowrap
    }

    div.dataTables_wrapper div.dataTables_length select {
        width: 75px;
        display: inline-block
    }

    div.dataTables_wrapper div.dataTables_filter {
        text-align: right
    }

    div.dataTables_wrapper div.dataTables_filter label {
        font-weight: 400;
        white-space: nowrap;
        text-align: left
    }

    div.dataTables_wrapper div.dataTables_filter input {
        margin-left: .5em;
        display: inline-block;
        width: auto
    }

    div.dataTables_wrapper div.dataTables_info {
        padding-top: .85em;
        white-space: nowrap
    }

    div.dataTables_wrapper div.dataTables_paginate {
        margin: 0;
        white-space: nowrap;
        text-align: right
    }

    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        margin: 2px 0;
        white-space: nowrap;
        justify-content: flex-end
    }

    div.dataTables_wrapper div.dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;
        margin-left: -100px;
        margin-top: -26px;
        text-align: center;
        padding: 1em 0
    }

    table.dataTable thead>tr>td.sorting,table.dataTable thead>tr>td.sorting_asc,table.dataTable thead>tr>td.sorting_desc,table.dataTable thead>tr>th.sorting,table.dataTable thead>tr>th.sorting_asc,table.dataTable thead>tr>th.sorting_desc {
        padding-right: 30px
    }

    table.dataTable thead>tr>td:active,table.dataTable thead>tr>th:active {
        outline: 0
    }

    table.dataTable thead .sorting,table.dataTable thead .sorting_asc,table.dataTable thead .sorting_asc_disabled,table.dataTable thead .sorting_desc,table.dataTable thead .sorting_desc_disabled {
        cursor: pointer;
        position: relative
    }

    table.dataTable thead .sorting:after,table.dataTable thead .sorting:before,table.dataTable thead .sorting_asc:after,table.dataTable thead .sorting_asc:before,table.dataTable thead .sorting_asc_disabled:after,table.dataTable thead .sorting_asc_disabled:before,table.dataTable thead .sorting_desc:after,table.dataTable thead .sorting_desc:before,table.dataTable thead .sorting_desc_disabled:after,table.dataTable thead .sorting_desc_disabled:before {
        position: absolute;
        bottom: .9em;
        display: block;
        opacity: .5
    }

    table.dataTable thead .sorting:before,table.dataTable thead .sorting_asc:before,table.dataTable thead .sorting_asc_disabled:before,table.dataTable thead .sorting_desc:before,table.dataTable thead .sorting_desc_disabled:before {
        right: 1em;
        content: "\2191";
        font-size: 15px
    }

    table.dataTable thead .sorting:after,table.dataTable thead .sorting_asc:after,table.dataTable thead .sorting_asc_disabled:after,table.dataTable thead .sorting_desc:after,table.dataTable thead .sorting_desc_disabled:after {
        right: .5em;
        content: "\2193";
        font-size: 15px
    }

    table.dataTable thead .sorting_asc:before,table.dataTable thead .sorting_desc:after {
        opacity: 1
    }

    table.dataTable thead .sorting_asc_disabled:before,table.dataTable thead .sorting_desc_disabled:after {
        opacity: 0
    }

    div.dataTables_scrollHead table.dataTable {
        margin-bottom: 0!important
    }

    div.dataTables_scrollBody table {
        border-top: none;
        margin-top: 0!important;
        margin-bottom: 0!important
    }

    div.dataTables_scrollBody table thead .sorting:after,div.dataTables_scrollBody table thead .sorting_asc:after,div.dataTables_scrollBody table thead .sorting_desc:after {
        display: none
    }

    div.dataTables_scrollBody table tbody tr:first-child td,div.dataTables_scrollBody table tbody tr:first-child th {
        border-top: none
    }

    div.dataTables_scrollFoot>.dataTables_scrollFootInner {
        box-sizing: content-box
    }

    div.dataTables_scrollFoot>.dataTables_scrollFootInner>table {
        margin-top: 0!important;
        border-top: none
    }

    @media screen and (max-width: 767px) {
        div.dataTables_wrapper div.dataTables_filter,div.dataTables_wrapper div.dataTables_info,div.dataTables_wrapper div.dataTables_length,div.dataTables_wrapper div.dataTables_paginate {
            text-align:center;
            margin-top: 11px;
            margin-bottom: 10px
        }

        div.dataTables_wrapper div div.dataTables_paginate ul.pagination {
            flex-wrap: wrap!important;
            justify-content: center!important
        }

        div.dataTables_wrapper div div.dataTables_paginate ul.pagination li {
            margin-bottom: 10px
        }

        div.dataTables_wrapper div div.dataTables_paginate ul.pagination li a {
            font-size: 11px
        }
    }

    table.dataTable.table-sm>thead>tr>th {
        padding-right: 20px
    }

    table.dataTable.table-sm .sorting:before,table.dataTable.table-sm .sorting_asc:before,table.dataTable.table-sm .sorting_desc:before {
        top: 5px;
        right: .85em
    }

    table.dataTable.table-sm .sorting:after,table.dataTable.table-sm .sorting_asc:after,table.dataTable.table-sm .sorting_desc:after {
        top: 5px
    }

    table.table-bordered.dataTable td,table.table-bordered.dataTable th {
        border-left-width: 0
    }

    table.table-bordered.dataTable td:last-child,table.table-bordered.dataTable th:last-child {
        border-right-width: 0
    }

    table.table-bordered.dataTable tbody td,table.table-bordered.dataTable tbody th {
        border-bottom-width: 0
    }

    div.dataTables_scrollHead table.table-bordered {
        border-bottom-width: 0
    }

    div.table-responsive>div.dataTables_wrapper>div.row {
        margin: 0
    }

    div.table-responsive>div.dataTables_wrapper>div.row>div[class^=col-]:first-child,div.table-responsive>div.dataTables_wrapper>div.row>div[class^=col-]:last-child {
        padding-left: 0;
        padding-right: 0
    }
</style>
</head>

<body class="overflow-hidden">

    <main style="background-color: #bfd6ec;min-height: 100vh;">
        {{-- <div class="limiter"> --}}
        <div class="container-login100">

            <div id="pre-loader" class="pre-loader">
                <div class="loader">
                </div>
            </div>

            <div class="container">

                <header class="mt-3"
                    style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <div class="logo"></div>
                    <div class="menu">
                        <div class="d-flex justify-content-center align-content-center align-items-center">
                            <i class="fa fa-solid fa-praying-hands" style="font-size: 30px;"></i>
                            <h2>&nbsp;: Bible Quiz – for Categorizing, Mapping, and Organizing Subcategory-based Questions with App Integration.
                            </h2>
                        </div>
                    </div>
                </header>

                <section class="section register d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
                                style="padding-bottom:114px;overflow:hidden;">
                                <div class="card"
                                    style="box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);">
                                    @php
                                        $currentDateTime = \Carbon\Carbon::now();
                                        $formattedDateTime = $currentDateTime->format('D d, M Y');
                                    @endphp
                                    <div class="card-body" style="background-color: #FFFFFF;">
                                        <div class="float-end mt-1">
                                            <h5 class="form-label fw-bold"
                                                style="text-transform: uppercase!important;color:#0858cf !important  ">
                                                {{ $formattedDateTime }}</h5>
                                        </div>
                                        <br>
                                        <div class="pt-4 text-center">
                                            <img src="{{ asset('assets/img/skyraan-technologies.avif') }}"
                                                width="15%" />
                                        </div>
                                        {{-- <div
                                            class="d-flex justify-content-center align-content-center align-items-center">
                                            <h5 class="card-title text-center pb-0 fs-4"><i class="fa fa-brands fa-adversal"
                                                    style="font-size: 25px;margin-top:5px;"></i> Ads Management Dashboard</h5>
                                        </div> --}}
                                        <p class="text-center small pb-0">Log into your account</p>

                                        <form class="row g-3 needs-validation" id="validation_form" method="POST"
                                            action="{{ route('admin.auth') }}" novalidate>
                                            @csrf

                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label fw-bold"
                                                    style="text-transform: uppercase!important;  ">Username / Email
                                                    <span class="text-danger">*</span> </label>
                                                <div class="input-group has-validation">
                                                    <input type="email" name="email" class="form-control"
                                                        id="yourUsername" value="{{ old('email') }}"
                                                        placeholder="Enter a Email here!..." required
                                                        style="height: 41px;">
                                                    <div class="invalid-feedback">Please enter your Email.</div>
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="yourPassword" class="form-label fw-bold"
                                                    style="text-transform: uppercase!important;  ">Password <span
                                                        class="text-danger">*</span> </label>
                                                <div class="input-group mb-1">
                                                    <input type="password" name="password" class="form-control"
                                                        id="yourPassword" value="{{ old('password') }}"
                                                        placeholder="Enter a Password here!..." required>
                                                    <span class="input-group-text"
                                                        style="border-top-right-radius:7px;border-bottom-right-radius:7px;cursor: pointer;"><i
                                                            class="mdi mdi-eye-off mdi-18px" aria-hidden="true"
                                                            id="togglePassword"></i></span>
                                                    <div class="invalid-feedback">Please enter your password!</div>
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <label for="key" class="form-label fw-bold"
                                                    style="text-transform: uppercase!important;  ">Unlock Your
                                                    Account <span class="text-danger">*</span> </label>
                                                <input type="text" name="password2"
                                                    value="{{ old('password2') }}" class="form-control key-input"
                                                    id="key" placeholder="Enter a key to login here!..."
                                                    required autocomplete="off">
                                                <div class="invalid-feedback">Please enter your secret key!</div>
                                            </div>


                                            <div class="col-12 text-center">

                                                @if ($errors->has('captcha'))
                                                    <span class="help-block">
                                                        <div class="text-danger">
                                                            <strong>{{ $errors->first('captcha') }}</strong>
                                                        </div>
                                                    </span>
                                                @endif

                                                <a class="btn btn-primary" id="loginLink"
                                                    style="background-color: #1269db !important;border: 1px solid #1269db;">Gain
                                                    access</a>

                                                <div id="demo-modal" class="modal">
                                                    <div class="modal__content">
                                                        <label for="key" class="form-label fw-bold">Unlock Your
                                                            Account</label>
                                                        <div class="captcha">
                                                            <span>{!! captcha_img('flat', ['characters' => '0123456789', 'class' => 'img-responsive'], 'numeric', 4) !!}</span>
                                                            <button type="button" onclick="refreshCaptcha()"
                                                                class="btn btn-success btn-refresh btn-sm"><i
                                                                    class="fa fa-refresh"></i></button>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <div class="email-otp-container">
                                                                <!-- Six input fields for OTP digits -->
                                                                <input type="text" class="email-otp-input"
                                                                    maxlength="1" name="captcha1">
                                                                <input type="text" class="email-otp-input"
                                                                    pattern="\d" maxlength="1" disabled
                                                                    name="captcha2">
                                                                <input type="text" class="email-otp-input"
                                                                    pattern="\d" maxlength="1" disabled
                                                                    name="captcha3">
                                                                <input type="text" class="email-otp-input"
                                                                    pattern="\d" maxlength="1" name="captcha4"
                                                                    disabled>
                                                            </div>
                                                            <!-- Field to display entered OTP -->
                                                            <input type="text" id="emailverificationCode"
                                                                placeholder="Enter verification code" readonly hidden>
                                                        </div>
                                                        <br>
                                                        <button type="button" class="btn btn-primary"
                                                            id="login_for_submit" data-bs-dismiss="modal">Sign
                                                            In</button>
                                                        <a class="modal__close" id="modalCloseButton"
                                                            style="cursor: pointer">&times;</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="credits">
                                </div>

                            </div>
                        </div>
                    </div>

                </section>

            </div>
        </div>
        {{-- </div> --}}
    </main><!-- End #main -->

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

    <script>
        function refreshCaptcha() {
            var captchaImage = document.querySelector('.captcha img');
            captchaImage.src = captchaImage.src.split('?')[0] + '?' + Math.random();
            $('.email-otp-input').val('');
        }

        const modal = document.getElementById("demo-modal");
        const loginLink = document.getElementById("loginLink");
        const modalCloseButton = document.getElementById("modalCloseButton");

        loginLink.addEventListener("click", function(event) {
            event.preventDefault();
            modal.style.visibility = "visible";
            modal.style.opacity = "1";
        });

        modalCloseButton.addEventListener("click", function() {
            modal.style.visibility = "hidden";
            modal.style.opacity = "0";
        });
    </script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#yourPassword');
        togglePassword.addEventListener('click', () => {
            if (password.getAttribute('type') == 'password') {
                $('#togglePassword').removeClass('mdi-eye-off');
                $('#togglePassword').addClass('mdi-eye');
            } else {
                $('#togglePassword').addClass('mdi-eye-off');
                $('#togglePassword').removeClass('mdi-eye');
            }
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        });
    </script>
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @elseif (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @elseif (Session::has('message'))
                toastr.success("{{ Session::get('message') }}");
            @endif
        });

        $('#login_for_submit').on('click', function() {
            if (1 == 1) {
                $('#pre-loader').removeClass('active-is');
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                $('#login_for_submit').addClass('bg-secondary');
                $('#login_for_submit').css('background', 'none');
                $('#login_for_submit').text('Signing In..');
                if ($('#yourPassword').val() == "" || $('#yourUsername').val() == "") {
                    if ($('#yourPassword').val() == "") {
                        toastr.error("Authenticating Failed …");
                        $('#yourPassword').addClass('is-invalid');
                        $('#login_for_submit').css('background', '#1e2844');
                        $('#login_for_submit').text('Sign In');
                    }
                    if ($('#yourUsername').val() == "") {
                        $('#yourUsername').addClass('is-invalid');
                        toastr.error("Authenticating Failed …");
                        $('#login_for_submit').css('background', '#1e2844');
                        $('#login_for_submit').text('Sign In');
                    }
                } else {

                    $('#login_for_submit').addClass('bg-secondary');
                    $('#login_for_submit').css('background', 'none');
                    $('#login_for_submit').text('Signing In..');
                    // $('#login_for_submit').html('<span class="fa fa-spinner fa-2x fa-spin"></span>');

                    $('#yourUsername').removeClass('is-invalid');
                    $('#yourPassword').removeClass('is-invalid');
                    toastr.success("Login successful. Redirecting …");

                    setTimeout(() => {
                        let overlay = document.getElementsByClassName('pre-loader')[0];
                        overlay.classList.toggle('is-active');
                        $('#validation_form').submit();
                    }, 500);
                }
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var otpInputs = document.querySelectorAll(".otp-input");
            var emailOtpInputs = document.querySelectorAll(".email-otp-input");

            function setupOtpInputListeners(inputs) {
                inputs.forEach(function(input, index) {
                    input.addEventListener("paste", function(ev) {
                        var clip = ev.clipboardData.getData('text').trim();
                        if (!/^[a-zA-Z0-9]{6}$/.test(clip)) {
                            ev.preventDefault();
                            return;
                        }

                        var characters = clip.split("");
                        inputs.forEach(function(otpInput, i) {
                            otpInput.value = characters[i] || "";
                        });

                        enableNextBox(inputs[0], 0);
                        inputs[3].removeAttribute("disabled");
                        inputs[3].focus();
                        updateOTPValue(inputs);
                    });

                    input.addEventListener("input", function() {
                        var currentIndex = Array.from(inputs).indexOf(this);
                        var inputValue = this.value.trim();
                        if (inputValue && currentIndex < 3) {
                            inputs[currentIndex + 1].removeAttribute("disabled");
                            inputs[currentIndex + 1].focus();
                        }

                        if (currentIndex === 3 && inputValue) {
                            inputs[3].removeAttribute("disabled");
                            inputs[3].focus();
                        }

                        updateOTPValue(inputs);
                    });

                    input.addEventListener("keydown", function(ev) {
                        var currentIndex = Array.from(inputs).indexOf(this);

                        if (!this.value && ev.key === "Backspace" && currentIndex > 0) {
                            inputs[currentIndex - 1].focus();
                        }
                    });
                });
            }

            function enableNextBox(input, currentIndex) {
                var inputValue = input.value;

                if (inputValue === "") {
                    return;
                }

                var nextIndex = currentIndex + 1;
                var nextBox = otpInputs[nextIndex] || emailOtpInputs[nextIndex];

                if (nextBox) {
                    nextBox.removeAttribute("disabled");
                }
            }

            function updateOTPValue(inputs) {
                var otpValue = "";

                inputs.forEach(function(input) {
                    otpValue += input.value;
                });

                if (inputs === otpInputs) {
                    document.getElementById("verificationCode").value = otpValue;
                } else if (inputs === emailOtpInputs) {
                    document.getElementById("emailverificationCode").value = otpValue;
                }
            }

            setupOtpInputListeners(otpInputs);
            setupOtpInputListeners(emailOtpInputs);

            // otpInputs[0].focus(); // Set focus on the first OTP input field
            emailOtpInputs[0].focus(); // Set focus on the first email OTP input field

            // otpInputs[5].addEventListener("input", function () {
            //   updateOTPValue(otpInputs);
            // });
        });
    </script>
</body>

</html>
