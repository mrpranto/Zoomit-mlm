<div class="col-12 col-sm-10">
    <div class="card-box">
        <h5 class="font-18"><i class="fe-user-plus mr-2"></i>{{ __t('social_links') }}</h5>
        <hr>

        <form method="post" action="{{ route('profile.social-links') }}" class="form-horizontal">
            @csrf

            <input type="hidden" value="{{ $profile['id'] }}" name="user_id">
            <div class="form-group row mb-3">
                <label for="facebook" class="col-12 col-sm-2 col-md-2 col-form-label"><i class="fe-facebook"></i> {{ __t('facebook') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="text" name="social_link[facebook]" value="{{ old('social_link') ? old('social_link')['facebook'] : $facebook }}" id="facebook"
                           placeholder="{{ __t('facebook') }}"
                           class="form-control @error('facebook') is-invalid @enderror" autocomplete="off">

                    @error('facebook')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="google" class="col-12 col-sm-2 col-md-2 col-form-label"><i class="fab fa-google-plus-g"></i> {{ __t('google') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="text" name="social_link[google]" value="{{ old('social_link') ? old('social_link')['google'] : $google }}" id="google"
                           placeholder="{{ __t('google') }}"
                           class="form-control @error('google') is-invalid @enderror" autocomplete="off">

                    @error('google')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="github" class="col-12 col-sm-2 col-md-2 col-form-label"><i class="fe-github"></i> {{ __t('github') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="text" name="social_link[github]" value="{{ old('social_link') ? old('social_link')['github'] : $github }}" id="github"
                           placeholder="{{ __t('github') }}"
                           class="form-control @error('password') is-invalid @enderror" autocomplete="off">

                    @error('github')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="twitter" class="col-12 col-sm-2 col-md-2 col-form-label"><i class="fe-twitter"></i> {{ __t('twitter') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="text" name="social_link[twitter]" value="{{ old('social_link') ? old('social_link')['twitter'] : $twitter }}" id="twitter"
                           placeholder="{{ __t('twitter') }}"
                           class="form-control @error('twitter') is-invalid @enderror" autocomplete="off">

                    @error('twitter')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="linkedin" class="col-12 col-sm-2 col-md-2 col-form-label"><i class="fe-linkedin"></i> {{ __t('linkedin') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="text" name="social_link[linkedin]" value="{{ old('social_link') ? old('social_link')['linkedin'] : $linkedin }}" id="linkedin"
                           placeholder="{{ __t('linkedin') }}"
                           class="form-control @error('linkedin') is-invalid @enderror" autocomplete="off">

                    @error('linkedin')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row mb-3">
                <label for="instagram" class="col-12 col-sm-2 col-md-2 col-form-label"><i class="fe-instagram"></i> {{ __t('instagram') }}</label>
                <div class="col-12 col-sm-9 col-md-9">
                    <input type="text" name="social_link[instagram]" value="{{ old('social_link') ? old('social_link')['instagram'] : $instagram }}" id="instagram"
                           placeholder="{{ __t('instagram') }}"
                           class="form-control @error('instagram') is-invalid @enderror" autocomplete="off">

                    @error('instagram')
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
