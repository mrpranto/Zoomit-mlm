<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
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
        $balance = 0;
        $totalUserIncome = Wallet::query()->where('user_id', auth()->id())->where('type', 'income')->sum('amount');
        $totalUserWithdraw = Wallet::query()->where('user_id', auth()->id())->where('type', 'withdraw')->sum('amount');
        $balance = $totalUserIncome - $totalUserWithdraw;

        return [
            'users' => User::query()->count(),
            'balance' => $balance,
            'total_income' => $totalUserIncome,
            'total_withdraw' => $totalUserWithdraw,
            'fund_transfer' => 0,
            'e_pin' => 0,
            'today_joining' => 0,
            'service' => 0,
        ];
    }
}
