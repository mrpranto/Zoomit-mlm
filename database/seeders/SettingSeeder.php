<?php

namespace Database\Seeders;

use App\Models\Backend\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
          'app_name' => 'MLM',
          'app_logo' => 'default.png',
          'app_icon' => 'default.png',
          'date_format' => 'Y-m-d',
          'time_format' => '12',
          'currency_symbol' => '৳',
          'pagination' => '15',
        ];

        foreach ($settings as $key => $setting)
        {
            Setting::query()->updateOrCreate([
                'name' => $key,
                'value' => $setting,
                'public' => 1,
            ]);
        }
    }
}
