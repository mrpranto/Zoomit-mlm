<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Customer\Company;
use App\Models\Backend\Customer\Customer;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Product;
use App\Models\Backend\Quotation\Quotation;
use App\Models\Backend\Quotation\QuotationType;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
