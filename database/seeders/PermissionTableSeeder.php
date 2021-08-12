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
                'module_id' => $this->module('User Management'),
                'name' => 'User Active',
                'slug' => 'app.user.active'
            ],
            [
                'module_id' => $this->module('User Management'),
                'name' => 'User In-active',
                'slug' => 'app.user.in_active'
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


        ];
    }

    private function module($name)
    {
        return Module::query()->updateOrCreate([
            'name' => $name
        ])->id;
    }
}
