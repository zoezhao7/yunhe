<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\MemoRequest;
use App\Models\Employee;
use App\Models\Member;
use App\Models\Memo;
use App\Transformers\MemoTransformer;
use Illuminate\Http\Request;

class MemosController extends Controller
{
    public function memberIndex(Member $member)
    {
        $memos = $member->memos()->recent()->paginate();

        return $this->response->paginator($memos, new MemoTransformer());
    }

    public function employeeIndex(Employee $employee)
    {
        return $this->response->collection($employee->memos()->recent()->paginate(), new MemoTransformer());
    }

    public function store(MemoRequest $request, Memo $memo)
    {
        $employee = \Auth::guard('api')->user();

        $memo->fill($request->all());
        $memo->employee_id = $employee->id;
        $memo->save();

        return $this->response->created();
    }

    public function update(MemoRequest $request, Memo $memo)
    {
        $employee = \Auth::guard('api')->user();

        if(!$memo->isBelongsToEmployee($employee)) {
            return $this->response->errorForbidden('这不是您的服务记录！');
        }

        $memo->fill($request->all());
        $memo->employee_id = $employee->id;
        $memo->save();

        return $this->response->noContent();
    }

    public function destroy(Memo $memo)
    {
        $employee = \Auth::guard('api')->user();

        if(!$memo->isBelongsToEmployee($employee)) {
            return $this->response->errorForbidden('这不是您的服务记录！');
        }

        $memo->delete();

        return $this->response->noContent();
    }
}
