<?php


namespace App\HelperTrait;


use App\Models\User;

trait CreatedBy
{
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->fill([
                'created_by' => auth()->id() ?: User::query()->first(['id'])->id,
                'updated_by' => auth()->id() ?: User::query()->first(['id'])->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        static::updating(function ($model) {
            $model->fill([
                'updated_by' => auth()->id() ?: User::query()->first(['id'])->id,
                'updated_at' => now(),
            ]);
        });
    }


}
