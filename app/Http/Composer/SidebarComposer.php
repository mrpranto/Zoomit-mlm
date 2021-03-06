<?php


namespace App\Http\Composer;


use Illuminate\View\View;

class SidebarComposer
{
    protected $subMenu;

    public function __construct(SubMenuComposer $subMenuComposer)
    {
        $this->subMenu = $subMenuComposer;
    }

    public function compose(View $view)
    {
        $view->with([

            'sidebar' => [
                [
                    'name' => __t('dashboard'),
                    'icon' => 'fe-airplay',
                    'url' => url('home'),
                    'permission' => auth()->user()->can('app.dashboard')
                ],
                [
                    'name' => 'Members',
                    'icon' => 'fe-user-check',
                    'url' => route('users.index'),
                    'permission' => auth()->user()->can('app.user.index')
                ],
                [
                    'name' => 'Income History',
                    'icon' => 'fe-download',
                    'url' => route('incomes'),
                    'permission' => auth()->user()->can('app.income.index')
                ],
                [
                    'name' => 'Withdraw',
                    'icon' => 'fe-upload',
                    'id' => 'withdraw_sub_menu',
                    'permission' => auth()->user()->canany(['app.withdraw.index', 'app.withdraw.create']),
                    'subMenu' => $this->subMenu->withdraw()
                ],
                [
                    'name' => 'Set Commission',
                    'icon' => 'fe-percent',
                    'url' => route('set.commission'),
                    'permission' => auth()->user()->can('app.commission.index')
                ],
                [
                    'name' => __t('roles'),
                    'icon' => 'fe-aperture',
                    'url' => route('roles.index'),
                    'permission' => auth()->user()->can('app.role.index')
                ],
                [
                    'name' => __t('setting'),
                    'icon' => 'fe-settings',
                    'url' => route('setting.index'),
                    'permission' => auth()->user()->can('app.setting.index'),
                    'parameters' => [
                        'tabs' => 'general'
                    ]
                ],

            ]

        ]);
    }

    public function hasQuotationPermission(): array
    {
        return [
            'app.quotation_type.index',
            'app.quotation.index',
            'app.po.index'
        ];
    }

}
