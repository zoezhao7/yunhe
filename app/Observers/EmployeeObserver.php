<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\Store;
use Monolog\Formatter\ElasticaFormatter;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

/**
 * 逻辑：
 * 离职和删除处理：名下有客户的员工不允许离职处置，不允许删除。
 * 员工保存时：更新拼音首字母；提交了上级ID，则员工身份强制变更为渠道。
 * 员工保存后：更新所属门店的员工人数。
 * 员工删除后：更新所属门店的员工人数。
 */


class EmployeeObserver
{
    public function saving(Employee $employee)
    {
        $employee->letter = strtoupper(substr(pinyin_abbr($employee->name), 0, 1));
        if ($employee->superior_id > 0) {
            $employee->type = 3;
        }

        // 名下有客户的员工禁止调整为离职状态
        if ($employee->isDirty('status') && $employee->status == 2) {
            if($employee->hasMember()) {
                denied('该员工名下有客户，请先将客户转移，再将员工离职处置！');
            }
        }
    }

    public function saved(Employee $employee)
    {
        Store::find($employee->store_id)->increment('employee_count');
    }

    public function deleting(Employee $employee)
    {
        if ($employee->hasMember()) {
            denied('该员工名下有客户，禁止删除！');
        }
    }

    public function deleted(Employee $employee)
    {
        Store::find($employee->store_id)->decrement('employee_count');
    }
}