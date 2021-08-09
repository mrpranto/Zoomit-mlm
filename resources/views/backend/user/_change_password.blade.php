<div class="col-12 col-sm-10">
    <div class="card-box">
        <h5 class="font-18"><i class="fe-user-plus mr-2"></i>{{ __t('password_change') }}</h5>
        <hr>

        <form method="post" action="{{ route('profile.change-password') }}" class="form-horizontal">
            @csrf

            <input type="hidden" name="user_id" value="{{ $profile['id'] }}">

            @if ($profile['id'] == auth()->id())

                <div class="form-group row mb-3">
                    <label for="old_password" class="col-12 col-sm-2 col-md-2 col-form-label">{{ __t('old_password') }}</label>
                    <div class="col-12 col-sm-9 col-md-9">
                        <input type="password" name="old_password" value="" id="old_password"
                               placeholder="{{ __t('old_password') }}"
                               class="form-control @error('old_password') is-invalid @enderror" autocomplete="off">

                        @error('old_password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

            @endif

            <div class="form-group row mb-3">
                <label for="password" class="col-12 col-sm-2 col-md-2 col-form-label">{{ __t('new_password') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="password" name="password" value="" id="password"
                           placeholder="{{ __t('new_password') }}"
                           class="form-control @error('password') is-invalid @enderror" autocomplete="off">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row mb-3">
                <label for="password_confirmation" class="col-12 col-sm-2 col-md-2 col-form-label">{{ __t('confirm_password') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="password" name="password_confirmation" value="" id="password_confirmation"
                           placeholder="{{ __t('confirm_password') }}"
                           class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="off">

                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <div class="col-11">
                    <a href="{{ url()->previous() }}" class="btn btn-dark waves-effect waves-light float-right">
                        <i class="mdi mdi-arrow-left"></i> Back
                    </a>


                    <button type="submit" class="btn btn-primary waves-effect waves-light float-right mr-2">
                        <i class="mdi mdi-content-save"></i> Save
                    </button>


                </div>
            </div>

        </form>

    </div>
</div>
