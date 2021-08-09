<div class="col-12 col-sm-10">
    <div class="card-box">
        <h5 class="font-18"><i class="fe-user-plus mr-2"></i>{{ __t('personal_info') }}</h5>
        <hr>

        <form method="post" action="{{ route('profile.update', $profile['id']) }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="role" value="{{ $profile['role_id'] }}">
            <div class="form-group row mb-3">
                <label for="name" class="col-12 col-sm-2 col-md-2 col-form-label">{{ __t('name') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="text" name="name" value="{{ $profile['name'] }}" id="name" placeholder="{{ __t('name') }}" class="form-control @error('name') is-invalid @enderror" autocomplete="off">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="email" class="col-12 col-sm-2 col-md-2 col-form-label">{{ __t('email') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="email" name="email" value="{{ $profile['email'] }}" id="email" placeholder="{{ __t('email') }}" class="form-control @error('email') is-invalid @enderror" autocomplete="off">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="phone" class="col-12 col-sm-2 col-md-2 col-form-label">{{ __t('phone') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="text" name="phone" value="{{ $profile['phone'] }}" id="phone" placeholder="{{ __t('phone') }}" class="form-control @error('phone') is-invalid @enderror" autocomplete="off">

                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="dob" class="col-12 col-sm-2 col-md-2 col-form-label">{{ __t('dob') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="date" name="date_of_birth" value="{{ $profile['dob'] }}" id="dob" placeholder="{{ __t('dob') }}" class="form-control @error('date_of_birth') is-invalid @enderror" autocomplete="off">

                    @error('date_of_birth')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="user_image" class="col-12 col-sm-2 col-md-2 col-form-label">{{ __t('images') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="file" id="user_image" name="user_image" data-plugins="dropify"
                           data-default-file="{{ $profile['profile_picture'] ?: asset('assets/images/brands/dropbox.png') }}"/>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-11">
                    <a href="{{ url()->previous() }}" class="btn btn-dark waves-effect waves-light float-right">
                        <i class="mdi mdi-arrow-left"></i> {{ __t('back') }}
                    </a>


                    <button type="submit" class="btn btn-primary waves-effect waves-light float-right mr-2">
                        <i class="mdi mdi-content-save"></i> {{ __t('save') }}
                    </button>


                </div>
            </div>

        </form>

    </div>
</div>
