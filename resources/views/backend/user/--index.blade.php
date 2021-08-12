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
        </div>

        @foreach($users as $key => $user)

            <div class="col-12 col-sm-12 col-md-3">
                <div class="text-center card-box">

                    @if (auth()->user()->role->slug == "admin")
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" style="">
                                @can('app.user.edit')
                                    <a  data-toggle="modal"
                                        data-target="#bs-example-modal-lg{{ $user->id }}" class="dropdown-item"><i
                                            class="fas fa-pencil-alt"></i> {{ __t('edit') }}</a>
                                @endcan
                                @can('app.user.delete')
                                    @if ($user->id != 1)
                                        <a href="#" onclick="checkDelete({{ $user->id }})" class="dropdown-item">
                                            <i class="fas fa-trash-alt"></i> {{ __t('delete') }}</a>
                                        <form method="post" action="{{ route('users.destroy', $user->id) }}"
                                              id="delete_{{ $user->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                @endcan
                            </div>
                        </div>
                    @endif


                    <div class="pt-2 pb-2">

                        <a href="{{ route('profile') }}?user={{ $user->id }}&tabs=personal_info">
                            @if (optional($user->profilePicture)->path)
                                <img src="{{ optional($user->profilePicture)->full_url }}" class="rounded-circle img-thumbnail avatar-xl"
                                     alt="{{ $user->name }}">
                            @else
                                <img src="../assets/images/users/user-3.jpg" class="rounded-circle img-thumbnail avatar-xl"
                                     alt="profile-image">
                            @endif
                        </a>

                        <h4 class="mt-3"><a href="{{ route('profile') }}?user={{ $user->id }}&tabs=personal_info" class="text-dark">{{ $user->name }}</a></h4>
                        <p class="text-muted">
                            <span>{{ '@'.$user->role->name }}</span>
                            <br>
                            <span>{{ __t('user_generated_id') }}: {{ $user->user_generated_id }}</span>
                            <br>
                            <span> <a href="mailto:{{ $user->email }}" class="text-muted">{{ $user->email }}</a> </span>
                            <br>
                            <span>{{ __t('phone') }}: {{ $user->phone }} </span>
                            <br>
                        </p>

                        @php
                            $social_links = resolve(\App\Repository\CustomInfoRepository::class)->formatInformation($user->socialLinks);
                            $facebook = array_key_exists('facebook', $social_links) ? $social_links['facebook'] : '';
                            $google = array_key_exists('google', $social_links) ? $social_links['google'] : '';
                            $github = array_key_exists('github', $social_links) ? $social_links['github'] : '';
                            $twitter = array_key_exists('twitter', $social_links) ? $social_links['twitter'] : '';
                            $linkedin = array_key_exists('linkedin', $social_links) ? $social_links['linkedin'] : '';
                            $instagram = array_key_exists('instagram', $social_links) ? $social_links['instagram'] : '';
                        @endphp


                        <a href="{{ $facebook }}" target="_blank" class="btn btn-primary btn-xs waves-effect waves-light"><i class="fe-facebook"></i></a>
                        <a href="{{ $google }}" target="_blank" class="btn btn-danger btn-xs waves-effect"><i class="fab fa-google-plus-g"></i></a>
                        <a href="{{ $github }}" target="_blank" class="btn btn-dark btn-xs waves-effect"><i class="fe-github"></i></a>
                        <a href="{{ $twitter }}" target="_blank" class="btn btn-info btn-xs waves-effect"><i class="fe-twitter"></i></a>
                        <a href="{{ $linkedin }}" target="_blank" class="btn btn-blue btn-xs waves-effect"><i class="fe-linkedin"></i></a>
                        <a href="{{ $instagram }}" target="_blank" class="btn btn-soft-danger btn-xs waves-effect"><i class="fe-instagram"></i></a>

                    </div>
                </div>
            </div>

            @include('backend.user._edit',['user' => $user])

        @endforeach
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
