<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\ResetPasswordRequest;
use App\Models\Employee;
use App\Transformers\EmployeeTransformer;
use App\Transformers\OrderTransformer;
use Illuminate\Http\Request;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class EmployeesController extends Controller
{
    // 下线列表
    public function subordinatesIndex()
    {
        $employee = \Auth::guard('api')->user();

        $subordinates = $employee->subordinates()->paginate();

        return $this->response->paginator($subordinates, new EmployeeTransformer());
    }

    // 下线详情， 同员工详情接口
    public function subordinatesShow(Employee $employee)
    {
        $order_count = $employee->orders()->count();
        $order_summoney = $employee->orders()->sum('money');
        return $this->response->item($employee, new EmployeeTransformer())
            ->addMeta('order_count', $order_count)
            ->addMeta('order_summoney', $order_summoney);
    }

    // 个人中心
    public function center()
    {
        $user = \Auth::guard('api')->user();

        return $this->response->item($user, new EmployeeTransformer());
    }

    // 修改密码
    public function resetPassword(ResetPasswordRequest $request, HasherContract $hasher)
    {
        $employee = \Auth::guard('api')->user();

        if( ! $hasher->check($request->password, $employee->getAuthPassword()) ) {
            return $this->response->errorForbidden('原密码错误，请检查');
        }

        $employee->update(['password'=> $hasher->make($request->new_password)]);

        return $this->response->noContent();
    }

    // 更新个人介绍
    public function updateIntro(Request $request)
    {
        $employee = \Auth::guard('api')->user();

        $employee->intro = $request->intro;

        $employee->save();

        return $this->response->item($employee, new EmployeeTransformer());
    }

}
