<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/9/13
 * Time: 15:13
 */

namespace App\Transformers;

use App\Models\Memo;
use League\Fractal\TransformerAbstract;

class MemoTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['member', 'employee'];

    public function transform(Memo $memo)
    {
        return [
            'id' => $memo->id,
            'type' => $memo->type,
            'employee_id' => $memo->employee_id,
            'member_id' => $memo->member_id,
            'content' => $memo->content,
            'status' => $memo->status,
            'handled_at' => $memo->read_at ? $memo->read_at->toDateTimeString() : null,
            'created_at' => $memo->created_at ? $memo->created_at->toDateTimeString() : null,
        ];
    }

    public function includeMember(Memo $memo)
    {
        return $this->item($memo->member, new MemberTransformer());
    }

    public function includeEmployee(Memo $memo)
    {
        return $this->item($memo->employee, new EmployeeTransformer());
    }


}