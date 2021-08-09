<?php


namespace App\Http\Composer;


class SubMenuComposer
{
    public function products(): array
    {
        return [
            [
                'name' => __t('categories'),
                'url' => route('category.index'),
                'permission' => auth()->user()->can('app.category.index')
            ],
            [
                'name' => __t('products'),
                'url' => route('product.index'),
                'permission' => auth()->user()->can('app.product.index')
            ]
        ];
    }

    public function customers(): array
    {
        return [
            [
                'name' => __t('companies'),
                'url' => route('company.index'),
                'permission' => auth()->user()->can('app.company.index')
            ],
            [
                'name' => __t('customers'),
                'url' => route('customer.index'),
                'permission' => auth()->user()->can('app.customer.index')
            ]
        ];
    }

    public function quotations(): array
    {
        return [
            [
                'name' => __t('quotation_type'),
                'url' => route('quotation-type.index'),
                'permission' => auth()->user()->can('app.quotation_type.index')
            ],
            [
                'name' => __t('add_quotation'),
                'url' => route('quotation.create'),
                'permission' => auth()->user()->can('app.quotation.create')
            ],
            [
                'name' => __t('quotations'),
                'url' => route('quotation.index'),
                'permission' => auth()->user()->can('app.quotation.index')
            ],
            [
                'name' => __t('p/o'),
                'url' => route('po.list'),
                'permission' => auth()->user()->can('app.po.index')
            ],
            [
                'name' => __t('delivery_chalan'),
                'url' => url('delivery_chalan'),
                'permission' => auth()->user()->can('app.customer.index')
            ],
            [
                'name' => __t('invoice'),
                'url' => url('invoice'),
                'permission' => auth()->user()->can('app.customer.index')
            ],
        ];
    }

    public function inventory(): array
    {
        return [
            [
                'name' => __t('inventory'),
                'url' => url('inventory'),
                'permission' => auth()->user()->can('app.company.index')
            ],
            [
                'name' => __t('stock'),
                'url' => url('stock'),
                'permission' => auth()->user()->can('app.customer.index')
            ]
        ];
    }

}
