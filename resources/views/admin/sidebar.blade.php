@php
    $filename = request()->segments();
    $file = request()->segment(count(request()->segments()));
@endphp
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .alert-danger {
        border: 0;
        position: relative;
        padding: 0.95rem 1.25rem;
        border-radius: 1px;
        color: inherit;
        background-color: #fff;
        border-left: 5px solid red !important;
        -webkit-box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        -moz-box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        font-size: 18px;
        text-decoration: underline white;
        color: red;
    }

    .alert-warning {
        border: 0;
        position: relative;
        padding: 0.95rem 1.25rem;
        border-radius: 1px;
        color: inherit;
        background-color: #fff;
        border-left: 4px solid #ffad46 !important;
        -webkit-box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        -moz-box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        font-size: 18px;
        text-decoration: underline white;
        color: #ffad46;
    }

    .alert-success {
        border: 0;
        position: relative;
        padding: 0.95rem 1.25rem;
        border-radius: 1px;
        color: inherit;
        font-size: 16px;
        background-color: #fff;
        border-left: 5px solid green !important;
        color: green;
        -webkit-box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        -moz-box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
    }

    .btn-add,
    .btn-add:hover {
        border-color: #012970 !important;
        font-weight: bold;
        background: #012970 !important;
        color: #ffffff !important;
        text-transform: uppercase !important;
        box-shadow: 4px 4px 10px 0 rgba(0, 0, 0, .1), 4px 4px 15px -5px rgba(21, 114, 232, .4) !important;
    }

    .all-clour {
        border-color: #012970 !important;
        font-weight: bold;
        background: #012970 !important;
        color: #ffffff !important;
        font-weight: bold;
        text-transform: uppercase !important;
        box-shadow: 4px 4px 10px 0 rgba(0, 0, 0, .1), 4px 4px 15px -5px rgba(21, 114, 232, .4) !important;
        padding: 8px 14px !important;
        margin-left: 15px;
        border-radius: 5px !important;
        font-size: 16px !important;
        margin-top: 5px !important;
        margin-bottom: 5px !important;
        width: 100% !important;
        height: 44px !important;
        text-align: center !important;
        text-decoration: none !important;
        display: inline-block !important;
        transition: all 0.3s ease !important;
        cursor: pointer !important;
    }
</style>

<style>
    .sidebar-nav .nav-link.collapse {
        background: #012970 !important;
        color: #ffffff !important;
        /* text-transform: uppercase !important; */
    }

    .sidebar-nav .nav-link.collapse i {
        color: #ffffff !important;
        /* text-transform: uppercase !important; */
    }

    .sidebar-nav .nav-content a {
        color: #7e87a2 !important;
        padding-left: 65px;
        font-weight: 700;
    }

    .sidebar-nav .nav-content a:hover {
        background: rgba(199, 199, 199, .2);
        color: #0f47aa !important;
        border-radius: 5px;
    }

    .sidebar-nav .nav-link {
        padding-left: 6px;
    }

    .sidebar-nav .nav-link.collapse {
        /* background: #012970 !important; */
        background: #012970 !important;
        color: #ffffff !important;
        /* text-transform: uppercase !important; */
        box-shadow: 4px 4px 10px 0 rgba(0, 0, 0, .1), 4px 4px 15px -5px rgba(21, 114, 232, .4) !important;
        padding: 8px 14px !important;
        /* margin-left: 10px; */
    }

    .sidebar-nav .nav-link.collapsed {
        padding: 8px 14px !important;
        border-radius: 5px !important;
        /* margin-left: 10px; */
    }

    .sidebar-nav .nav-link.collapsed span {
        font-size: 16px;
        padding-left: 6px;
        margin-top: 5px !important;
    }

    .sidebar-nav .nav-link span {
        margin-top: 5px !important;
        font-size: 17px !important;
        padding-left: 6px !important;
        border-radius: 5px !important;
    }

    .sidebar-nav .nav-link.collapse span {
        margin-top: 5px !important;
        font-size: 17px !important;
        padding-left: 6px !important;
        border-radius: 5px !important;
    }

    .sidebar-nav .nav-link.collapse i {
        color: #ffffff !important;
        /* text-transform: uppercase !important; */
    }

    .sidebar-nav .nav-link {
        height: 51px;
        padding: 0 15px !important;
    }

    /* .sidebar-nav .nav-link span {
          margin-top: 5px !important;
      } */

    .sidebar-nav .nav-content a.active {
        background: rgba(199, 199, 199, .2);
        color: #0f47aa !important;
        border-radius: 5px;
    }

    .color-id {
        color: #4154f1 !important;
        background: #f6f9ff !important;
    }

    .form-select:focus,
    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="password"]:focus,
    input[type="email"]:focus {
        border-color: #007BFF;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
</style>
<style>
    .nav {
        display: flex !important;
        list-style: none !important;
        padding-left: 0 !important;
    }

    .nav-item {
        margin-right: 5px !important;
    }

    .nav-heading {
        width: 100% !important;
        padding-right: 15px !important;
        /* Adjust padding as needed */
        font-weight: bold !important;
        /* Optional: Make the heading bold */
    }

    input[type="text"],
    input[type="number"],
    input[type="password"],
    input[type="email"],
    select,
    {
    border: 1px solid #ced4da !important;
    border-radius: 0.25rem !important;
    padding: 0.375rem 0.75rem !important;
    font-size: 1rem !important;
    line-height: 1.5 !important;
    color: #495057 !important;
    background-color: #fff !important;
    background-clip: padding-box !important;
    ;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
    ;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5) !important;
    ;
    width: 100% !important;
    height: 44px !important;
    }

    .alert-container {
        position: fixed;
        top: 1.5rem;
        right: 1.5rem;
        z-index: 1100;
        width: 350px;
    }
</style>
<aside id="sidebar" class="sidebar">

    @php $AccessModule = Auth::guard('admin')->user()->accountAccessModule @endphp
    @php $explode_1 = explode('|',$AccessModule);@endphp
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item align-items-center align-self-center">
            <a class="nav-link cc @php echo ($file == 'dashboard') ? 'collapse':'collapsed' @endphp"
                href="{{ url('admin/dashboard') }}" class="@php echo ($file == 'dashboard') ? 'active':'' @endphp">
                <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <defs>
                            <path id="solarHomeBold0" fill="currentColor"
                                d="M10.75 9.5a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0Z"></path>
                        </defs>
                        <path fill="currentColor" d="M18.5 3H16a.5.5 0 0 0-.5.5v.059l3.5 2.8V3.5a.5.5 0 0 0-.5-.5Z">
                        </path>
                        <use href="#solarHomeBold0" fill-rule="evenodd" clip-rule="evenodd"></use>
                        <path fill="currentColor" fill-rule="evenodd"
                            d="m20.75 10.96l.782.626a.75.75 0 0 0 .936-1.172l-8.125-6.5a3.75 3.75 0 0 0-4.686 0l-8.125 6.5a.75.75 0 0 0 .937 1.172l.781-.626v10.29H2a.75.75 0 0 0 0 1.5h20a.75.75 0 0 0 0-1.5h-1.25V10.96ZM9.25 9.5a2.75 2.75 0 1 1 5.5 0a2.75 2.75 0 0 1-5.5 0Zm2.8 3.75c.664 0 1.237 0 1.696.062c.492.066.963.215 1.345.597s.531.853.597 1.345c.058.43.062.96.062 1.573v4.423h-1.5V17c0-.728-.002-1.2-.048-1.546c-.044-.325-.114-.427-.172-.484c-.057-.057-.159-.128-.484-.172c-.347-.046-.818-.048-1.546-.048c-.728 0-1.2.002-1.546.048c-.325.044-.427.115-.484.172c-.057.057-.128.159-.172.484c-.046.347-.048.818-.048 1.546v4.25h-1.5v-4.3c0-.664 0-1.237.062-1.696c.066-.492.215-.963.597-1.345s.854-.531 1.345-.597c.459-.062 1.032-.062 1.697-.062h.098Z"
                            clip-rule="evenodd"></path>
                        <use href="#solarHomeBold0" fill-rule="evenodd" clip-rule="evenodd"></use>
                    </svg></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if (has_module_access('app_menu'))
            <li class="nav-item">
                <a class="nav-link @php echo ($file == 'app_list' || $file == 'admin_add_app' || $filename[1] == 'edit_app' || ($filename[1] == 'mapped_app')) ? 'collapse':'collapsed' @endphp"
                    data-bs-target="#components-nav" data-bs-toggle="collapse"
                    @if ($file == 'app_list' || $file == 'admin_add_app' || $filename[1] == 'edit_app' || $filename[1] == 'mapped_app') {{ 'aria-expanded="true"' ?? 'aria-expanded="false"' }} @endif
                    href="{{ url('admin/app_list') }}">
                    <i class="fas fa-mobile-alt fa-solid fa-xl pt-1" aria-hidden="true" style="font-size: 23px;"></i>
                    <span>Apps Config</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav"
                    class="nav-content collapse @if ($file == 'app_list' || $file == 'admin_add_app' || $filename[1] == 'edit_app' || $filename[1] == 'mapped_app') {{ 'show' ?? '' }} @endif"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('admin/app_list') }}"
                            class="@php echo ($file == 'app_list') ? 'active':'' @endphp">
                            <i class="bi bi-circle"></i><span>List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/admin_add_app') }}"
                            class="@php echo ($file == 'admin_add_app') ? 'active':'' @endphp">
                            <i class="bi bi-circle"></i><span>Add</span>
                        </a>
                    </li>
                    @if ($filename[1] == 'edit_app')
                        <li>
                            <a href="/admin/edit_app/{{ $file }}"
                                class="@php echo ($filename[1] == 'edit_app') ? 'active':'' @endphp">
                                <i class="bi bi-circle"></i><span>Manage</span>
                            </a>
                        </li>
                    @endif
                    @if ($filename[1] == 'mapped_app')
                        <li>
                            <a href="/admin/mapped_app/{{ $file }}"
                                class="@php echo ($filename[1] == 'mapped_app') ? 'active':'' @endphp">
                                <i class="bi bi-circle"></i><span>Mapping</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li><!-- End Components Nav -->
        @endif

        @if (has_module_access('batch_menu'))
            <li class="nav-item">
                <a class="nav-link  @php echo ($file == 'batches' || $file == 'add_batch' || $filename[1] == 'edit_batch') ? 'collapse':'collapsed' @endphp"
                    data-bs-target="#batches" data-bs-toggle="collapse"
                    @if ($file == 'batches' || $file == 'add_batch' || $filename[1] == 'edit_batch') {{ 'aria-expanded="true"' ?? 'aria-expanded="false"' }} @endif
                    href="{{ url('admin/batches') }}">
                    <i class="fa fa-solid fa-layer-group fa-xl pt-1" aria-hidden="true"
                        style="font-size: 23px;"></i><span>Batches Info</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="batches"
                    class="nav-content collapse @if ($file == 'batches' || $file == 'add_batch' || $filename[1] == 'edit_batch') {{ 'show' ?? '' }} @endif"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('admin/batches') }}"
                            class="@php echo ($file == 'batches') ? 'active':'' @endphp">
                            <i class="bi bi-circle"></i><span>List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/add_batch') }}"
                            class="@php echo ($file == 'add_batch') ? 'active':'' @endphp">
                            <i class="bi bi-circle"></i><span>Add</span>
                        </a>
                    </li>
                    @if ($filename[1] == 'edit_batch')
                        <li>
                            <a href="/admin/edit_batch/{{ $file }}"
                                class="@php echo ($filename[1] == 'edit_batch') ? 'active':'' @endphp">
                                <i class="bi bi-circle"></i><span>Manage</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (has_module_access('category_menu'))
            <li class="nav-item">
                <a class="nav-link  @php echo ($file == 'nested_category_list' || $file == 'add_nested_category' || $filename[1] == 'edit_nested_category') ? 'collapse':'collapsed' @endphp"
                    data-bs-target="#forms-nav" data-bs-toggle="collapse"
                    @if ($file == 'nested_category_list' || $file == 'add_nested_category' || $filename[1] == 'edit_nested_category') {{ 'aria-expanded="true"' ?? 'aria-expanded="false"' }} @endif
                    href="{{ url('admin/nested_category_list') }}">
                    <i class="fa fa-solid fa-folder-tree fa-xl pt-1" aria-hidden="true"
                        style="font-size: 23px;"></i><span> Category Info </span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav"
                    class="nav-content collapse @if ($file == 'nested_category_list' || $file == 'add_nested_category' || $filename[1] == 'edit_nested_category') {{ 'show' ?? '' }} @endif"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('admin/nested_category_list') }}"
                            class="@php echo ($file == 'nested_category_list') ? 'active':'' @endphp">
                            <i class="bi bi-circle"></i><span>List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/add_nested_category') }}"
                            class="@php echo ($file == 'add_nested_category') ? 'active':'' @endphp">
                            <i class="bi bi-circle"></i><span>Add</span>
                        </a>
                    </li>
                    @if ($filename[1] == 'edit_nested_category')
                        <li>
                            <a href="/admin/edit_nested_category/{{ $file }}"
                                class="@php echo ($filename[1] == 'edit_nested_category') ? 'active':'' @endphp">
                                <i class="bi bi-circle"></i><span>Manage</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif


        @if (has_module_access('quiz_menu'))
            <li class="nav-item">
                <a class="nav-link  @php echo ($file == 'quiz_list' || $file == 'add_quiz' || $file == 'import' || $filename[1] == 'edit_quiz') ? 'collapse':'collapsed' @endphp"
                    data-bs-target="#quiz_list" data-bs-toggle="collapse"
                    @if ($file == 'quiz_list' || $file == 'add_quiz' || $file == 'import' || $filename[1] == 'edit_quiz') {{ 'aria-expanded="true"' ?? 'aria-expanded="false"' }} @endif
                    href="{{ url('admin/quiz_list') }}">
                    <i class="fa fa-solid fa-coins fa-xl pt-1" aria-hidden="true"
                        style="font-size: 23px;"></i><span>Quiz Info</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="quiz_list"
                    class="nav-content collapse @if ($file == 'quiz_list' || $file == 'add_quiz' || $file == 'import' || $filename[1] == 'edit_quiz') {{ 'show' ?? '' }} @endif"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        @if($filename[1] == 'edit_quiz')
                            <a href="{{ url('admin/quiz_list').'#'.$file }}"
                                class="@php echo ($file == 'quiz_list') ? 'active':'' @endphp">
                                <i class="bi bi-circle"></i><span>List</span>
                            </a>
                        @else
                            <a href="{{ url('admin/quiz_list') }}"
                                class="@php echo ($file == 'quiz_list') ? 'active':'' @endphp">
                                <i class="bi bi-circle"></i><span>List</span>
                            </a>
                        @endif
                    </li>
                    <li>
                        <a href="{{ url('admin/add_quiz') }}"
                            class="@php echo ($file == 'add_quiz') ? 'active':'' @endphp">
                            <i class="bi bi-circle"></i><span>Add</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/import') }}"
                            class="@php echo ($file == 'import') ? 'active':'' @endphp">
                            <i class="bi bi-circle"></i><span>Import</span>
                        </a>
                    </li>
                    @if ($filename[1] == 'edit_quiz')
                        <li>
                            <a href="/admin/edit_quiz/{{ $file }}"
                                class="@php echo ($filename[1] == 'edit_quiz') ? 'active':'' @endphp">
                                <i class="bi bi-circle"></i><span>Manage</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (has_module_access('admin_menu'))
            <li class="nav-heading">Admin Configuration info</li>

            <li class="nav-item">
                <a class="nav-link @php echo ($file == 'superadmin' || $file == 'admin_add_sub_admin' || $filename[1] == 'edit_admin') ? 'collapse':'collapsed' @endphp"
                    data-bs-target="#admin-nav" data-bs-toggle="collapse" href="#">
                    <i class="mdi mdi-account-plus mdi-24px"></i><span class="mt-1">Admin Info</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="admin-nav"
                    class="nav-content collapse @if ($file == 'superadmin' || $file == 'admin_add_sub_admin' || $filename[1] == 'edit_admin') {{ 'show' ?? '' }} @endif"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('admin/superadmin') }}"
                            class="@php echo ($file == 'superadmin') ? 'active':'' @endphp">
                            <i class="bi bi-circle"></i><span>List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/admin_add_sub_admin') }}"
                            class="@php echo ($file == 'admin_add_sub_admin') ? 'active':'' @endphp">
                            <i class="bi bi-circle"></i><span>Add</span>
                        </a>
                    </li>
                    @if ($filename[1] == 'edit_admin')
                        <li>
                            <a href="/admin/edit_admin/{{ $file }}"
                                class="@php echo ($filename[1] == 'edit_admin') ? 'active':'' @endphp">
                                <i class="bi bi-circle"></i><span>Manage</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link @php echo ($file == 'profile_update') ? 'collapse':'collapsed' @endphp"
                href="{{ url('admin/profile_update') }}"
                class="@php echo ($file == 'profile_update') ? 'active':'' @endphp">
                <i class="mdi mdi-account mdi-24px"></i>
                <span>Profile Info</span>
            </a>
        </li>

        <!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.logout') }}">
                <i class="fa fa-sign-out fa-xl pt-1" style="font-size: 24px;margin-top:-5px;margin-left:3px;"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
