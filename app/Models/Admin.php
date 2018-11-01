<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Models\Traits\CheckPermission;

class Admin extends UserModel
{
    use Notifiable;
    use CheckPermission;

    protected $fillable = ['user_name', 'password', 'phone', 'email', 'real_name', 'role_ids',];

    public function isSuperAdmin()
    {
        return in_array(app(Role::class)->superAdminRoleId, $this->role_ids);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }

    public function orderTasks()
    {
        return StockOrder::with('store', 'employee')->where('status', 0)->recent()->get();
    }

}
