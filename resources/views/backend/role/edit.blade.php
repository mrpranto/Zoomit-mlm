@extends('backend.layouts.app')

@section('title', __t('edit_role'))

@section('page_title')

    {{ __t('edit_role') }} &nbsp;

@endsection

@section('actions')

    @can('app.role.index')

        <a class="dropdown-item" href="{{ route('roles.index') }}">
            <i class="fa fa-list"></i> {{ __t('roles') }}
        </a>
        <a class="dropdown-item" href="{{ route('roles.create') }}">
            <i class="fa fa-plus"></i> {{ __t('add_new_role') }}
        </a>

    @endcan

@endsection

@push('css')



@endpush

@section('content')

    <div class="row">

        <div class="col-12 col-sm-12 col-md-8 offset-md-2">
            <div class="card-box p-5">

                <form method="post" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="name"
                               class="col-md-2 col-form-label text-md-right">{{ __t('role_name') }}</label>

                        <div class="col-md-10">
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{ old('name') ?? $role->name }}" autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="note"
                               class="col-md-2 col-form-label text-md-right">{{ __t('note') }}</label>

                        <div class="col-md-10">

                            <textarea name="note" class="form-control"
                                      id="note">{{ old('note') ?? $role->note }}</textarea>

                            @error('note')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="note"
                               class="col-md-2 col-form-label text-md-right">{{ __t('is_delete_able') }}</label>

                        <div class="col-md-10">
                            <label class="radio-inline"><input type="radio" name="is_delete"
                                                               value="1" {{ $role->delete_able == true ? 'checked' : '' }}>&nbsp; {{ __t('yes') }}
                            </label>
                            <label class="radio-inline ml-3"><input type="radio" name="is_delete"
                                                                    value="0" {{ $role->delete_able == false ? 'checked' : '' }}>&nbsp; {{ __t('no') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group row mb-3 mt-5">
                        <div class="col-md-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="select_all"
                                       id="select_all"
                                       {{ old('select_all') ? 'checked' : '' }} onchange="checkAll()">

                                <label class="form-check-label" for="select_all">
                                    {{ __t('select_all') }}
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        @foreach($modules as $module)

                            <div class="col-sm-6 mb-3">
                                <h5 class="text-center">{{ $module->name }}</h5>

                                <div class="row mt-3">
                                    @foreach($module->permissions as $key => $permission)

                                        <div class="col-sm-6">
                                            <div
                                                class="form-check @if(($key+1) % 2 == 0) float-right @endif">

                                                <input class="form-check-input permission" type="checkbox"
                                                       name="permission[]"
                                                       value="{{ $permission->id }}"
                                                       id="{{ $permission->slug }}"
                                                    {{ old('permission') && in_array($permission->id, old('permission'))
                                                        ? 'checked'
                                                        : (count($role->permissions) && in_array($permission->id, $role->permissions->pluck('id')->toArray())
                                                        ? 'checked'
                                                        : '') }}
                                                >

                                                <label class="form-check-label"
                                                       for="{{ $permission->slug }}">
                                                    {{ $permission->name }}
                                                </label>

                                            </div>
                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        @endforeach

                    </div>


                    <div class="form-group row">
                        <div class="col-12">
                            <a href="{{ url()->previous() }}"
                               class="btn btn-dark waves-effect waves-light float-right">
                                <i class="mdi mdi-arrow-left"></i> {{ __t('back') }}
                            </a>

                            @can('app.role.edit')

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

    </div>


@endsection

@push('js')

    <script type="text/javascript">

        function checkAll() {
            if ($("#select_all").is(':checked')) {
                $('.permission').prop('checked', true)
            } else {
                $('.permission').prop('checked', false)
            }
        }

    </script>


@endpush
