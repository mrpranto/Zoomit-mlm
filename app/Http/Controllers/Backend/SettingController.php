<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\SettingServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
{

    public function __construct(SettingServices $services)
    {
        $this->services = $services;
    }

    public function index()
    {
        Gate::authorize('app.setting.index');

        return view('backend.setting.index', $this->services->indexPropertice());
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('app.setting.create');

        $this->services
             ->validate($request)
             ->store($request);

        Artisan::call('cache:clear');

        return created_response(__t('general_setting'));
    }

}
