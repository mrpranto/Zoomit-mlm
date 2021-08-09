<?php


namespace App\Repository;


use App\Models\Backend\Setting;

class SettingRepository extends BaseRepository
{
    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }

    public function getFormatSetting()
    {
        $setting = $this->model::query()->get(['id', 'name', 'value']);

        $general_setting = $setting->reduce(function ($final, $setting){
            $final[$setting->name] = $setting->value;
            return $final;
        }, []);

        return $general_setting;
    }

    public function findSettingWithName(string $name, $column = null)
    {
         $setting = $this->model::query()->where('name', $name)
            ->first(['id', 'name', 'value']);

         if ($column) {
             return $setting->$column;
         }

         return $setting;
    }

}
