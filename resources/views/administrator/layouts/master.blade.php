<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Infinity Ltd" name="description">
    <meta content="Pham Son" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ optional(\App\Models\Logo::first())->image_path }}">

    @yield('title')

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/administrator/assets/css/bootstrap.min.css')}}"  rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{asset('assets/administrator/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{asset('assets/administrator/assets/css/app.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{asset('assets/administrator/products/add/add.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/administrator/products/index/list.css')}}" rel="stylesheet"/>
    <link href="{{asset('vendor/datetimepicker/daterangepicker.css')}}" rel="stylesheet"/>

    <style>

        @media (max-width: 991.98px){
            .footer {
                left: 0 !important;
            }
        }
        @media (max-width: 992px) {
            .navbar-brand-box {
                display: none !important;
            }

            #myTab > li{
                width: 100%;
            }
            .nav-tabs>li.active>a{
                border-bottom-color: #ddd !important;
            }

        }

        .search_init{
            display: inline-block !important;
        }

        @media (max-width: 425px){
            .search-wrap{
                width: 100% !important;
            }
        }

        .border-search{
            border: 1px solid black;
            padding: 10px;
            border-radius: 10px;
        }

    </style>

    <style>
        .lend-status-1{
            border-radius: 10px;
            border: 1px solid #ffc35a;
            background: #fff8ebdb;
            color: #ffc35a;
            padding: 5px;
        }

        .lend-status-2{
            border-radius: 10px;
            border: 1px solid #2cd1ff;
            background: #eefbff;
            color: #00c7ff;
            padding: 5px;
        }

        .delete-status{
            border-radius: 10px;
            border: 1px solid #ff0000;
            background: #ffe9e9;
            color: #ff0000;
            padding: 5px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .image_modal{
            cursor: pointer;
        }
    </style>

    @yield('css')
</head>

<body id="body" data-sidebar="dark">


<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<!-- Begin page -->
<div id="layout-wrapper">

@include('administrator.components.header')

<!-- ========== Left Sidebar Start ========== -->
@include('administrator.components.slidebars')
<!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal image -->
    <div class="modal fade" id="modal_image" tabindex="-1" aria-labelledby="modal_imageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="img_modal_image" src="">
                </div>
            </div>
        </div>
    </div>

@include('administrator.components.footer')
<!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title px-3 py-4">
            <a href="javascript:void(0);" class="right-bar-toggle float-end">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>

        <!-- Settings -->
        <hr class="mt-0">
        <h6 class="text-center mb-0">Choose Layouts</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="{{asset('administrator/assets/administrator/assets/images/layouts/layout-1.jpg')}}" class="img-fluid img-thumbnail"
                     alt="Layouts-1">
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch">
                <label class="form-check-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="{{asset('administrator/assets/administrator/assets/images/layouts/layout-2.jpg')}}" class="img-fluid img-thumbnail"
                     alt="Layouts-2">
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch"
                       data-bsStyle="{{asset('administrator/assets/administrator/assets/css/bootstrap-dark.min.css')}}"
                       data-appStyle="{{asset('administrator/assets/administrator/assets/css/app-dark.min.css')}}">
                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <div class="mb-2">
                <img src="{{asset('administrator/assets/administrator/assets/images/layouts/layout-3.jpg')}}" class="img-fluid img-thumbnail"
                     alt="Layouts-3">
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch"
                       data-appStyle="{{asset('administrator/assets/administrator/assets/css/app-rtl.min.css')}}">
                <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
            </div>


        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>


<!-- JAVASCRIPT -->
<script src="{{asset('assets/administrator/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/administrator/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/administrator/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/administrator/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/administrator/assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/administrator/assets/js/app.js')}}"></script>
<script src="{{asset('assets/administrator/assets/js/init.js')}}"></script>
<script src="{{asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{asset('vendor/sweet-alert-2/sweetalert2@11.js')}}"></script>
<script src="{{asset('vendor/datetimepicker/moment.min.js')}}"></script>
<script src="{{asset('vendor/datetimepicker/daterangepicker.js')}}"></script>
<script src="{{asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/administrator/products/add/add.js')}}"></script>
<script src="{{asset('assets/administrator/products/index/list.js')}}"></script>

<script>

    $(".image_modal").on("click", function(){
        const src = $(this).attr("src");
        $("#img_modal_image").attr("src",src);
        const myModal = new bootstrap.Modal(document.getElementById('modal_image'))
        myModal.show()
    });

</script>

@yield('js')

</body>


</html>
