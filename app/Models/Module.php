<?php

namespace App\Models;

use App\HelperTrait\BootTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory, BootTrait;

    protected $fillable = [
      'name', 'created_at', 'updated_at'
    ];

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }
}
