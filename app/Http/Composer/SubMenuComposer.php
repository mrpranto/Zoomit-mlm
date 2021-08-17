<?php


namespace App\Http\Composer;


class SubMenuComposer
{
    public function withdraw(): array
    {
        return [
            [
                'name' => 'Withdraw Amount',
                'url' => route('withdraw.create'),
                'permission' => auth()->user()->can('app.withdraw.create')
            ],
            [
                'name' => 'Withdraw History',
                'url' => route('withdraw'),
                'permission' => auth()->user()->can('app.withdraw.index')
            ],
        ];
    }


}
