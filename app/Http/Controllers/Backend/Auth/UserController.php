<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserServices;
use App\Services\DistributeCommissionServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public $distribute;

    public function __construct(UserServices $services, DistributeCommissionServices $distribute)
    {
        $this->services = $services;
        $this->distribute = $distribute;
    }

    public function index()
    {
        Gate::authorize('app.user.index');

        return view('backend.user.index', array_merge($this->services->users(), $this->services->createCredentials()));
    }


    public function create()
    {
        Gate::authorize('app.user.create');

        return view('backend.user.create', $this->services->createCredentials());
    }


    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('app.user.create');

        $this->services
            ->validateUser($request)
            ->createUser($request)
            ->sendNotification($request);

        return created_response(__t('user'), 'users.index');
    }


    public function show($id)
    {
        Gate::authorize('app.user.index');

        //
    }


    public function edit(User $user)
    {
        Gate::authorize('app.user.edit');

        return view('backend.user.edit', compact('user'), $this->services->createCredentials());
    }


    public function update(Request $request, User $user): RedirectResponse
    {
        Gate::authorize('app.user.edit');

        $this->services
            ->validateUser($request, $user)
            ->updateUser($request, $user)
            ->sendUpdateNotification($request, $user);

        return updated_response(__t('user'), 'users.index');
    }


    public function destroy(User $user): RedirectResponse
    {
        Gate::authorize('app.user.delete');

        try {

            $this->services->deleteUser($user);

            return deleted_response(__t('user'));

        } catch (\Exception $exception) {

            return deleted_response(__t('user'), 'users.index', 'error', $exception->getCode());
        }

    }

    public function changeStatus(Request $request, User $user)
    {
        if ($request->status == "false") {

            $user->update(['status' => false]);
            return redirect()->back()->with('success', 'User in-active successful');

        } elseif ($request->status == "true") {

            $user->update(['status' => true]);
            $this->distribute->distributeCommission($user);

            return redirect()->back()->with('success', 'User active successful');
        }

    }

}
