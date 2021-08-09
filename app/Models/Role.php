<?php

namespace App\Models;

use App\HelperTrait\BootTrait;
use App\Models\Backend\Company;
use App\Models\Backend\GroupInfo;
use App\Models\Backend\HRM\HrSetup\Department;
use App\Models\Backend\HRM\HrSetup\Designation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use BootTrait;

    protected $fillable = [
        'name',
        'slug',
        'note',
        'delete_able',
        'created_at',
        'updated_at'
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(GroupInfo::class,'group_info_role');
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class,'company_role');
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'department_role');
    }

    public function designations(): BelongsToMany
    {
        return $this->belongsToMany(Designation::class, 'designation_role');
    }

}
