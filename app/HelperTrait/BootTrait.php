<?php


namespace App\HelperTrait;


trait BootTrait
{

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->fill([
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        static::updating(function ($model) {
            $model->fill([
                'updated_at' => now(),
            ]);
        });
    }


}
