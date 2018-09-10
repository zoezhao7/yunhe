<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\Store;
use Monolog\Formatter\ElasticaFormatter;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class EmployeeObserver
{
    public function saving(Employee $employee)
    {
        $employee->letter = substr(pinyin_abbr($employee->name), 0, 1);
    }

    public function saved(Employee $employee)
    {
        Store::find($employee->store_id)->increment('employee_count');
    }

    public function deleting(Employee $employee)
    {
        if($employee->hasMember()){
            denied('员工名下有客户，禁止删除！');
        }
    }

    public function deleted(Employee $employee)
    {
        Store::find($employee->store_id)->decrement('employee_count');
    }
}