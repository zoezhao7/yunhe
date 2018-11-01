<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\EmployeeNode;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeeNodePolicy extends Policy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return \Auth::guard('store')->user()->isSuperAdmin();
    }

    public function update()
    {
        return false;
    }

    public function destroy()
    {
        return false;
    }
}
