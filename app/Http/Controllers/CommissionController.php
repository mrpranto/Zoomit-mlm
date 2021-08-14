<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommissionController extends Controller
{
    public $commission;

    public function __construct(Commission $commission)
    {
        $this->commission = $commission;
    }

    public function setCommission()
    {
        Gate::authorize('app.commission.index');

        return view('backend.commission.create', [
            'commissions' => $this->commission->newQuery()->get()
        ]);
    }

    public function storeCommission(Request $request)
    {
        Gate::authorize('app.commission.update');

        $request->validate([
            'level_minimum_member.*' => 'required|numeric',
            'commission_amount.*' => 'required|numeric',
            'rank.*' => 'required',
            'notification.*' => 'required',
        ]);

        foreach ($request->commission_id as $key => $commission_id) {
            $this->commission
                ->newQuery()
                ->where('id', $commission_id)
                ->update([
                    'level_minimum_member' => $request->level_minimum_member[$key],
                    'commission' => $request->commission_amount[$key],
                    'rank' => $request->rank[$key],
                    'notification' => $request->notification[$key],
                ]);
        }

        return redirect()->back()->with('success', 'Commission Update successful.');

    }


}
