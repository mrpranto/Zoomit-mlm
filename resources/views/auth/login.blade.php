<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Log In | {{ app_settings()['app_name'] ?: config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ app_settings()['app_icon'] ?: 'https://coderthemes.com/ubold/layouts/assets/images/favicon.ico' }}">

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

    <style>
        body.authentication-bg {
            background-color: #dad7ec !important;
            background-size: cover;
            background-position: center;
        }
    </style>

</head>

<body class="loading authentication-bg authentication-bg-pattern">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="{{ url('/') }}" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{ app_settings()['app_logo'] ?: asset('/assets/images/logo-dark.png') }}" alt="" height="40">
                                    </span>
                                </a>

                                <a href="{{ url('/') }}" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{ app_settings()['app_logo'] ?: asset('/assets/images/logo-light.png') }}" alt="" height="40">
                                    </span>
                                </a>
                            </div>
                        </div>

                        @include('backend.partials._alert_message')

                        <form method="POST" action="{{ route('processed.login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="email_or_phone">E-Mail or Phone</label>
                                <input id="email_or_phone" type="text" class="form-control @error('email_or_phone') is-invalid @enderror"
                                       name="email_or_phone" value="{{ old('email_or_phone') }}" required autocomplete="email" autofocus>

                                @error('email_or_phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">
                                    <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <i class="fas fa-key"></i>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block mb-2" type="submit"> {{ __('Login') }} </button>
                                <a href="{{ route('user-registration.page') }}" class="btn btn-link">Register as a new user.</a>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<script src="{{ asset('/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('/assets/js/app.min.js') }}"></script>
<script>
    @if(session()->get('success'))

        swal.fire({
            icon: 'success',
            title: "Success !",
            text: "{{ session()->get('success') }}",
            type: "success",
            timer: 3000
        });

    @endif

</script>

</body>
</html>
