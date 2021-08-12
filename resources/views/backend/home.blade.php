@extends('backend.layouts.app')

@section('title', __t('dashboard'))

@section('page_title')

    Welcome to dashboard

@endsection

@section('actions')

    @can('app.quotation_type.create')



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

    </div>

@endsection

@push('js')

    <script src="{{ asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script>

@endpush
