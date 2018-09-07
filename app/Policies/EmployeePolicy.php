<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employee;

class EmployeePolicy extends Policy
{
    public function update(User $user, Employee $employee)
    {
        // return $employee->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Employee $employee)
    {
        return true;
    }
}
