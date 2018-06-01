<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSocial extends Model
{
    protected $fillable = [
        'user_id',
        'driver_name',
        'driver_id',
        'name',
        'email',
        'photo',
    ];

    public function setDriverIdAttribute($driverId): void
    {
        $this->attributes['driver_id'] = sha1($driverId);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
