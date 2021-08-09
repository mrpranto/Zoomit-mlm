<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->updateOrCreate([
            'role_id' => Role::query()->where('slug', 'admin')->first()->id,
            'name' => 'Mr.Admin',
            'email' => 'admin@gmail.com',
            'employee_id' => '2100001',
            'phone' => '01710750665',
            'date_of_birth' => '1996-11-09',
            'email_verified_at' => now(),
            'password' => bcrypt('11223344'),
            'remember_token' => Str::random(10),
        ]);

        User::query()->updateOrCreate([
            'role_id' => Role::query()->where('slug', 'user')->first()->id,
            'name' => 'Mr.User',
            'email' => 'user@gmail.com',
            'employee_id' => '2100002',
            'phone' => '01928550545',
            'date_of_birth' => '1996-11-09',
            'email_verified_at' => now(),
            'password' => bcrypt('11223344'),
            'remember_token' => Str::random(10),
        ]);
    }
}
