<?php

namespace App\Models\Backend;

use App\HelperTrait\BootTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, BootTrait;

    protected $fillable = [
        'name', 'value', 'public'
    ];

}

