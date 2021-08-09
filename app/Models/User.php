<?php

namespace App\Models;

use App\Filters\FilterBuilder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function scopeFilters($query, FilterBuilder $filter): Builder
    {
        return $filter->apply($query);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'employee_id',
        'phone',
        'date_of_birth',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->count() ? true : false;
    }

    public function rolePermissions()
    {
        return $this->role->permissions();
    }

    public function roleGroupPermissions()
    {
        return $this->role->groups()->select('name', 'id');
    }

    public function roleCompanyPermissions()
    {
        return $this->role->companies()->select('name', 'id');
    }

    public function roleDepartmentPermissions()
    {
        return $this->role->departments()->select('name', 'id');
    }

    public function roleDesignationPermissions()
    {
        return $this->role->designations()->select('name', 'id');
    }

    public function profilePicture(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->where('type', 'profile_picture');
    }

    public function socialLinks(): MorphMany
    {
        return $this->morphMany(CustomInfo::class, 'customable')
            ->where('type', 'social_links');
    }
}
