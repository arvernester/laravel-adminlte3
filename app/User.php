<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'gravatar',
    ];

    public function getGravatarAttribute(): string
    {
        return 'https://www.gravatar.com/avatar/'.md5($this->attributes['email']);
    }

    public function socials(): HasMany
    {
        return $this->hasMany(UserSocial::class);
    }
}
