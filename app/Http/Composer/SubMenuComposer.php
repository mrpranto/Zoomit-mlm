<?php


namespace App\Http\Composer;


class SubMenuComposer
{
    public function commission(): array
    {
        return [
            [
                'name' => 'Set Commission',
                'url' => route('commission.page'),
                'permission' => auth()->user()->can('app.user.index')
            ],
        ];
    }


}
