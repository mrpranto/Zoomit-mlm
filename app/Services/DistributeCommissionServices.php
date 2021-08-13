<?php

namespace App\Services;

use App\Models\User;

class DistributeCommissionServices extends BaseServices
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function distributeCommission($user)
    {
        return $this->parentIds($user);
    }

    public function parentIds($user)
    {
        $levelUserIds = [];
        $userParent = User::query()->where('id', $user->sponsor_user_id)->first();

        if ($userParent) {

            array_push($levelUserIds, $userParent->id);
            $hisParent = User::query()->where('id', $userParent->sponsor_user_id)->first();

            if ($hisParent){
                array_push($levelUserIds, $hisParent->id);
                $hisParent2 = User::query()->where('id', $hisParent->sponsor_user_id)->first();

                if ($hisParent2){
                    array_push($levelUserIds, $hisParent2->id);
                    $hisParent3 = User::query()->where('id', $hisParent2->sponsor_user_id)->first();

                    if ($hisParent3){
                        array_push($levelUserIds, $hisParent3->id);
                        $hisParent4 = User::query()->where('id', $hisParent3->sponsor_user_id)->first();

                        if ($hisParent4){

                            array_push($levelUserIds, $hisParent4->id);
                            $hisParent5 = User::query()->where('id', $hisParent4->sponsor_user_id)->first();

                            if ($hisParent5){
                                array_push($levelUserIds, $hisParent5->id);
                                $hisParent6 = User::query()->where('id', $hisParent5->sponsor_user_id)->first();

                                if ($hisParent6){
                                    array_push($levelUserIds, $hisParent6->id);
                                    $hisParent7 = User::query()->where('id', $hisParent6->sponsor_user_id)->first();

                                    if ($hisParent7){

                                        array_push($levelUserIds, $hisParent7->id);
                                        $hisParent8 = User::query()->where('id', $hisParent7->sponsor_user_id)->first();

                                        if ($hisParent8){

                                            array_push($levelUserIds, $hisParent8->id);
                                            $hisParent9 = User::query()->where('id', $hisParent8->sponsor_user_id)->first();

                                            if ($hisParent9){

                                                array_push($levelUserIds, $hisParent9->id);
                                                $hisParent10 = User::query()->where('id', $hisParent9->sponsor_user_id)->first();
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

        return array_reverse($levelUserIds);
    }
}
