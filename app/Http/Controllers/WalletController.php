<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
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

        $withdraws = $this->model->newQuery()->with('payment_type');

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
        return view('backend.wallet.withdraw_create', [
            'paymentTypes' => PaymentType::query()->pluck('name', 'id')
        ]);
    }

    public function processWithdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'withdrawal_type' => 'required|numeric|exists:payment_types,id',
            'withdrawal_number' => 'required|numeric',
        ]);

        $withdrawableAmount = ((auth()->user()->walletIncome->sum('amount') - auth()->user()->walletWithdraw->sum('amount')) - 100);

        if ($withdrawableAmount >= $request->amount) {
            Wallet::query()->create([
                'user_id' => auth()->id(),
                'payment_type_id' => $request->withdrawal_type,
                'amount' => $request->amount,
                'type' => 'withdraw',
                'withdraw_number' => $request->withdrawal_number,
            ]);

            return redirect()->back()->with('success', 'Your withdraw submit successful');

        } else {
            return redirect()->back()->with('error', 'Insufficient balance');
        }
    }
}
