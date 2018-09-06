<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\Admin;

class RolePolicy extends Policy
{
    public function edit(Admin $admin, Role $role)
    {
        // return $store->user_id == $user->id;
        return $role->isNotSuperAdmin();

    }

    public function update(Admin $admin, Role $role)
    {
        // return $store->user_id == $user->id;
        return $role->isNotSuperAdmin();

    }

    public function destroy(Admin $admin, Role $role)
    {
        return $role->isNotSuperAdmin();
    }
}
