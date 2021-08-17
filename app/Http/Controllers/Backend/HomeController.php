<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        Gate::authorize('app.dashboard');

        return view('backend.home', $this->counts(), $this->levelMember());
    }

    private function counts(): array
    {
        $balance = 0;
        $totalUserIncome = Wallet::query()->where('user_id', auth()->id())->where('type', 'income')->sum('amount');
        $totalUserWithdraw = Wallet::query()->where('user_id', auth()->id())->where('type', 'withdraw')->sum('amount');
        $balance = $totalUserIncome - $totalUserWithdraw;
        $usersCount = auth()->id() == User::query()->first()->id
            ? User::query()->count()
            : User::query()->where('sponsor_user_id', auth()->id())->count();

        return [
            'users' => $usersCount,
            'balance' => $balance,
            'total_income' => $totalUserIncome,
            'total_withdraw' => $totalUserWithdraw,
            'fund_transfer' => 0,
            'e_pin' => 0,
            'today_joining' => 0,
            'service' => 0,
        ];
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

}
