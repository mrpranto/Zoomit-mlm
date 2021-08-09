<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->permissions() as $key => $permission)
        {
            Permission::query()->updateOrCreate($permission);
        }

    }


    private function permissions(): array
    {
        return [
            [
                'module_id' => $this->module('Admin Dashboard'),
                'name' => 'Access Dashboard',
                'slug' => 'app.dashboard'
            ],
            [
                'module_id' => $this->module('Role Management'),
                'name' => 'Access Role',
                'slug' => 'app.role.index'
            ],
            [
                'module_id' => $this->module('Role Management'),
                'name' => 'Role Create',
                'slug' => 'app.role.create'
            ],
            [
                'module_id' => $this->module('Role Management'),
                'name' => 'Role Edit',
                'slug' => 'app.role.edit'
            ],
            [
                'module_id' => $this->module('Role Management'),
                'name' => 'Role Delete',
                'slug' => 'app.role.delete'
            ],



            [
                'module_id' => $this->module('User Management'),
                'name' => 'Access User',
                'slug' => 'app.user.index'
            ],
            [
                'module_id' => $this->module('User Management'),
                'name' => 'User Create',
                'slug' => 'app.user.create'
            ],
            [
                'module_id' => $this->module('User Management'),
                'name' => 'User Edit',
                'slug' => 'app.user.edit'
            ],
            [
                'module_id' => $this->module('User Management'),
                'name' => 'User Delete',
                'slug' => 'app.user.delete'
            ],



            [
                'module_id' => $this->module('Setting'),
                'name' => 'Access Setting',
                'slug' => 'app.setting.index'
            ],
            [
                'module_id' => $this->module('Setting'),
                'name' => 'Setting Create',
                'slug' => 'app.setting.create'
            ],



            [
                'module_id' => $this->module('Profile'),
                'name' => 'Profile Update',
                'slug' => 'app.profile.Update'
            ],
            [
                'module_id' => $this->module('Profile'),
                'name' => 'Change Password',
                'slug' => 'app.change.password'
            ],
            [
                'module_id' => $this->module('Profile'),
                'name' => 'Social Link Update',
                'slug' => 'app.social.link'
            ],



            [
                'module_id' => $this->module('Category'),
                'name' => 'Access Category',
                'slug' => 'app.category.index'
            ],
            [
                'module_id' => $this->module('Category'),
                'name' => 'Category Create',
                'slug' => 'app.category.create'
            ],
            [
                'module_id' => $this->module('Category'),
                'name' => 'Category Edit',
                'slug' => 'app.category.edit'
            ],
            [
                'module_id' => $this->module('Category'),
                'name' => 'Category Delete',
                'slug' => 'app.category.delete'
            ],
            [
                'module_id' => $this->module('Category'),
                'name' => 'Category Export',
                'slug' => 'app.category.export'
            ],

            [
                'module_id' => $this->module('Product'),
                'name' => 'Access Product',
                'slug' => 'app.product.index'
            ],
            [
                'module_id' => $this->module('Product'),
                'name' => 'Product Create',
                'slug' => 'app.product.create'
            ],
            [
                'module_id' => $this->module('Product'),
                'name' => 'Product Edit',
                'slug' => 'app.product.edit'
            ],
            [
                'module_id' => $this->module('Product'),
                'name' => 'Product Delete',
                'slug' => 'app.product.delete'
            ],
            [
                'module_id' => $this->module('Product'),
                'name' => 'Product Upload',
                'slug' => 'app.product.upload'
            ],
            [
                'module_id' => $this->module('Product'),
                'name' => 'Product Export',
                'slug' => 'app.product.export'
            ],


            [
                'module_id' => $this->module('Company'),
                'name' => 'Access Company',
                'slug' => 'app.company.index'
            ],
            [
                'module_id' => $this->module('Company'),
                'name' => 'Company Create',
                'slug' => 'app.company.create'
            ],
            [
                'module_id' => $this->module('Company'),
                'name' => 'Company Edit',
                'slug' => 'app.company.edit'
            ],
            [
                'module_id' => $this->module('Company'),
                'name' => 'Company Delete',
                'slug' => 'app.company.delete'
            ],


            [
                'module_id' => $this->module('Customer'),
                'name' => 'Access Customer',
                'slug' => 'app.customer.index'
            ],
            [
                'module_id' => $this->module('Customer'),
                'name' => 'Customer Create',
                'slug' => 'app.customer.create'
            ],
            [
                'module_id' => $this->module('Customer'),
                'name' => 'Customer Edit',
                'slug' => 'app.customer.edit'
            ],
            [
                'module_id' => $this->module('Customer'),
                'name' => 'Customer Delete',
                'slug' => 'app.customer.delete'
            ],


            [
                'module_id' => $this->module('Quotation Type'),
                'name' => 'Access Quotation Type',
                'slug' => 'app.quotation_type.index'
            ],
            [
                'module_id' => $this->module('Quotation Type'),
                'name' => 'Quotation Type Create',
                'slug' => 'app.quotation_type.create'
            ],
            [
                'module_id' => $this->module('Quotation Type'),
                'name' => 'Quotation Type Edit',
                'slug' => 'app.quotation_type.edit'
            ],
            [
                'module_id' => $this->module('Quotation Type'),
                'name' => 'Quotation Type Delete',
                'slug' => 'app.quotation_type.delete'
            ],


            [
                'module_id' => $this->module('Quotation'),
                'name' => 'Access Quotation',
                'slug' => 'app.quotation.index'
            ],
            [
                'module_id' => $this->module('Quotation'),
                'name' => 'Quotation Create',
                'slug' => 'app.quotation.create'
            ],
            [
                'module_id' => $this->module('Quotation'),
                'name' => 'Quotation Edit',
                'slug' => 'app.quotation.edit'
            ],
            [
                'module_id' => $this->module('Quotation'),
                'name' => 'Quotation Delete',
                'slug' => 'app.quotation.delete'
            ],
            [
                'module_id' => $this->module('Quotation'),
                'name' => 'Po Confirm',
                'slug' => 'app.quotation.po-confirm'
            ],
            [
                'module_id' => $this->module('Quotation'),
                'name' => 'Cancel Po Confirm',
                'slug' => 'app.quotation.cancel-po-confirm'
            ],


            [
                'module_id' => $this->module('P/O'),
                'name' => 'Access P/O',
                'slug' => 'app.po.index'
            ],
            [
                'module_id' => $this->module('P/O'),
                'name' => 'P/O Cancel',
                'slug' => 'app.po.cancel'
            ],


        ];
    }

    private function module($name)
    {
        return Module::query()->updateOrCreate([
            'name' => $name
        ])->id;
    }
}
