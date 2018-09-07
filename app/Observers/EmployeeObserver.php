<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\Store;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class EmployeeObserver
{
    public function saved(Employee $employee)
    {
        Store::find($employee->store_id)->increment('employee_count');
    }

    public function deleted(Employee $employee)
    {
        Store::find($employee->store_id)->decrement('employee_count');
    }
}