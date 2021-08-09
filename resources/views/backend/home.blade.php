@extends('backend.layouts.app')

@section('title', __t('dashboard'))

@section('page_title')

    Welcome to dashboard

@endsection

@section('actions')

    @can('app.quotation_type.create')

        <a class="dropdown-item" href="{{ route('quotation.create') }}">
            <i class="fa fa-plus"></i> {{ __t('add_quotation') }}
        </a>

        <a class="dropdown-item" href="{{ route('product.index') }}">
            <i class="fa fa-plus"></i> {{ __t('add_product') }}
        </a>

    @endcan

@endsection

@section('content')


    <div class="row">

        <div class="col-12 col-sm-12 col-md-3 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="fe-user-check font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1"><span data-plugin="counterup">{{ $users }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __t('total').' '.__t('users') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card-box pb-2">
                <div class="float-right d-none d-md-inline-block">
                    <div class="btn-group mb-2">
                        <button type="button" class="btn btn-xs btn-light">Today</button>
                        <button type="button" class="btn btn-xs btn-light">Weekly</button>
                        <button type="button" class="btn btn-xs btn-secondary">Monthly</button>
                    </div>
                </div>

                <h4 class="header-title mb-3">{{ __t('quotation_analytics') }}</h4>

                <div dir="ltr">
                    <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script src="{{ asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script>

@endpush
