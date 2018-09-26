<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Member;

class MemberPolicy extends Policy
{
    public function before($admin, $ability)
    {
        if($admin->isSuperAdmin()) {
            return true;
        }
    }

    public function storeUpdate(Employee $employee, Member $member)
    {
        return $employee->type === 1 && $employee->store_id === $member->employee->store_id;
    }

    public function storeDestroy(Employee $employee, Member $member)
    {
        return $employee->type === 1 && $employee->store_id === $member->employee->store_id;
    }

    public function apiUpdate(Employee $employee, Member $member)
    {
        return $employee->id === $member->employee_id;
    }

    public function apiDestroy(Employee $employee, Member $member)
    {
        return $employee->id === $member->employee_id;
    }

}
