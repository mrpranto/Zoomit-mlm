<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function index()
    {
        Gate::authorize('app.dashboard');

        return view('backend.home', $this->counts());
    }

    private function counts(): array
    {
        return [
            'users' => User::query()->count(),
        ];
    }
}
