<?php

namespace App\Transformers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Product;
use App\Models\Spec;
use League\Fractal\TransformerAbstract;

class EmployeeTransformer extends TransformerAbstract
{
    protected  $availableIncludes = ['members', 'store'];

    public function transform(Employee $employee)
    {
        return [
            'id' => $employee->id,
            'name' => $employee->name,
            'phone' => $employee->phone,
            'intro' => $employee->intro,
            'status' => $employee->status == 1 ? '在职' : '失效',
            'idnumber' => $employee->idnumber,
            'order_count' => $employee->orders()->count(),
            'nofitication_count' => $employee->notification_count,
        ];
    }

    public function includeMembers(Employee $employee)
    {
        return $this->collection($employee->members(), new MemberTransformer());
    }

    public function includeStore(Employee $employee)
    {
        return $this->item($employee->store, new StoreTransformer());
    }

}