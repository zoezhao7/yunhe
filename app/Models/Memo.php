<?php

namespace App\Models;

class Memo extends Model
{
    protected $fillable = ['employee_id', 'type', 'member_id', 'content', 'handled_at'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function isBelongsToEmployee(Employee $employee)
    {
        return $employee->id === $this->employee_id;
    }
    public function isBelongsToMember(Member $member)
    {
        return $member->id === $this->member_id;
    }

}
