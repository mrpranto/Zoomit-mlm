@extends('backend.layouts.app')

@section('title', __t('app_setting'))

@section('page_title', __t('app_setting'))

@push('css')
    <link href="{{ asset('/assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')

    <div class="row d-flex flex-row">

        <div class="col-12 col-sm-3 col-md-3 align-self-stretch">
            <div class="card-box">
                <h2 class="text-center"><i class="icon-settings"></i></h2>

                <div class="mail-list">
                    <a href="?tabs=general"
                       class="{{ request('tabs') == "general" ? 'text-danger font-weight-bold' : '' }}">
                        <i class="dripicons-gear mr-2"></i>{{ __t('general') }}
                    </a>
                    <a href="?tabs=email-setup"
                       class="{{ request('tabs') == "email-setup" ? 'text-danger font-weight-bold' : '' }}">
                        <i class="dripicons-mail mr-2"></i>{{ __t('email_setup') }}
                    </a>
                </div>
            </div>
        </div>

        @if (request('tabs') == "general")

            <div class="col-12 col-sm-9 col-md-9 align-self-stretch">
                <div class="card-box">
                    <h5 class="font-18"><i class="dripicons-gear mr-2"></i>{{ __t('general') }}</h5>
                    <hr>

                    <form method="post" action="{{ route('setting.store') }}" class="form-horizontal"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="form-group row mb-3">
                            <label for="app_name" class="col-12 col-sm-3 col-md-3 col-form-label">{{ __t('app_name') }}</label>
                            <div class="col-sm-8 col-md-8">
                                <input type="text" name="setting[app_name]" class="form-control"
                                       value="{{ $general_settings['app_name'] }}" id="app_name"
                                       placeholder="{{ __t('app_name') }}" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="app_name" class="col-12 col-sm-3 col-md-3 col-form-label">{{ __t('app_logo') }}</label>
                            <div class="col-sm-8 col-md-8">
                                <input type="file" name="setting[app_logo]" data-plugins="dropify"
                                       data-default-file="{{ $general_settings['app_logo'] == 'default.png' ? asset('assets/images/brands/dropbox.png') : $general_settings['app_logo'] }}"/>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="app_name" class="col-12 col-sm-3 col-md-3 col-form-label">{{ __t('app_icon') }}</label>
                            <div class="col-sm-8 col-md-8">
                                <input type="file" name="setting[app_icon]" data-plugins="dropify"
                                       data-default-file="{{ $general_settings['app_icon'] == 'default.png' ? asset('assets/images/brands/dropbox.png') : $general_settings['app_icon'] }}"/>
                            </div>
                        </div>


                        <div class="form-group row mb-3">
                            <label for="date_format" class="col-12 col-sm-3 col-md-3 col-form-label">{{ __t('date_format') }}</label>
                            <div class="col-sm-8 col-md-8">
                                <select name="setting[date_format]" class="form-control">
                                    <option value="">- {{ __t('select') }} {{ __t('date_format') }} -</option>
                                    ';
                                    @foreach ($date_format as $value)
                                        <option
                                            {{ $general_settings['date_format'] == $value ? 'selected' : '' }} value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row mb-3">
                            <label for="time_format" class="col-12 col-sm-3 col-md-3 col-form-label">{{ __t('time_format') }}</label>
                            <div class="col-sm-8 col-md-8">
                                <div class="radio radio-primary mb-2">
                                    @foreach ($time_format as $key => $value)
                                        &nbsp;&nbsp;&nbsp;      <input type="radio" name="setting[time_format]"
                                                                       id="radio_{{ $key }}"
                                                                       {{ $general_settings['time_format'] == $key ? 'checked' :  '' }} value="{{ $key }}">
                                        <label for="radio_{{ $key }}">{{ $value }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="currency_symbol"
                                   class="col-12 col-sm-3 col-md-3 col-form-label">{{ __t('currency_symbol') }}</label>
                            <div class="col-sm-8 col-md-8">
                                <input type="text" name="setting[currency_symbol]" class="form-control"
                                       value="{{ $general_settings['currency_symbol'] ?? '$' }}" id="currency_symbol"
                                       placeholder="{{ __t('currency_symbol') }}" autocomplete="off">
                            </div>
                        </div>


                        <div class="form-group row mb-3">
                            <label for="pagination" class="col-12 col-sm-3 col-md-3 col-form-label">{{ __t('pagination') }}</label>
                            <div class="col-12 col-sm-8 col-md-8">
                                <input type="number" name="setting[pagination]" class="form-control"
                                       value="{{ $general_settings['pagination'] ?? '15' }}" id="currency_symbol"
                                       placeholder="{{ __t('pagination') }}" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-11">
                                <a href="{{ url()->previous() }}"
                                   class="btn btn-dark waves-effect waves-light float-right">
                                    <i class="mdi mdi-arrow-left"></i> {{ __t('back') }}
                                </a>

                                @can('app.setting.create')

                                    <button type="submit"
                                            class="btn btn-primary waves-effect waves-light float-right mr-2">
                                        <i class="mdi mdi-content-save"></i> {{ __t('save') }}
                                    </button>

                                @endcan

                            </div>
                        </div>

                    </form>

                </div>
            </div>

        @endif

    </div>

@endsection

@push('js')
    <!-- Plugins js -->
    <script src="{{ asset('/assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/dropify/js/dropify.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('/assets/js/pages/form-fileuploads.init.js') }}"></script>
@endpush
