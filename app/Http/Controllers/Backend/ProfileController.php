<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ProfileServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct(ProfileServices $services)
    {
        $this->services = $services;
    }

    public function profile(Request $request)
    {
        Gate::authorize('app.profile.Update');

        if ($request->user == null){

            return redirect()->route('users.index');
        }

        return view('backend.user.profile', ['profile' => $this->services->getProfileInfo($request)]);
    }



    public function updateProfile(Request $request, $id): RedirectResponse
    {

        Gate::authorize('app.profile.Update');

        $user = User::query()->findOrFail($id);

        $this->services->updateProfile($request, $user);

        return updated_response(__t('profile'));
    }



    public function changePassword(Request $request): RedirectResponse
    {
        Gate::authorize('app.change.password');

        $this->services->validatePassword($request);

        if ($request->user_id == auth()->id()) {

            if (!isset($request->old_password) || !Hash::check($request->old_password, auth()->user()->password)) {

                return redirect()->back()->with('error', __t('not_match_password'));
            }
        }


        $this->services->changePassword($request);

        if ($request->user_id == auth()->id()) {

            auth()->logout();

            return redirect()->route('login')->with('success', __t('password_changed'));

        }else{

            return redirect()->back()->with('success', __t('password_changed'));
        }

    }


    public function socialLinks(Request $request)
    {
        $user = User::query()->findOrFail($request->user_id);

        $this->services
            ->validateSocialLinks($request)
            ->storeLinks($request, $user);

        return updated_response(__t('social_links'));
    }

}
