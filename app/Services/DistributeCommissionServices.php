<?php

namespace App\Services;

use App\Models\Commission;
use App\Models\User;
use App\Models\Wallet;

class DistributeCommissionServices extends BaseServices
{
    public $user;

    public function __construct(User $user)
    {
        $this->model = $user;
        $this->user = $user;
    }

    public function distributeCommission($user)
    {
        foreach ($this->parentIds($user) as $key => $id) {

            if ($key == 4 && $this->countAffiliator($id)->count() < $this->getCommission()[0]['level_minimum_member']) {

//                $this->setCommission($this->getCommission()[$key], $id);

            } elseif (($key == 5 || $key == 6) && $this->secondLevelAffiliator($id)->count() < $this->getCommission()[1]['level_minimum_member']) {

//                $this->setCommission($this->getCommission()[$key], $id);

            } elseif (($key == 7 || $key == 8 || $key == 9) && $this->thirdLevelAffiliator($id)->count() < $this->getCommission()[2]['level_minimum_member']) {

//                $this->setCommission($this->getCommission()[$key], $id);

            } else {

                $this->setCommission($this->getCommission()[$key], $id);

            }
        }
    }

    public function setCommission(array $commission, $payableUser)
    {
        Wallet::query()->create([
            'user_id' => $payableUser,
            'payment_type_id' => null,
            'amount' => $commission['commission'],
            'type' => 'income',
        ]);
    }

    public function getCommission()
    {
        return Commission::query()->get()->toArray();
    }

    public function parentIds($user)
    {
        $levelUserIds = [];
        $userParent = User::query()->where('id', $user->sponsor_user_id)->first();

        if ($userParent) {

            array_push($levelUserIds, $userParent->id);
            $hisParent = User::query()->where('id', $userParent->sponsor_user_id)->first();

            if ($hisParent) {
                array_push($levelUserIds, $hisParent->id);
                $hisParent2 = User::query()->where('id', $hisParent->sponsor_user_id)->first();

                if ($hisParent2) {
                    array_push($levelUserIds, $hisParent2->id);
                    $hisParent3 = User::query()->where('id', $hisParent2->sponsor_user_id)->first();

                    if ($hisParent3) {
                        array_push($levelUserIds, $hisParent3->id);
                        $hisParent4 = User::query()->where('id', $hisParent3->sponsor_user_id)->first();

                        if ($hisParent4) {

                            array_push($levelUserIds, $hisParent4->id);
                            $hisParent5 = User::query()->where('id', $hisParent4->sponsor_user_id)->first();

                            if ($hisParent5) {
                                array_push($levelUserIds, $hisParent5->id);
                                $hisParent6 = User::query()->where('id', $hisParent5->sponsor_user_id)->first();

                                if ($hisParent6) {
                                    array_push($levelUserIds, $hisParent6->id);
                                    $hisParent7 = User::query()->where('id', $hisParent6->sponsor_user_id)->first();

                                    if ($hisParent7) {

                                        array_push($levelUserIds, $hisParent7->id);
                                        $hisParent8 = User::query()->where('id', $hisParent7->sponsor_user_id)->first();

                                        if ($hisParent8) {

                                            array_push($levelUserIds, $hisParent8->id);
                                            $hisParent9 = User::query()->where('id', $hisParent8->sponsor_user_id)->first();

                                            if ($hisParent9) {

                                                array_push($levelUserIds, $hisParent9->id);
                                                $hisParent10 = User::query()->where('id', $hisParent9->sponsor_user_id)->first();

//                                                if ($hisParent10){
//                                                    array_push($levelUserIds, $hisParent10->id);
//                                                    $hisParent11 = User::query()->where('id', $hisParent10->sponsor_user_id)->first();
//
//                                                    if ($hisParent11){
//                                                        array_push($levelUserIds, $hisParent11->id);
//                                                        $hisParent12 = User::query()->where('id', $hisParent11->sponsor_user_id)->first();
//
//                                                    }
//                                                }
                                            }

                                        }
                                    }
                                }

                            }
                        }
                    }
                }
            }
        }

        return $levelUserIds;
    }


    public function countAffiliator($id)
    {
        return $this->user->newQuery()->where('sponsor_user_id', $id)->get(['id', 'name']);
    }

    public function secondLevelAffiliator($id)
    {
        return $this->user->newQuery()->whereIn('sponsor_user_id', $this->countAffiliator($id)->pluck('id'))->get(['id', 'name']);
    }

    public function thirdLevelAffiliator($id)
    {
        return $this->user->newQuery()->whereIn('sponsor_user_id', $this->secondLevelAffiliator($id)->pluck('id'))->get(['id', 'name']);
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
