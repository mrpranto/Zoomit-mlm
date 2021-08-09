<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Services\RoleServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function __construct(RoleServices $roleServices)
    {
        $this->services = $roleServices;
    }

    public function index(Request $request)
    {
        Gate::authorize('app.role.index');

        return view('backend.role.index', $this->services->roles($request));
    }


    public function create()
    {
        Gate::authorize('app.role.create');

        return view('backend.role.create', $this->services->createCredentials());
    }


    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('app.role.create');

        $this->services
            ->validateRole($request)
            ->storeRole($request);

        return created_response(__t('role'));
    }


    public function show($id)
    {
        Gate::authorize('app.role.index');
    }


    public function edit(Role $role)
    {
        Gate::authorize('app.role.edit');

        $credentials = array_merge($this->services->createCredentials(), ['role' => $role->load('permissions')]);

        return view('backend.role.edit', $credentials);
    }


    public function update(Request $request, Role $role): RedirectResponse
    {
        Gate::authorize('app.role.edit');

        $this->services
            ->validateRole($request)
            ->updateRole($request, $role);

        return updated_response(__t('role'),'roles.index');
    }


    public function destroy(Role $role): RedirectResponse
    {
        Gate::authorize('app.role.delete');

        try {

            $role->permissions()->detach();
            $role->delete();
            return deleted_response(__t('role'));

        }catch (\Exception $e){

            return deleted_response(__t('role'), null, 'error', $e->getCode());
        }
    }
}
