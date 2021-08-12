<?php

namespace App\Http\Controllers;

use App\Models\LevelIncome;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommissionSetController extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function commissionPage()
    {
        return view('backend.commission.create', $this->levelMember());
    }

    public function levelMember()
    {
        return [
            'level_one' => $this->levelOneMember(),
            'level_two' => $this->levelTwoMember(),
            'level_three' => $this->levelThreeMember(),
            'level_four' => $this->levelFourMember(),
            'level_five' => $this->levelFiveMember(),
            'level_six' => $this->levelSixMember(),
            'level_seven' => $this->levelSevenMember(),
            'level_eight' => $this->levelEightMember(),
            'level_nine' => $this->levelNineMember(),
            'level_ten' => $this->levelTenMember(),
        ];
    }

    public function levelOneMember()
    {
        return $this->user->newQuery()
            ->where('sponsor_user_id', $this->user->newQuery()->first()->id)
            ->get(['id', 'name', 'phone']);
    }

    public function levelTwoMember()
    {
        return $this->user->newQuery()
            ->whereIn('sponsor_user_id', $this->levelOneMember()->pluck('id'))
            ->get(['id', 'name', 'phone']);
    }

    public function levelThreeMember()
    {
        return $this->user->newQuery()
            ->whereIn('sponsor_user_id', $this->levelTwoMember()->pluck('id'))
            ->get(['id', 'name', 'phone']);
    }

    public function levelFourMember()
    {
        return $this->user->newQuery()
            ->whereIn('sponsor_user_id', $this->levelThreeMember()->pluck('id'))
            ->get(['id', 'name', 'phone']);
    }

    public function levelFiveMember()
    {
        return $this->user->newQuery()
            ->whereIn('sponsor_user_id', $this->levelFourMember()->pluck('id'))
            ->get(['id', 'name', 'phone']);
    }

    public function levelSixMember()
    {
        return $this->user->newQuery()
            ->whereIn('sponsor_user_id', $this->levelFiveMember()->pluck('id'))
            ->get(['id', 'name', 'phone']);
    }

    public function levelSevenMember()
    {
        return $this->user->newQuery()
            ->whereIn('sponsor_user_id', $this->levelSixMember()->pluck('id'))
            ->get(['id', 'name', 'phone']);
    }

    public function levelEightMember()
    {
        return $this->user->newQuery()
            ->whereIn('sponsor_user_id', $this->levelSevenMember()->pluck('id'))
            ->get(['id', 'name', 'phone']);
    }

    public function levelNineMember()
    {
        return $this->user->newQuery()
            ->whereIn('sponsor_user_id', $this->levelEightMember()->pluck('id'))
            ->get(['id', 'name', 'phone']);
    }

    public function levelTenMember()
    {
        return $this->user->newQuery()
            ->whereIn('sponsor_user_id', $this->levelNineMember()->pluck('id'))
            ->get(['id', 'name', 'phone']);
    }


    public function storeCommission(Request $request)
    {
        DB::transaction(function () use ($request){

            $this->storeLevelOneCommission($request);
            $this->storelevelTwoCommission($request);
            $this->storelevelThreeCommission($request);
            $this->storelevelFourCommission($request);
            $this->storelevelFiveCommission($request);
            $this->storelevelSixCommission($request);
            $this->storelevelSevenCommission($request);
            $this->storelevelEightCommission($request);
            $this->storelevelNineCommission($request);
            $this->storelevelTenCommission($request);

        });

        return redirect()->back()->with('success', 'Commission Set successful');
    }

    public function storeWallet(array $wallets)
    {
        Wallet::query()->create($wallets);
    }

    public function storeLevelIncome(array $incomes)
    {
        LevelIncome::query()->create($incomes);
    }

    public function storeLevelOneCommission($request)
    {
        if ($request->commission_amount[1]) {
            foreach ($this->levelOneMember() as $key => $member) {
                $this->storeWallet([
                    'sender_user_id' => auth()->id(),
                    'receiver_user_id' => $member->id,
                    'amount' => $request->commission_amount[1],
                    'type' => 'income',
                ]);

                $this->storeLevelIncome([
                    'user_id' => $member->id,
                    'date' => today(),
                    'commission' => $request->commission_amount[1],
                    'rank' => $request->rank[1],
                    'notification' => $request->notification[1],
                ]);
            }
        }
    }

    public function storelevelTwoCommission($request)
    {
        if ($request->commission_amount[2]) {
            foreach ($this->levelTwoMember() as $key => $member) {
                $this->storeWallet([
                    'sender_user_id' => auth()->id(),
                    'receiver_user_id' => $member->id,
                    'amount' => $request->commission_amount[2],
                    'type' => 'income',
                ]);

                $this->storeLevelIncome([
                    'user_id' => $member->id,
                    'date' => today(),
                    'commission' => $request->commission_amount[2],
                    'rank' => $request->rank[2],
                    'notification' => $request->notification[2],
                ]);
            }
        }
    }

    public function storelevelThreeCommission($request)
    {
        if ($request->commission_amount[3]) {
            foreach ($this->levelThreeMember() as $key => $member) {
                $this->storeWallet([
                    'sender_user_id' => auth()->id(),
                    'receiver_user_id' => $member->id,
                    'amount' => $request->commission_amount[3],
                    'type' => 'income',
                ]);

                $this->storeLevelIncome([
                    'user_id' => $member->id,
                    'date' => today(),
                    'commission' => $request->commission_amount[3],
                    'rank' => $request->rank[3],
                    'notification' => $request->notification[3],
                ]);
            }
        }
    }

    public function storelevelFourCommission($request)
    {
        if ($request->commission_amount[4]) {
            foreach ($this->levelFourMember() as $key => $member) {
                $this->storeWallet([
                    'sender_user_id' => auth()->id(),
                    'receiver_user_id' => $member->id,
                    'amount' => $request->commission_amount[4],
                    'type' => 'income',
                ]);

                $this->storeLevelIncome([
                    'user_id' => $member->id,
                    'date' => today(),
                    'commission' => $request->commission_amount[4],
                    'rank' => $request->rank[4],
                    'notification' => $request->notification[4],
                ]);
            }
        }
    }

    public function storelevelFiveCommission($request)
    {
        if ($request->commission_amount[5]) {
            foreach ($this->levelFiveMember() as $key => $member) {
                $this->storeWallet([
                    'sender_user_id' => auth()->id(),
                    'receiver_user_id' => $member->id,
                    'amount' => $request->commission_amount[5],
                    'type' => 'income',
                ]);

                $this->storeLevelIncome([
                    'user_id' => $member->id,
                    'date' => today(),
                    'commission' => $request->commission_amount[5],
                    'rank' => $request->rank[5],
                    'notification' => $request->notification[5],
                ]);
            }
        }
    }

    public function storelevelSixCommission($request)
    {
        if ($request->commission_amount[6]) {
            foreach ($this->levelSixMember() as $key => $member) {
                $this->storeWallet([
                    'sender_user_id' => auth()->id(),
                    'receiver_user_id' => $member->id,
                    'amount' => $request->commission_amount[6],
                    'type' => 'income',
                ]);

                $this->storeLevelIncome([
                    'user_id' => $member->id,
                    'date' => today(),
                    'commission' => $request->commission_amount[6],
                    'rank' => $request->rank[6],
                    'notification' => $request->notification[6],
                ]);
            }
        }
    }

    public function storelevelSevenCommission($request)
    {
        if ($request->commission_amount[7]) {
            foreach ($this->levelSevenMember() as $key => $member) {
                $this->storeWallet([
                    'sender_user_id' => auth()->id(),
                    'receiver_user_id' => $member->id,
                    'amount' => $request->commission_amount[7],
                    'type' => 'income',
                ]);

                $this->storeLevelIncome([
                    'user_id' => $member->id,
                    'date' => today(),
                    'commission' => $request->commission_amount[7],
                    'rank' => $request->rank[7],
                    'notification' => $request->notification[7],
                ]);
            }
        }
    }

    public function storelevelEightCommission($request)
    {
        if ($request->commission_amount[8]) {
            foreach ($this->levelEightMember() as $key => $member) {
                $this->storeWallet([
                    'sender_user_id' => auth()->id(),
                    'receiver_user_id' => $member->id,
                    'amount' => $request->commission_amount[8],
                    'type' => 'income',
                ]);

                $this->storeLevelIncome([
                    'user_id' => $member->id,
                    'date' => today(),
                    'commission' => $request->commission_amount[8],
                    'rank' => $request->rank[8],
                    'notification' => $request->notification[8],
                ]);
            }
        }
    }

    public function storelevelNineCommission($request)
    {
        if ($request->commission_amount[9]) {
            foreach ($this->levelNineMember() as $key => $member) {
                $this->storeWallet([
                    'sender_user_id' => auth()->id(),
                    'receiver_user_id' => $member->id,
                    'amount' => $request->commission_amount[9],
                    'type' => 'income',
                ]);

                $this->storeLevelIncome([
                    'user_id' => $member->id,
                    'date' => today(),
                    'commission' => $request->commission_amount[9],
                    'rank' => $request->rank[9],
                    'notification' => $request->notification[9],
                ]);
            }
        }
    }

    public function storelevelTenCommission($request)
    {
        if ($request->commission_amount[10]) {
            foreach ($this->levelTenMember() as $key => $member) {
                $this->storeWallet([
                    'sender_user_id' => auth()->id(),
                    'receiver_user_id' => $member->id,
                    'amount' => $request->commission_amount[10],
                    'type' => 'income',
                ]);

                $this->storeLevelIncome([
                    'user_id' => $member->id,
                    'date' => today(),
                    'commission' => $request->commission_amount[10],
                    'rank' => $request->rank[10],
                    'notification' => $request->notification[10],
                ]);
            }
        }
    }

}
