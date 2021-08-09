@extends('backend.layouts.app')

@section('title', __t('roles'))

@section('page_title')

    {{ __t('roles') }} &nbsp; @include('backend.partials._recordCount', ['data' => $roles])

@endsection

@section('actions')

    @can('app.role.create')

        <a class="dropdown-item" href="{{ route('roles.create') }}">
            <i class="fa fa-plus"></i> {{ __t('add_new') }}
        </a>

    @endcan

@endsection

@push('css')

    <link rel="stylesheet" href="{{ asset('/assets/libs/tablesaw/tablesaw.css') }}" type="text/css">

@endpush

@section('content')

    <div class="row">

        <div class="col-12 col-sm-12 col-md-12">
            <div class="text-center card-box">

                @include('backend.partials._table_filter')

                <div class="table-responsive">

                    <table class="tablesaw table mb-0">
                        <thead>
                        <tr>
                            <th scope="col" data-tablesaw-sortable-col
                                data-tablesaw-priority="persist">{{ __t('sl') }}</th>
                            <th scope="col" data-tablesaw-sortable-col
                                data-tablesaw-priority="2">{{ __t('name') }}</th>
                            <th scope="col" data-tablesaw-sortable-col
                                data-tablesaw-priority="2">{{ __t('slug') }}</th>
                            <th scope="col" data-tablesaw-sortable-col
                                data-tablesaw-priority="2">{{ __t('note') }}</th>
                            <th scope="col" data-tablesaw-sortable-col
                                data-tablesaw-priority="2">{{ __t('total_user') }}</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1"></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($roles as $key => $role)
                            <tr>
                                <td>{{ $key + $roles->firstItem() }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>{{ $role->note }}</td>
                                <td>{{ $role->users->count() }}</td>

                                @canany(['app.role.edit', 'app.role.delete'])
                                    <td>
                                        <div class="btn-group">
                                            @can('app.role.edit')
                                                <a href="{{ route('roles.edit', $role->id) }}" title="{{ __t('edit') }}"
                                                   class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>
                                            @endcan
                                            @if($role->delete_able)
                                                @can('app.role.delete')
                                                    <a href="#"
                                                       class="action-icon" title="{{ __t('delete') }}"
                                                       onclick="checkDelete({{ $role->id }})"><i class="mdi mdi-delete"></i></a>
                                                @endcan
                                            @endif
                                        </div>

                                        @if($role->delete_able)
                                            @can('app.role.delete')
                                                <form method="post" action="{{ route('roles.destroy', $role->id) }}"
                                                      id="delete_{{ $role->id }}" style="display: none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endcan
                                        @endif

                                    </td>
                                @endcanany
                            </tr>
                        @endforeach

                        </tbody>

                    </table>

                </div>


            </div>
        </div>

    </div>

    @include('backend.partials._paginate', ['data' => $roles])


@endsection

@push('js')

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


    </script>


@endpush
