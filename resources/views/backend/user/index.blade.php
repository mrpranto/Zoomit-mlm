@extends('backend.layouts.app')

@section('title', __t('users'))

@section('page_title')

    {{ __t('users') }} &nbsp; @include('backend.partials._recordCount', ['data' => $users])

@endsection

@section('actions')

    @can('app.user.create')

        {{--        <a class="dropdown-item"--}}
        {{--           data-toggle="modal"--}}
        {{--           data-target="#bs-example-modal-lg">--}}
        {{--            <i class="fa fa-plus"></i> {{ __t('add_new') }}--}}
        {{--        </a>--}}

    @endcan

@endsection

@push('css')

    <link href="{{ asset('/assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>

@endpush

@section('content')



    <div class="row">

        <div class="col-12 col-sm-12">
            @include('backend.partials._table_filter')

            <div class="card-box">
                <table class="tablesaw table">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>User Id</th>
                        <th>Sponsor Name</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Balance</th>
                        <th>Pay status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ ($users->firstItem()+$key) }}</td>
                            <td>{{ $user->user_generated_id }}</td>
                            <td>@if($user->sponsor){{ optional($user->sponsor)->phone }}
                                <small>({{ optional($user->sponsor)->name }})</small>@endif</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                @if($user->status == true)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">In-Active</span>
                                @endif
                            </td>
                            <td>
                                @if($user->role->slug === 'user')
                                    {{ currency(optional($user->walletIncome)->sum('amount')) }}
                                @elseif($user->role->slug === 'admin')
                                    {{ currency(($total_registration_fee - $total_income)) }}
                                @endif
                            </td>
                            <td>
                                @if($user->role->slug === 'user')
                                    @if($user->payment && $user->payment->sum('amount') >= 1000)
                                        <span class="badge badge-success">Paid</span>
                                    @else
                                        <span class="badge badge-danger">Due</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($user->role->slug === 'user')
                                    @if($user->status == true)
                                        @can('app.user.in_active')
                                            <a href="{{ route('users.change-status', $user->id) }}?status=false"
                                               class="action-icon" title="In-Active User"><i
                                                    class="fe-x-square"></i></a>
                                        @endcan
                                    @else
                                        @can('app.user.active')
                                            <a href="{{ route('users.change-status', $user->id) }}?status=true"
                                               class="action-icon" title="Active User"><i
                                                    class="fe-check-square"></i></a>
                                        @endcan
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('backend.partials._paginate', ['data' => $users])


@endsection

@push('js')

    <!-- Plugins js -->
    <script src="{{ asset('/assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/dropify/js/dropify.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('/assets/js/pages/form-fileuploads.init.js') }}"></script>

    <script>
        function checkDelete(id) {
            Swal.fire({
                title: '{{ __t('sure?') }}',
                text: '{{ __t('delete?') }}',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0462bc',
                cancelButtonColor: '#d33',
                cancelButtonText: '<i class="fe-x-square"></i> No',
                confirmButtonText: '<i class="fe-check-square"></i> Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#delete_" + id).submit()
                }
            })
        }

        function generatePassword() {
            var randomstring = Math.random().toString(36).slice(-8);
            $("#password").val(randomstring)

        }


    </script>


@endpush
