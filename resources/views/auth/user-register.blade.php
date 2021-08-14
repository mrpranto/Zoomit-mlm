<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>User Registration | {{ app_settings()['app_name'] ?: config('app.name') }}</title>
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
            <div class="col-md-8 col-lg-7 col-xl-7">
                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto mb-4">
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

                        <form method="POST" action="{{ route('processed.register') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="sponsor_number">Sponsor Phone Number</label>
                                <input id="sponsor_number" type="text" class="form-control"
                                       name="sponsor_number" value="{{ old('sponsor_number') }}" >

                                @error('sponsor_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control"
                                       name="name" value="{{ old('name') }}" required >

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                       name="phone_number" value="{{ old('phone_number') }}" required>

                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address">{{ old('address') }}</textarea>
                            </div>


                            <div class="form-group mb-3">
                                <label for="payment_type">Payment Type</label>
                                <select name="payment_type" id="payment_type" class="form-control @error('payment_type') is-invalid @enderror">
                                    <option value="" disabled selected>- Select Payment Type -</option>

                                    @foreach($payment_types as $key => $payment_type)
                                        <option {{ old('payment_type') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $payment_type }}</option>
                                    @endforeach

                                </select>

                                @error('payment_type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="payment_type">Payment Amount</label>
                                <input type="number" step="0.01" class="form-control @error('payment_amount') is-invalid @enderror" name="payment_amount" value="{{ old('payment_amount') }}">
                                @error('payment_amount')
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
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation"
                                           class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
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
                                    <input type="checkbox" class="custom-control-input" name="terms_and_condition"
                                           id="terms_and_condition" value="1" {{ old('terms_and_condition') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="terms_and_condition">Terms & condition</label>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block mb-2" type="submit"> Registration </button>
                                <a href="{{ route('login') }}" class="btn btn-link">Are you have already an account ?</a>
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
