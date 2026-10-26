<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Quiz App - Add Quiz Info</title>
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
    <link href="{{ asset('assets/css/quiz.css') }}" rel="stylesheet">
    <style>
        .cke_notifications_area{
            display:none !important;
        }
    </style>
</head>

<body class="toggle-sidebar">
    @include('admin.navbar')
    <!-- ======= Sidebar ======= -->
    @include('admin.sidebar')

    <div id="pre-loader" class="pre-loader is-active">
        <div class="loader">
        </div>
    </div>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1><i class="fa fa-coins"></i>&nbsp;&#11162;&nbsp;Quizzes or Question List (Add Form)</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/quiz_list') }}">Quizzes or Question
                            List</a></li>
                    <li class="breadcrumb-item active">List of Quizzes or Question Table</li>
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

        <div class="alert-container"></div>

        <div class="row">
            <div class="col-md-9 grid-margin stretch-card">
                <div class="card" style="background-color: #fff;">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0" style="color: #012970 !important;">
                            <i class="fas fa-folder-tree me-2"></i>Question Add Page Based on Selection of SubCategories Form</h4>
                    </div>

                    <div class="card-body">
                        <form class="forms-sample" action="{{ url('admin/quiz.insert') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <hr class="text-dark">
                            <div class="container px-2">

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="exampleInputUsername2" class="col-sm-12 col-form-label h2 text-dark"
                                            style="padding-left: 10px">Select Nested Categories <span style="color:red;">&nbsp;*</span></label>

                                        <div class="container px-2">
                                            <div class="card">
                                                <div class="card-body mt-3">
                                                    <div class="search-container">
                                                        <i class="fas fa-search search-icon"></i>
                                                        <input type="search" id="searchInput" class="form-control" placeholder="Search subcategories...">
                                                    </div>
                                                    <div id="tree-container" class="tree-container">
                                                        <div class="empty-message">
                                                            <i class="fas fa-folder-open fa-2x mb-2"></i>
                                                            <p>No subcategories found.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row" id="div_quiz_question">
                                    <label class="col-sm-12 col-form-label h2 text-dark" for="quiz_question">
                                        Question Format type:
                                    </label>
                                    <div class="col-md-12 d-flex flex-wrap align-items-center" style="padding-left: 20px !important;">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="question_format_type" value="1" ... {{ old('question_format_type', 1) == 1 ? 'checked' : '' }}>

                                            <label class="form-check-label pr-3 pl-1 text-dark" for="ques_default_text">Normal text</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <i<input type="radio" name="question_format_type" value="2" ... {{ old('question_format_type') == 2 ? 'checked' : '' }}>

                                            <label class="form-check-label pr-3 pl-1 text-dark" for="ques_html_text">HTML text</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input type="radio" name="question_format_type" value="3" ... {{ old('question_format_type') == 3 ? 'checked' : '' }}>

                                            <label class="form-check-label pr-3 pl-1 text-dark" for="ques_default_text_3">Image text</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="question_format_type" value="4" ... {{ old('question_format_type') == 4 ? 'checked' : '' }}>

                                            <label class="form-check-label pr-3 pl-1 text-dark" for="ques_default_text_4">Video text</label>
                                        </div>
                                        <span class="text-danger ml-3" id="question_format_type_error"></span>
                                    </div>
                                </div>


                                <!--show for question with video-->
                                <div id="showforquesvideo">
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for="showforquesdefault"
                                                class=" col-sm-12 col-form-label h2 text-dark">Question
                                                Name<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12 p-2" style="padding-left: 20px !important;">
                                            <textarea name="question_name_video" class="form-control input-full" rows="5" id="quiz_question_default_image"
                                                style="height:100px;">{{ old('question_name') }}</textarea>
                                            <span class="text-danger"
                                                id="error_quiz_question_default"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for="video_type_file"
                                                class=" col-sm-12 col-form-label h2 text-dark">[Video
                                                File Type]</label>
                                        </div>
                                        <div class="col-sm-12" style="padding-left: 20px !important;">
                                            <input type="file"
                                                class="form-control ih-medium ip-light radius-xs b-light px-15"
                                                accept="video/*" name="video_file"
                                                id="video_type_file">
                                        </div>
                                    </div>

                                </div>


                                <!--show for question with image-->
                                <div id="showforquesImage">
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for="showforquesdefault"
                                                class=" col-sm-12 col-form-label h2 text-dark">Question
                                                Name <span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12 p-2" style="padding-left: 20px !important;">
                                            <textarea name="question_name_image" class="form-control input-full" rows="5" id="quiz_question_default_video"
                                                style="height:100px;">{{ old('question_name') }}</textarea>
                                            <span class="text-danger"
                                                id="error_quiz_question_default"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for="video_type_file"
                                                class=" col-sm-12 col-form-label h2 text-dark">Image
                                                File Type</label>
                                        </div>
                                        <div class="col-sm-12" style="padding-left: 20px !important;">
                                            <input type="file"
                                                class="form-control ih-medium ip-light radius-xs b-light px-15"
                                                accept="image/*" name="image_file" id="imgInp">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for="video_type_file"
                                                class=" col-sm-12 col-form-label h2 text-dark">[Image
                                                File Preview]</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <img id="blah" src="#" alt="" />
                                        </div>
                                    </div>
                                </div>

                                <!--show for question html-->

                                <div class="form-group row" id="showforqueshtml">
                                    <div class="col-sm-12 d-flex aling-items-center">
                                        <label for="showforqueshtml"
                                            class=" col-sm-12 col-form-label h2 text-dark">Question Name
                                            <span style="color:red;">&nbsp;*</span></label>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 20px !important;">
                                        <textarea class="form-control" name="question_name_html" rows="5" id="quiz_question_html">{{ old('question_name') }}</textarea>
                                        <span class="text-danger"
                                            id="error_quiz_question_html"></span>
                                    </div>
                                </div>

                                <!--show for question default-->

                                <div class="form-group row" id="showforquesdefault">
                                    <div class="col-sm-12 d-flex aling-items-center">
                                        <label for="showforquesdefault"
                                            class=" col-sm-12 col-form-label h2 text-dark">Question Name<span
                                                style="color:red;">&nbsp;*</span></label>
                                    </div>
                                    <div class="col-md-12 p-2" style="padding-left: 20px !important;">
                                        <textarea name="question_name" class="form-control input-full" rows="5" id="quiz_question_default"
                                            style="height:100px;">{{ old('question_name') }}</textarea>
                                        <span class="text-danger"
                                            id="error_quiz_question_default"></span>
                                    </div>
                                </div>
                                <br>




                                <div class="form-group row">
                                    <div class="col-sm-12 d-flex aling-items-center">
                                        <label for="showforqueshtml"
                                            class=" col-sm-12 col-form-label h2 text-dark">No
                                            of Options<span style="color:red;">&nbsp;*</span></label>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 20px !important;">
                                        <select name="option_count" id="ppl" class="form-control" style="width:100%;" required onchange="optionlist()">
                                            <option disabled {{ old('option_count') ? '' : 'selected' }}>Select Option</option>
                                            @for ($i = 1; $i <= 6; $i++)
                                                <option value="{{ $i }}" {{ old('option_count') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <span class="text-danger" id="error_option_count"></span>
                                    </div>
                                </div>

                                <div class="form-group row" id="change_option">
                                    <label class="col-sm-12 col-form-label h2 text-dark" for="">
                                        Option Format type:
                                    </label>
                                    <div class="col-md-12 d-flex flex-wrap align-items-center" style="padding-left: 20px !important;">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="option_format_type" value="0" ... {{ old('option_format_type', 0) == 0 ? 'checked' : '' }}>

                                            <label class="form-check-label pr-3 pl-1" for="opt_default_text">Normal text</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="option_format_type" value="1" ... {{ old('option_format_type') == 1 ? 'checked' : '' }}>

                                            <label class="form-check-label pr-3 pl-1" for="opt_html_text">HTML text</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="option_format_type" value="2" ... {{ old('option_format_type') == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label pr-3 pl-1" for="opt_file_text">File Option</label>
                                        </div>
                                        <!-- If needed in future -->
                                        <!--
                                        <div class="form-check form-check-inline" id="jumpled_words_option" style="display: none;">
                                            <input type="radio" name="option_format_type" class="form-check-input opt_text_type"
                                                value="3" id="opt_jumpled_words" onchange="optionishtml()">
                                            <label class="form-check-label" for="opt_jumpled_words">Jumpled Words</label>
                                        </div>
                                        -->
                                        <p class="text-danger err_msg ml-3" id="err_quiz_question"></p>
                                    </div>
                                </div>




                                <!--show for opt html-->
                                <div id="showforopthtml">
                                    <div class="form-group row" id="text_html_1">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for=""
                                                class="col-sm-12 col-form-label h2 text-dark">Option
                                                1<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <textarea name="option_1_html" class="form-control input-full" rows="5" id="quiz_option1_html"
                                                style="height:100px;">{{ old('option_1_html') }}</textarea>
                                            <span class="text-danger" id="error_option_1_html"></span>
                                        </div>
                                    </div>


                                    <div class="form-group row" id="text_html_2">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for=""
                                                class=" col-sm-12 col-form-label h2 text-dark">Option
                                                2<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <textarea name="option_2_html" class="form-control input-full" rows="5" id="quiz_option2_html"
                                                style="height:100px;">{{ old('option_2_html') }}</textarea>
                                            <span class="text-danger" id="error_option_2_html"></span>
                                        </div>
                                    </div>


                                    <div class="form-group row" id="text_html_3">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for=""
                                                class=" col-sm-12 col-form-label h2 text-dark">Option
                                                3<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <textarea name="option_3_html" class="form-control input-full" rows="5" id="quiz_option3_html"
                                                style="height:100px;">{{ old('option_3_html') }}</textarea>

                                            <span class="text-danger" id="error_option_3_html"></span>

                                        </div>
                                    </div>

                                    <div class="form-group row" id="text_html_4">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for=""
                                                class=" col-sm-12 col-form-label h2 text-dark">Option
                                                4<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <textarea name="option_4_html" class="form-control input-full" rows="5" id="quiz_option4_html"
                                                style="height:100px;">{{ old('option_4_html') }}</textarea>

                                            <span class="text-danger" id="error_option_4_html"></span>

                                        </div>
                                    </div>

                                    <div class="form-group row" id="text_html_5">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for=""
                                                class=" col-sm-12 col-form-label h2 text-dark">Option
                                                5<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <textarea name="option_5_html" class="form-control input-full" rows="5" id="quiz_option5_html"
                                                style="height:100px;">{{ old('option_5_html') }}</textarea>

                                            <span class="text-danger" id="error_option_5_html"></span>

                                        </div>
                                    </div>

                                    <div class="form-group row" id="text_html_6">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for=""
                                                class=" col-sm-12 col-form-label h2 text-dark">Option
                                                6<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <textarea name="option_6_html" class="form-control input-full" rows="5" id="quiz_option6_html"
                                                style="height:100px;">{{ old('option_6_html') }}</textarea>

                                            <span class="text-danger" id="error_option_6_html"></span>

                                        </div>
                                    </div>


                                </div>


                                <!--show for opt default-->
                                <div id="showforoptdefault">

                                    <div class="form-group row" id="default_1">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for=""
                                                class=" col-sm-12 col-form-label h2 text-dark">Option
                                                1<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <textarea name="option_1" class="form-control input-full" rows="5" id="quiz_option1_default"
                                                style="height:100px;">{{ old('option_1') }}</textarea>

                                            <span class="text-danger"
                                                id="error_quiz_option1_default"></span>

                                        </div>
                                    </div>


                                    <div class="form-group row" id="default_2">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for=""
                                                class=" col-sm-12 col-form-label h2 text-dark">Option
                                                2<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <textarea name="option_2" class="form-control input-full" rows="5" id="quiz_option2_default"
                                                style="height:100px;">{{ old('option_2') }}</textarea>
                                            <span class="text-danger"
                                                id="error_quiz_option2_default"></span>
                                        </div>
                                    </div>


                                    <div class="form-group row" id="default_3">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for=""
                                                class=" col-sm-12 col-form-label h2 text-dark">Option
                                                3<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <textarea name="option_3" class="form-control input-full" rows="5" id="quiz_option3_default"
                                                style="height:100px;">{{ old('option_3') }}</textarea>

                                            <span class="text-danger"
                                                id="error_quiz_option3_default"></span>

                                        </div>
                                    </div>


                                    <div class="form-group row" id="default_4">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for=""
                                                class=" col-sm-12 col-form-label h2 text-dark">Option
                                                4<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <textarea name="option_4" class="form-control input-full" rows="5" id="quiz_option4_default"
                                                style="height:100px;">{{ old('option_4') }}</textarea>

                                            <span class="text-danger"
                                                id="error_quiz_option4_default"></span>

                                        </div>
                                    </div>

                                    <div class="form-group row" id="default_5">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for=""
                                                class=" col-sm-12 col-form-label h2 text-dark">Option
                                                5<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <textarea name="option_5" class="form-control input-full" rows="5" id="quiz_option5_default"
                                                style="height:100px;">{{ old('option_5') }}</textarea>

                                            <span class="text-danger"
                                                id="error_quiz_option5_default"></span>

                                        </div>
                                    </div>

                                    <div class="form-group row" id="default_6">
                                        <div class="col-sm-12 d-flex aling-items-center">
                                            <label for=""
                                                class=" col-sm-12 col-form-label h2 text-dark">Option
                                                6<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <textarea name="option_6" class="form-control input-full" rows="5" id="quiz_option6_default"
                                                style="height:100px;">{{ old('option_6') }}</textarea>

                                            <span class="text-danger"
                                                id="error_quiz_option6_default"></span>

                                        </div>
                                    </div>
                                </div>

                                <!-- show for optFile -->
                                <div id="showforoptFile">

                                    <div class="form-group row" id="file_1">
                                        <div class="col-sm-12 d-flex align-items-center">
                                            <label for=""
                                                class="col-sm-12 col-form-label h2 text-dark">Option
                                                1<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <input type="file" name="quiz_option1_file"
                                                class="form-control input-full"
                                                id="quiz_option1_file">
                                            <span class="text-danger"
                                                id="error_quiz_option1_file"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="file_2">
                                        <div class="col-sm-12 d-flex align-items-center">
                                            <label for=""
                                                class="col-sm-12 col-form-label h2 text-dark">Option
                                                2<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <input type="file" name="quiz_option2_file"
                                                class="form-control input-full"
                                                id="quiz_option2_file">
                                            <span class="text-danger"
                                                id="error_quiz_option2_file"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="file_3">
                                        <div class="col-sm-12 d-flex align-items-center">
                                            <label for=""
                                                class="col-sm-12 col-form-label h2 text-dark">Option
                                                3<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <input type="file" name="quiz_option3_file"
                                                class="form-control input-full"
                                                id="quiz_option3_file">
                                            <span class="text-danger"
                                                id="error_quiz_option3_file"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="file_4">
                                        <div class="col-sm-12 d-flex align-items-center">
                                            <label for=""
                                                class="col-sm-12 col-form-label h2 text-dark">Option
                                                4<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <input type="file" name="quiz_option4_file"
                                                class="form-control input-full"
                                                id="quiz_option4_file">
                                            <span class="text-danger"
                                                id="error_quiz_option4_file"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="file_5">
                                        <div class="col-sm-12 d-flex align-items-center">
                                            <label for=""
                                                class="col-sm-12 col-form-label h2 text-dark">Option
                                                5<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <input type="file" name="quiz_option5_file"
                                                class="form-control input-full"
                                                id="quiz_option5_file">
                                            <span class="text-danger"
                                                id="error_quiz_option5_file"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="file_6">
                                        <div class="col-sm-12 d-flex align-items-center">
                                            <label for=""
                                                class="col-sm-12 col-form-label h2 text-dark">Option
                                                6<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <input type="file" name="quiz_option6_file"
                                                class="form-control input-full"
                                                id="quiz_option6_file">
                                            <span class="text-danger"
                                                id="error_quiz_option6_file"></span>
                                        </div>
                                    </div>

                                </div>

                                <!-- show for JumpledWords -->
                                <div id="showforoptJumpledWords">

                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex align-items-center">
                                            <label for=""
                                                class="col-sm-12 col-form-label h2 text-dark">Jumpled Words<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <input type="text" name="jumpled_words"
                                                class="form-control input-full"
                                                id="jumpled_words" placeholder="Enter the words to here">
                                            <span class="text-danger"
                                                id="error_jumpled_words"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex align-items-center">
                                            <label for=""
                                                class="col-sm-12 col-form-label h2 text-dark">Rearranging Words<span style="color:red;">&nbsp;*</span></label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 20px !important;">
                                            <input type="text" name="rearranging_words"
                                                class="form-control input-full"
                                                id="rearranging_words" placeholder="Enter the rearranging words to here">
                                            <span class="text-danger"
                                                id="error_rearranging_words"></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row" id="div_quiz_answer">
                                    <div class="col-sm-12 d-flex aling-items-center">
                                        <label for="div_quiz_answer"
                                            class=" col-sm-12 col-form-label h2 text-dark">Answer<span
                                                style="color:red;">&nbsp;*</span></label>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 20px !important;">
                                        <select name="quiz_answer" class="form-control input-full"
                                            id="quiz_answer" style="width:100%">

                                        </select>
                                        <span class="text-danger" id="error_quiz_answer"></span>
                                    </div>
                                </div>


                                <div class="form-group row" id="div_quiz_hint">
                                    <div class="col-sm-12 d-flex aling-items-center">
                                        <label for="div_quiz_hint"
                                            class=" col-sm-12 col-form-label h2 text-dark">Hint</label>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 20px !important;">
                                        <textarea name="quiz_hint" class="form-control input-full" rows="8" id="quiz_hint"
                                            style="height:100px;width:100%;">{{ old('quiz_hint') }}</textarea>

                                        <small class="form-text text-muted text-danger err_msg"
                                            id="error_quiz_hint"></small>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label h2 text-dark">Direction Based</label>
                                        <select name="direction_based" id="direction_based" class="form-control">
                                            <option value="">-- Select --</option>
                                            <option value="5" {{ old('direction_based') == '5' ? 'selected' : '' }}>Enable</option>
                                            <option value="0" {{ old('direction_based') == '0' ? 'selected' : '' }}>Disable</option>
                                        </select>
                                
                                        <small class="form-text text-muted text-danger err_msg" id="error_direction_based"></small>
                                    </div>
                                </div>


                                <div class="form-group row" id="explanation">
                                    <div class="col-sm-12 d-flex aling-items-center">
                                        <label for="div_quiz_exp"
                                            class=" col-sm-12 col-form-label h2 text-dark">Explanation</label>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 20px !important;">
                                        <textarea name="quiz_exp" class="form-control input-full" rows="8" id="quiz_exp"
                                            style="height:100px;width:100%;"> {{ old('quiz_exp') }}</textarea>
                                        <small class="form-text text-muted text-danger err_msg"
                                            id="err_quiz_exp"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 d-flex aling-items-center">
                                        <label for="exampleInputUsername2"
                                            class=" col-sm-12 col-form-label h2 text-dark">App
                                            Image Type </label>
                                    </div>
                                    <div class="col-sm-12" style="padding-left: 20px !important;">
                                        <div class="form-check-inline h5 text-dark">
                                            <input class="radio" type="radio" name="file_type"
                                                id="image_1" value='1' checked>
                                            <label class="form-check-label text-dark" for="image_1"
                                                style="font-size: 80%;padding-left:5px;">Image
                                                Type</label>
                                        </div>
                                        <div class="form-check-inline h5 text-dark">
                                            <input class="radio" type="radio" name="file_type"
                                                id="image_2" value='2'>
                                            <label class="form-check-label text-dark" for="image_2"
                                                style="font-size: 80%;padding-left:5px;">
                                                URL Type
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id ='Normal_image_type' class="form-group row">
                                    <div class="col-sm-12 d-flex aling-items-center">
                                        <label for="file"
                                            class=" col-sm-12 col-form-label h2 text-dark">File
                                            Type <span
                                                style="color: #405189;padding-left:5px;">(optional)</span></label>
                                    </div>
                                    <div class="col-sm-12" style="padding-left: 20px !important;">
                                        <input type="file"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15"
                                            name="file" id="file" autocomplete="off">
                                    </div>
                                </div>
                                <div id="url_image_type" class="form-group row">
                                    <div class="col-sm-12 d-flex aling-items-center">
                                        <label for="file_1"
                                            class=" col-sm-12 col-form-label h2 text-dark">URL
                                            Image <span
                                                style="color: #405189;padding-left:5px;">(optional)</span></label>
                                    </div>
                                    <div class="col-sm-12" style="padding-left: 20px !important;">
                                        <input type="text"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15"
                                            accept="image/*" id="file_1" name="url_image"
                                            placeholder="Enter a image url"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>



                                <div class="container px-5">
                                    <div class="row">
                                        <div class="col-sm-12 text-end">
                                            <button type="submit" name="submit" class="btn btn-primary"
                                                id="susubmitbmit"><i class="fas fa-save me-1"></i> Submit</button>
                                            <button id="loading" class="btn btn-primary" type="button"
                                                disabled=""><span class="spinner-grow spinner-grow-sm"
                                                    role="status" aria-hidden="true"></span>Loading...</button>
                                            <a href="{{ url('admin/quiz_list') }}"
                                                class="btn btn-dark" type="button">cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3 grid-margin stretch-card">
                <div class="card" style="background-color: #fff;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0" style="color: #012970 !important;">
                            <i class="fas fa-info-circle me-2"></i>Note</h4>
                    </div>

                    <div class="card-body">
                        <br>
                        <div class="alert alert-note alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="border-left: 4px solid #ffc107 !important;">
                            <i class="fas fa-info-circle me-3 fs-4 text-dark"></i>
                            <div class="text-dark">
                                <strong>Note:</strong> You can add questions (for the fields highlighted in yellow) by selecting <strong>one checkbox at a time</strong>.
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

    <script>
        var edit_category_id = null;
    </script>

    <script src="{{ asset('assets/js/quiz.js') }}"></script>


    <!--<script src="{{ asset('assets/editor_ckediter/ckeditor.js') }}"></script>-->
    <!--<script src="{{ asset('assets/editor_ckediter/adapters/jquery.js') }}"></script>-->
    <!--<script src="{{ asset('assets/editor_ckediter/styles.js') }}"></script>-->


<script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>

    <script type="text/javascript">
        if ($('#image_1').is(':checked')) {
            $("#Normal_image_type").show()
            $('#url_image_type').hide();
        }

        $('#image_1').bind('change', function() {
            if ($(this).is(':checked'))
                $("#Normal_image_type").show().removeAttr('checked', true)
            $('#url_image_type').hide();
        });

        $("#image_2").bind('change', function() {
            if ($(this).is(':checked'))
                $("#Normal_image_type").hide();
            $('#url_image_type').show().attr('checked', true);
        });
    </script>
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>

    <script type="text/javascript">
        if ($('#ques_default_text').is(':checked')) {
            $("#showforqueshtml").hide();
            $("#showforquesdefault").show();
            $('#showforquesImage').hide();
            $('#showforquesvideo').hide();
        }
    </script>

    <script>
        $('#showforopthtml').hide();
        $('#showforoptFile').hide();
        $('#showforoptJumpledWords').hide();
        $('#showforoptdefault').hide();
        $("#showforopthtml").hide();
        $("#change_option").hide();
        $("#showforoptdefault").hide();
        $("#div_quiz_answer").hide();
        $("#div_quiz_hint").hide();
        $("#explanation").hide();
    </script>


    <script>
        document.getElementById('showforoptdefault').style.display = 'none';

        function optionlist() {
            var selValue = document.getElementById("ppl").value;
            var quiz_answer = document.getElementById("quiz_answer");

            //METHOD 2
            var selObj = document.getElementById("ppl");
            var selValue = selObj.options[selObj.selectedIndex].value;

            //default text checking
            if (selValue >= 1) {
                document.getElementById('change_option').style.display = 'flex';
                $("#showforoptdefault").show();
                $("#div_quiz_answer").show();
                $("#div_quiz_hint").show();
                $("#explanation").show();

            } else {
                document.getElementById('default_1').style.display = 'none';

            }

            if (selValue >= "2") {


                document.getElementById('default_2').style.display = 'flex';
            } else {
                document.getElementById('default_2').style.display = 'none';

            }

            if (selValue >= "3") {
                document.getElementById('default_3').style.display = 'flex';
            } else {
                document.getElementById('default_3').style.display = 'none';

            }

            if (selValue >= "4") {
                document.getElementById('default_4').style.display = 'flex';
            } else {
                document.getElementById('default_4').style.display = 'none';

            }
            if (selValue >= "5") {
                document.getElementById('default_5').style.display = 'flex';
            } else {
                document.getElementById('default_5').style.display = 'none';

            }
            if (selValue >= "6") {
                document.getElementById('default_6').style.display = 'flex';
            } else {
                document.getElementById('default_6').style.display = 'none';

            }

            //html text checking

            if (selValue >= "1") {

                document.getElementById('text_html_1').style.display = 'flex';
            } else {
                document.getElementById('text_html_1').style.display = 'none';

            }

            if (selValue >= "2") {

                $("#text_html_2").show();

            } else {
                $("#text_html_2").hide();


            }

            if (selValue >= "3") {
                document.getElementById('text_html_3').style.display = 'flex';
            } else {
                document.getElementById('text_html_3').style.display = 'none';
            }

            if (selValue >= "4") {
                document.getElementById('text_html_4').style.display = 'flex';
            } else {
                document.getElementById('text_html_4').style.display = 'none';

            }
            if (selValue >= "5") {
                document.getElementById('text_html_5').style.display = 'flex';
            } else {
                document.getElementById('text_html_5').style.display = 'none';

            }
            if (selValue >= "6") {
                document.getElementById('text_html_6').style.display = 'flex';
            } else {
                document.getElementById('text_html_6').style.display = 'none';

            }


            //File text checking

            if (selValue >= "1") {

                document.getElementById('file_1').style.display = 'flex';
            } else {
                document.getElementById('file_1').style.display = 'none';

            }

            if (selValue >= "2") {

                $("#file_2").show();

            } else {
                $("#file_2").hide();


            }

            if (selValue >= "3") {
                document.getElementById('file_3').style.display = 'flex';
            } else {
                document.getElementById('file_3').style.display = 'none';
            }

            if (selValue >= "4") {
                document.getElementById('file_4').style.display = 'flex';
            } else {
                document.getElementById('file_4').style.display = 'none';

            }
            if (selValue >= "5") {
                document.getElementById('file_5').style.display = 'flex';
            } else {
                document.getElementById('file_5').style.display = 'none';

            }
            if (selValue >= "6") {
                document.getElementById('file_6').style.display = 'flex';
            } else {
                document.getElementById('file_6').style.display = 'none';

            }



            if ($("input[id='opt_default_text']:checked").val()) {
                if (selValue >= "1") {

                    document.getElementById('default_1').style.display = 'flex';
                } else {
                    document.getElementById('default_1').style.display = 'none';

                }

                if (selValue >= "2") {
                    document.getElementById('default_2').style.display = 'flex';
                } else {
                    document.getElementById('default_2').style.display = 'none';

                }

                if (selValue >= "3") {
                    document.getElementById('default_3').style.display = 'flex';
                } else {
                    document.getElementById('default_3').style.display = 'none';

                }

                if (selValue >= "4") {
                    document.getElementById('default_4').style.display = 'flex';
                } else {
                    document.getElementById('default_4').style.display = 'none';

                }
                if (selValue >= "5") {
                    document.getElementById('default_5').style.display = 'flex';
                } else {
                    document.getElementById('default_5').style.display = 'none';

                }
                if (selValue >= "6") {
                    document.getElementById('default_6').style.display = 'flex';
                } else {
                    document.getElementById('default_6').style.display = 'none';

                }




            } else if ($("input[id='opt_html_text']:checked").val()) {
                if (selValue >= "1") {
                    $("#showforoptdefault").hide();
                    document.getElementById('text_html_1').style.display = 'flex';
                } else {
                    document.getElementById('text_html_1').style.display = 'none';

                }

                if (selValue >= "2") {
                    $("#text_html_2").show();

                } else {
                    $("#text_html_2").hide();

                }

                if (selValue >= "3") {
                    document.getElementById('text_html_3').style.display = 'flex';
                } else {
                    document.getElementById('text_html_3').style.display = 'none';

                }

                if (selValue >= "4") {
                    document.getElementById('text_html_4').style.display = 'flex';
                } else {
                    document.getElementById('text_html_4').style.display = 'none';

                }
                if (selValue >= "5") {
                    document.getElementById('text_html_5').style.display = 'flex';
                } else {
                    document.getElementById('text_html_5').style.display = 'none';

                }
                if (selValue >= "6") {
                    document.getElementById('text_html_6').style.display = 'flex';
                } else {
                    document.getElementById('text_html_6').style.display = 'none';

                }

            } else if ($("input[id='opt_file_text']:checked").val()) {
                if (selValue >= "1") {
                    $("#showforoptdefault").hide();
                    $("#showforopthtml").hide();
                    document.getElementById('file_1').style.display = 'flex';
                } else {
                    document.getElementById('file_1').style.display = 'none';

                }

                if (selValue >= "2") {
                    $("#file_2").show();

                } else {
                    $("#file_2").hide();

                }

                if (selValue >= "3") {
                    document.getElementById('file_3').style.display = 'flex';
                } else {
                    document.getElementById('file_3').style.display = 'none';

                }

                if (selValue >= "4") {
                    document.getElementById('file_4').style.display = 'flex';
                } else {
                    document.getElementById('file_4').style.display = 'none';

                }
                if (selValue >= "5") {
                    document.getElementById('file_5').style.display = 'flex';
                } else {
                    document.getElementById('file_5').style.display = 'none';

                }
                if (selValue >= "6") {
                    document.getElementById('file_6').style.display = 'flex';
                } else {
                    document.getElementById('file_6').style.display = 'none';

                }

            }

            var set = "";
            set += '<option disabled selected="true">Select Option</option>';
            for (var i = 1; i <= selValue; i++) {
                set += '<option value="' + i + '">Option ' + i + ' </option>';
            }

            quiz_answer.innerHTML = set;

        }
    </script>
    <script>
        $(document).ready(function () {
        // question type restore
        quesishtml();

        // option count already selected irundha (error-ku apuram reload)
        var cnt = $('#ppl').val();
        if (cnt && !isNaN(cnt)) {
            optionlist();      // selected count ku mattum rows show + answer dropdown build
            optionishtml();    // selected format (text/html/file) container show

            // answer restore
            var oldAnswer = "{{ old('quiz_answer') }}";
            if (oldAnswer) {
                $('#quiz_answer').val(oldAnswer);
            }
        }
    });


        // Wiris plugin load
        CKEDITOR.plugins.addExternal(
            'ckeditor_wiris',
            'https://ckeditor.com/docs/ckeditor4/4.22.1/examples/assets/plugins/ckeditor_wiris/',
            'plugin.js'
        );
    
        var editor = CKEDITOR.replace('quiz_question_html', {
            extraPlugins: 'image2,uploadimage,mathjax,ckeditor_wiris',
            height: 300,
    
            // File upload settings (Laravel image upload route)
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
    
            // MathJax library
            mathJaxLib: 'https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=TeX-AMS_HTML',
    
            // Allow mathml + wiris + latex
            extraAllowedContent: 'math[*]{*}(*) img[data-mathml,data-custom-editor,role](Wirisformula)',
    
            // Toolbar buttons
            toolbar: [
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo'] },
                { name: 'editing', items: ['Scayt'] },
                { name: 'insert', items: [
                    'Image', 'Table', 'HorizontalRule', 'SpecialChar',
                    'Mathjax',                 // MathJax (LaTeX input)
                    'ckeditor_wiris_formulaEditor',  // Wiris MathType
                    'ckeditor_wiris_formulaChemistry' // Wiris Chemistry
                ]},
                '/',
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'tools', items: ['Maximize'] }
            ]
        });


        function quesishtml() {
            var check_type = $('input[name="question_format_type"]:checked').val();
            // alert(check_type);
            if (check_type == 1) {
                $("#showforqueshtml").hide();
                $("#showforquesdefault").show();
                $('#showforquesImage').hide();
                $('#showforquesvideo').hide();
            } else if (check_type == 2) {
                $("#showforqueshtml").show();
                $("#showforquesdefault").hide();
                $('#showforquesImage').hide();
                $('#showforquesvideo').hide();
            } else if (check_type == 3) {
                $("#showforqueshtml").hide();
                $("#showforquesdefault").hide();
                $('#showforquesImage').show();
                $('#showforquesvideo').hide();
            } else {
                $("#showforqueshtml").hide();
                $("#showforquesdefault").hide();
                $('#showforquesImage').hide();
                $('#showforquesvideo').show();
            }
        }


        var editor = CKEDITOR.replace('quiz_option1_html', {
            extraPlugins: 'image2,uploadimage,mathjax,ckeditor_wiris',
            height: 300,
    
            // File upload settings (Laravel image upload route)
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
    
            // MathJax library
            mathJaxLib: 'https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=TeX-AMS_HTML',
    
            // Allow mathml + wiris + latex
            extraAllowedContent: 'math[*]{*}(*) img[data-mathml,data-custom-editor,role](Wirisformula)',
    
            // Toolbar buttons
            toolbar: [
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo'] },
                { name: 'editing', items: ['Scayt'] },
                { name: 'insert', items: [
                    'Image', 'Table', 'HorizontalRule', 'SpecialChar',
                    'Mathjax',                 // MathJax (LaTeX input)
                    'ckeditor_wiris_formulaEditor',  // Wiris MathType
                    'ckeditor_wiris_formulaChemistry' // Wiris Chemistry
                ]},
                '/',
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'tools', items: ['Maximize'] }
            ]
        });

        var editor = CKEDITOR.replace('quiz_option2_html', {
            extraPlugins: 'image2,uploadimage,mathjax,ckeditor_wiris',
            height: 300,
    
            // File upload settings (Laravel image upload route)
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
    
            // MathJax library
            mathJaxLib: 'https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=TeX-AMS_HTML',
    
            // Allow mathml + wiris + latex
            extraAllowedContent: 'math[*]{*}(*) img[data-mathml,data-custom-editor,role](Wirisformula)',
    
            // Toolbar buttons
            toolbar: [
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo'] },
                { name: 'editing', items: ['Scayt'] },
                { name: 'insert', items: [
                    'Image', 'Table', 'HorizontalRule', 'SpecialChar',
                    'Mathjax',                 // MathJax (LaTeX input)
                    'ckeditor_wiris_formulaEditor',  // Wiris MathType
                    'ckeditor_wiris_formulaChemistry' // Wiris Chemistry
                ]},
                '/',
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'tools', items: ['Maximize'] }
            ]
        });

        var editor = CKEDITOR.replace('quiz_option3_html', {
            extraPlugins: 'image2,uploadimage,mathjax,ckeditor_wiris',
            height: 300,
    
            // File upload settings (Laravel image upload route)
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
    
            // MathJax library
            mathJaxLib: 'https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=TeX-AMS_HTML',
    
            // Allow mathml + wiris + latex
            extraAllowedContent: 'math[*]{*}(*) img[data-mathml,data-custom-editor,role](Wirisformula)',
    
            // Toolbar buttons
            toolbar: [
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo'] },
                { name: 'editing', items: ['Scayt'] },
                { name: 'insert', items: [
                    'Image', 'Table', 'HorizontalRule', 'SpecialChar',
                    'Mathjax',                 // MathJax (LaTeX input)
                    'ckeditor_wiris_formulaEditor',  // Wiris MathType
                    'ckeditor_wiris_formulaChemistry' // Wiris Chemistry
                ]},
                '/',
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'tools', items: ['Maximize'] }
            ]
        });

        var editor = CKEDITOR.replace('quiz_option4_html', {
            extraPlugins: 'image2,uploadimage,mathjax,ckeditor_wiris',
            height: 300,
    
            // File upload settings (Laravel image upload route)
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
    
            // MathJax library
            mathJaxLib: 'https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=TeX-AMS_HTML',
    
            // Allow mathml + wiris + latex
            extraAllowedContent: 'math[*]{*}(*) img[data-mathml,data-custom-editor,role](Wirisformula)',
    
            // Toolbar buttons
            toolbar: [
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo'] },
                { name: 'editing', items: ['Scayt'] },
                { name: 'insert', items: [
                    'Image', 'Table', 'HorizontalRule', 'SpecialChar',
                    'Mathjax',                 // MathJax (LaTeX input)
                    'ckeditor_wiris_formulaEditor',  // Wiris MathType
                    'ckeditor_wiris_formulaChemistry' // Wiris Chemistry
                ]},
                '/',
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'tools', items: ['Maximize'] }
            ]
        });
        var editor = CKEDITOR.replace('quiz_option5_html', {
            extraPlugins: 'image2,uploadimage,mathjax,ckeditor_wiris',
            height: 300,
    
            // File upload settings (Laravel image upload route)
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
    
            // MathJax library
            mathJaxLib: 'https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=TeX-AMS_HTML',
    
            // Allow mathml + wiris + latex
            extraAllowedContent: 'math[*]{*}(*) img[data-mathml,data-custom-editor,role](Wirisformula)',
    
            // Toolbar buttons
            toolbar: [
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo'] },
                { name: 'editing', items: ['Scayt'] },
                { name: 'insert', items: [
                    'Image', 'Table', 'HorizontalRule', 'SpecialChar',
                    'Mathjax',                 // MathJax (LaTeX input)
                    'ckeditor_wiris_formulaEditor',  // Wiris MathType
                    'ckeditor_wiris_formulaChemistry' // Wiris Chemistry
                ]},
                '/',
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'tools', items: ['Maximize'] }
            ]
        });

        var editor = CKEDITOR.replace('quiz_option6_html', {
            extraPlugins: 'image2,uploadimage,mathjax,ckeditor_wiris',
            height: 300,
    
            // File upload settings (Laravel image upload route)
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
    
            // MathJax library
            mathJaxLib: 'https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=TeX-AMS_HTML',
    
            // Allow mathml + wiris + latex
            extraAllowedContent: 'math[*]{*}(*) img[data-mathml,data-custom-editor,role](Wirisformula)',
    
            // Toolbar buttons
            toolbar: [
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo'] },
                { name: 'editing', items: ['Scayt'] },
                { name: 'insert', items: [
                    'Image', 'Table', 'HorizontalRule', 'SpecialChar',
                    'Mathjax',                 // MathJax (LaTeX input)
                    'ckeditor_wiris_formulaEditor',  // Wiris MathType
                    'ckeditor_wiris_formulaChemistry' // Wiris Chemistry
                ]},
                '/',
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'tools', items: ['Maximize'] }
            ]
        });

        function optionishtml() {
            var check_type_option = $('input[name="option_format_type"]:checked').val();
            if (check_type_option == 0) {

                $("#showforoptdefault").show();
                $("#showforopthtml").hide();
                $("#showforoptFile").hide();
                $("#showforoptJumpledWords").hide();


            }
            if (check_type_option == 1) {
                $("#showforoptdefault").hide();
                $("#showforopthtml").show();
                $("#showforoptFile").hide();
                $("#showforoptJumpledWords").hide();

            }
            if (check_type_option == 2) {
                $("#showforoptdefault").hide();
                $("#showforopthtml").hide();
                $("#showforoptFile").show();
                $("#showforoptJumpledWords").hide();

            }
            if (check_type_option == 3) {
                $("#showforoptdefault").hide();
                $("#showforopthtml").hide();
                $("#showforoptFile").hide();
                $("#showforoptJumpledWords").hide();

            }

        }

    </script>
    {{-- this is common code for js  --}}
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


        $('#loading').hide();
        $('#susubmitbmit').on('click', function() {
            $('#loading').show();
            $('#susubmitbmit').hide();
        });
    </script>

</body>

</html>
