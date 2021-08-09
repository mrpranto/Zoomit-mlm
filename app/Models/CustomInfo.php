<?php

namespace App\Models;

use App\HelperTrait\BootTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomInfo extends Model
{
    use HasFactory, BootTrait;

    protected $fillable = [
        'type', 'name', 'value'
    ];

    protected $hidden = [
      'customable_type', 'customable_id'
    ];

}
