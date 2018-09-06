<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['user_name', 'password', 'mobile', 'email', 'real_name', 'role_ids',];

    public function isSuperAdmin()
    {
        return in_array(app(Role::class)->superAdminRoleId, $this->role_ids);
    }

    // 获取用户的权限节点清单
    public function getNodes()
    {
        $role = app(Role::class);
        $nodes = [];

        foreach ($this->role_ids as $role_id) {
            $nodes = array_merge($nodes, $role->getRoleNodes($role_id));
        }
        return array_unique($nodes);
    }

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
