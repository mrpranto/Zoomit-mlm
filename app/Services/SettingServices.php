<?php


namespace App\Services;


use App\HelperTrait\FileHandler;
use App\Models\Backend\Setting;
use App\Repository\SettingRepository;

class SettingServices extends BaseServices
{
    use FileHandler;

    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }

    public function indexPropertice(): array
    {
        $data = [

            'date_format' => ['d/m/Y', 'd-m-y', 'Y-m-d', 'd.m.Y', 'Y.m.d', 'F, d Y'],
            'time_format' => ['24' => '24 Hours', '12' => '12 Hours'],
            'general_settings' => resolve(SettingRepository::class)->getFormatSetting()

        ];

        return $data;
    }

    public function validate($request): SettingServices
    {
        $request->validate([
            'setting.*' => 'required'
        ]);

        return $this;
    }

    public function store($request)
    {
        foreach ($request->setting as $key => $setting)
        {
            $get_setting = $this->model::query()->where('name', $key)->first();

            if ($get_setting) {

                if ($key == 'app_logo') {

                    $this->deleteImage($get_setting->value);

                    $get_setting->update([
                        'value' => $this->uploadImage($setting, 'app-setting'),
                    ]);

                }elseif ($key == 'app_icon') {

                    $this->deleteImage($get_setting->value);

                    $get_setting->update([
                        'value' => $this->uploadImage($setting, 'app-setting'),
                    ]);

                }else{

                    $get_setting->update([
                        'value' => $setting,
                    ]);

                }

            }else{

                $this->model::query()->create([
                    'name' => $key,
                    'value' => $key == 'app_logo' || $key == 'app_icon' ? $this->uploadImage($setting, 'app-setting') : $setting,
                    'public' => 1,
                ]);
            }
        }

    }
}
