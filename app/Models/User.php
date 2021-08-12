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
        'sponsor_user_id',
        'name',
        'user_generated_id',
        'email',
        'phone',
        'password',
        'address',
        'terms_and_condition',
        'status',
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

    public function sponsor()
    {
        return $this->belongsTo(User::class, 'sponsor_user_id', 'id');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'sponsor_user_id', 'id');
    }

    public function walletIncome()
    {
        return $this->hasMany(Wallet::class)->where('type', 'income');
    }

    public function walletWithdraw()
    {
        return $this->hasMany(Wallet::class)->where('type', 'withdraw');
    }

    public function payment()
    {
        return $this->hasMany(Wallet::class)
            ->where('type', 'registration_fee');
    }

}
