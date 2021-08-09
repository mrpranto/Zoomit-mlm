@extends('backend.layouts.app')

@section('title', $profile['name'])

@section('page_title', __t('profile'))

@push('css')

    <link href="{{ asset('/assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>

@endpush

@section('content')


    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card-box">
                <div class="row align-items-center">

                    <div class="col-12 col-sm-5">
                        <div class="row">
                            <div class="col-12 col-sm-5 text-center">

                                @if ($profile['profile_picture'])
                                    <img src="{{ $profile['profile_picture'] }}" style="width: 170px;height: 170px"
                                         class="rounded-circle img-thumbnail"
                                         alt="profile-image">
                                @else
                                    <img src="{{ asset('/assets/images/users/user-3.jpg') }}"
                                         class="rounded-circle img-thumbnail"
                                         alt="profile-image">
                                @endif

                            </div>

                            <div class="col-12 col-sm-5 align-items-center mb-3">
                                <h4 class="mt-4 mb-0">{{ $profile['name'] }}</h4>
                                <p class="text-muted">@ {{ $profile['role'] }}</p>
                                @php
                                    $social_links = $profile['social_links'];
                                    $facebook = array_key_exists('facebook', $social_links) ? $social_links['facebook'] : '';
                                    $google = array_key_exists('google', $social_links) ? $social_links['google'] : '';
                                    $github = array_key_exists('github', $social_links) ? $social_links['github'] : '';
                                    $twitter = array_key_exists('twitter', $social_links) ? $social_links['twitter'] : '';
                                    $linkedin = array_key_exists('linkedin', $social_links) ? $social_links['linkedin'] : '';
                                    $instagram = array_key_exists('instagram', $social_links) ? $social_links['instagram'] : '';

                                @endphp

                                <a href="{{ $facebook }}" target="_blank" class="btn btn-primary btn-xs waves-effect waves-light"><i class="fe-facebook"></i></a>
                                <a href="{{ $google }}" target="_blank" class="btn btn-danger btn-xs waves-effect"><i class="fab fa-google-plus-g"></i></a>
                                <a href="{{ $github }}" target="_blank" class="btn btn-dark btn-xs waves-effect"><i class="fe-github"></i></a>
                                <a href="{{ $twitter }}" target="_blank" class="btn btn-info btn-xs waves-effect"><i class="fe-twitter"></i></a>
                                <a href="{{ $linkedin }}" target="_blank" class="btn btn-blue btn-xs waves-effect"><i class="fe-linkedin"></i></a>
                                <a href="{{ $instagram }}" target="_blank" class="btn btn-soft-danger btn-xs waves-effect"><i class="fe-instagram"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3">
                        <div class="widget-rounded-circle">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <i class="fas fa-phone-alt fa-3x"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="text-muted mb-0">{{ __t('phone') }}</p>
                                    <h5 class="mb-1">{{ $profile['phone'] }}</h5>
                                </div>
                            </div> <!-- end row-->
                        </div>

                        <div class="widget-rounded-circle">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <i class="fas fa-address-card fa-3x"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="text-muted mb-0">{{ __t('employee_id') }}</p>
                                    <h5 class="mb-1">{{ $profile['employee_id'] }}</h5>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div>

                    <div class="col-12 col-sm-3">
                        <div class="widget-rounded-circle">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <i class="fe-mail fa-3x"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="text-muted mb-0">{{ __t('email') }}</p>
                                    <h5 class="mb-1"><a
                                            href="mailto:{{ $profile['email'] }}">{{ $profile['email'] }}</a></h5>
                                </div>
                            </div>
                        </div>

                        <div class="widget-rounded-circle">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <i class="fas fa-gift fa-3x"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="text-muted mb-0">{{ __t('dob') }}</p>
                                    <h5 class="mb-1">{{ date(app_settings()['date_format'], strtotime($profile['dob'])) }}</h5>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div>

                </div>
            </div> <!-- end card-box -->
        </div>
    </div>

    <div class="row d-flex flex-row">
        <div class="col-12 col-sm-2 align-self-stretch">
            <div class="card-box">

                <h1 class="text-center"><i class="fe-user"></i></h1>
                @php
                    $url = (route('profile').'?user='.$profile['id'])
                @endphp

                <div class="mail-list">
                    @can('app.profile.Update')
                        <a href="{{ $url }}&tabs=personal_info"
                           class="{{ request('tabs') == "personal_info" ? "text-danger font-weight-bold" : "" }}">
                            <i class="fe-user-plus mr-2"></i>{{ __t('personal_info') }}
                        </a>
                    @endcan

                    @can('app.change.password')
                        <a href="{{ $url }}&tabs=password_change"
                           class="{{ request('tabs') == "password_change" ? "text-danger font-weight-bold" : "" }}">
                            <i class="ti-key mr-2"></i>{{ __t('password_change') }}
                        </a>
                    @endcan

                    @can('app.social.link')
                        <a href="{{ $url }}&tabs=social_links"
                           class="{{ request('tabs') == "social_links" ? "text-danger font-weight-bold" : "" }}">
                            <i class="fe-rss mr-2"></i>{{ __t('social_links') }}
                        </a>
                    @endcan

                </div>
            </div>
        </div>

        @if (request('tabs') == "personal_info" )

            @include('backend.user._personal_info')

        @elseif(request('tabs') == "password_change")

            @include('backend.user._change_password')

        @elseif(request('tabs') == "social_links")

            @include('backend.user._social_links')

        @endif


    </div>


@endsection

@push('js')

    <script src="{{ asset('/assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/dropify/js/dropify.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('/assets/js/pages/form-fileuploads.init.js') }}"></script>

@endpush
