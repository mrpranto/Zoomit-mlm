<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WalletController extends Controller
{
    public $model;

    public function __construct(Wallet $wallet)
    {
        $this->model = $wallet;
    }

    public function incomes()
    {
        Gate::authorize('app.income.index');

        $incomes = $this->model->newQuery();

        if (auth()->user()->role->slug == 'user') {
            $incomes->where('user_id', auth()->id())->where('type', 'income');
        } else {
            $incomes->where('type', 'registration_fee');
        }

        return view('backend.wallet.incomes', [
            'incomes' => $incomes->paginate(\request('per_page') ?: app_settings()['pagination'])
        ]);
    }


    public function withdraw()
    {
        Gate::authorize('app.withdraw.index');

        $withdraws = $this->model->newQuery();

        if (auth()->user()->role->slug == 'user') {
            $withdraws->where('user_id', auth()->id())->where('type', 'withdraw');
        } else {
            $withdraws->where('type', 'withdraw');
        }

        return view('backend.wallet.withdraws', [
            'withdraws' => $withdraws->paginate(\request('per_page') ?: app_settings()['pagination'])
        ]);
    }


    public function withdrawCreate()
    {

    }
}
