<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::query()->pluck('id');

        Role::query()->updateOrCreate([
           'name' => 'Admin',
           'slug' => 'admin',
           'note' => 'This role is for Admin User',
           'delete_able' => false,
        ])->permissions()
            ->sync($permissions);

        Role::query()->updateOrCreate([
            'name' => 'Users',
            'slug' => 'user',
            'note' => 'This role is for User',
            'delete_able' => true,
        ]);

    }
}
