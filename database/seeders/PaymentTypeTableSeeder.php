<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentTypes = [
            [
                'name' => 'Bkash',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nagad',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rocket',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Debit/Credit Card',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'E-Pin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Others',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        PaymentType::query()->insert($paymentTypes);
    }
}
