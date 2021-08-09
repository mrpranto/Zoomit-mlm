<?php

namespace App\Models;

use App\HelperTrait\BootTrait;
use App\HelperTrait\FileHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends BaseModel
{
    use HasFactory, BootTrait, FileHandler;

    protected $fillable = [
        'type', 'path'
    ];

    public function getFullUrlAttribute()
    {
        if (in_array(config('filesystems.default'), ['local', 'public'])) {
            return request()->root().$this->path;
        }
        return $this->path;
    }

    protected $appends = ['full_url'];


    protected $hidden = [
        'fileable_type', 'fileable_id'
    ];

}
