<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title') | {{ app_settings()['app_name'] ?? config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon"
          href="{{ asset(app_settings()['app_icon']) ?: 'https://coderthemes.com/ubold/layouts/assets/images/favicon.ico' }}">

@stack('css')

    <link href="{{ asset('/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App css -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
          id="bs-default-stylesheet"/>
    <link href="{{ asset('/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet"/>

    <link href="{{ asset('/assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css"
          id="bs-dark-stylesheet"/>
    <link href="{{ asset('/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet"/>
    <!-- icons -->
    <link href="{{ asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>

    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

</head>

<body class="loading">
<div id="wrapper">

    <!-- Topbar Start -->
@include('backend.partials._topbar')
<!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
@include('backend.partials._sidebar')
<!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="page-title-box">
                            <h4 class="page-title">@yield('page_title') </h4>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 mt-sm-3 mb-3">
                        <div class="page-title-box">
                            @hasSection('actions')
                                <div class="btn-group float-right">
                                    <button type="button"
                                            class="btn btn-success btn-sm ml-1 dropdown-toggle"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                        {{ __t('action') }} <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                        @yield('actions')
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                @include('backend.partials._alert_message')


                @yield('content')

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
    @include('backend.partials._footer')
    <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Vendor js -->
<script src="{{ asset('/assets/js/vendor.min.js') }}"></script>

<script src="{{ asset('/assets/libs/select2/js/select2.min.js') }}"></script>

@stack('js')

<!-- App js -->
<script src="{{ asset('/assets/js/app.min.js') }}"></script>

<script src="{{ asset('js/clock.js') }}"></script>

<script>

    $('.select2').select2()

    $('#per_page').on('change', function () {
        $("#filter").submit()
    })

    @if(session()->get('success'))

    swal.fire({
        icon: 'success',
        title: "Success !",
        text: "{{ session()->get('success') }}",
        type: "success",
        timer: 3000
    });

    $('.alert-success').delay(5000).fadeOut('slow');
    @endif


</script>

</body>
</html>
