<?php

namespace Database\Seeders;

use App\Models\Commission;
use Illuminate\Database\Seeder;

class CommissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commission = [

            [
                'level_name' => '1',
                'level_minimum_member' => '4',
                'commission' => 0,
            ],
            [
                'level_name' => '2',
                'level_minimum_member' => '16',
                'commission' => 0,
            ],
            [
                'level_name' => '3',
                'level_minimum_member' => '64',
                'commission' => 0,
            ],
            [
                'level_name' => '4',
                'level_minimum_member' => '256',
                'commission' => 0,
            ],
            [
                'level_name' => '5',
                'level_minimum_member' => '1024',
                'commission' => 0,
            ],
            [
                'level_name' => '6',
                'level_minimum_member' => '4096',
                'commission' => 0,
            ],
            [
                'level_name' => '7',
                'level_minimum_member' => '16384',
                'commission' => 0,
            ],
            [
                'level_name' => '8',
                'level_minimum_member' => '65536',
                'commission' => 0,
            ],
            [
                'level_name' => '9',
                'level_minimum_member' => '262144',
                'commission' => 0,
            ],
            [
                'level_name' => '10',
                'level_minimum_member' => '1048576',
                'commission' => 0,
            ],

        ];

        Commission::query()->insert($commission);
    }
}
