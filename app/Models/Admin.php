<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['user_name', 'password', 'mobile', 'email', 'real_name', 'role_ids', ];

    public function getRoleIdsAttribute($value)
    {
        return is_array($value) ? $value : json_decode($value);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }

}
