<div class="modal fade" id="bs-example-modal-lg{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h4 class="modal-title" id="myLargeModalLabel">{{ __t('edit_user') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body border-bottom">
                    <div class="form-group row">
                        <label for="name_{{$user->id}}"
                               class="col-md-2 col-form-label text-md-right">{{ __t('name') }}</label>

                        <div class="col-md-9">
                            <input id="name_{{$user->id}}" type="text"
                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{ old('name') ?: $user->name }}" autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email_{{$user->id}}"
                               class="col-md-2 col-form-label text-md-right">{{ __t('email') }}</label>

                        <div class="col-md-9">
                            <input id="email_{{$user->id}}" type="text"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') ?: $user->email }}" autocomplete="off">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="phone_{{$user->id}}"
                               class="col-md-2 col-form-label text-md-right">{{ __t('phone') }}</label>

                        <div class="col-md-9">
                            <input id="phone_{{$user->id}}" type="text"
                                   class="form-control @error('phone') is-invalid @enderror" name="phone"
                                   value="{{ old('phone') ?: $user->phone }}" autocomplete="off">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="role_{{$user->id}}"
                               class="col-md-2 col-form-label text-md-right">{{ __t('role') }}</label>

                        <div class="col-md-9">
                            <select class="form-control @error('role') is-invalid @enderror" id="role_{{$user->id}}"
                                    name="role">
                                <option value="" selected disabled>- {{ __t('select_role') }} -</option>

                                @foreach($roles as $key => $value)
                                    <option value="{{ $key }}" {{ $user->role_id == $key ? 'selected' : '' }}> {{ $value }}</option>
                                @endforeach

                            </select>

                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dob_{{$user->id}}"
                               class="col-md-2 col-form-label text-md-right">{{ __t('dob') }}</label>

                        <div class="col-md-9">
                            <input id="dob_{{$user->id}}" type="date"
                                   class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth"
                                   value="{{ old('date_of_birth') ?: $user->date_of_birth }}" autocomplete="off">

                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="images_{{$user->id}}"
                               class="col-md-2 col-form-label text-md-right">{{ __t('images') }}</label>

                        <div class="col-md-9">
                            <input type="file" id="images_{{$user->id}}" name="user_image" data-plugins="dropify"
                                   data-default-file="{{ optional($user->profilePicture)->full_url ?: asset('assets/images/brands/dropbox.png') }}"/>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><i
                            class="fa fa-times"></i> {{ __t('close') }}</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ __t('save') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
