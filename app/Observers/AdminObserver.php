<?php

namespace App\Observers;

use App\Models\Admin;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class AdminObserver
{
    public function saving(Admin $admin)
    {
        if(is_array($admin->role_ids)) {
            $admin->role_ids = json_encode($admin->role_ids);
        }
    }

    public function deleting(Admin $admin)
    {
        if($admin->id == 1) {
            denied('该用户不允许删除！');
        }
    }
}