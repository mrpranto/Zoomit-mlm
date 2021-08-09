<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthGate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user)
        {
            $permissions =  cache()->rememberForever('permissions', function (){
                return Permission::all();
            });

            foreach ($permissions as $key => $permission)
            {
                Gate::define($permission->slug, function ($user) use($permission) {

                   return $this->checkHasPermissions($user, $permission->slug);
                });
            }
        }

        return $next($request);
    }

    public function checkHasPermissions($user, $slug): bool
    {
        $permission = collect($user->rolePermissions)->where('slug', $slug)->count();

        return $permission ? true : false;
    }
}
