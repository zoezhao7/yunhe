<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\OrderRequest;
use App\Transformers\EmployeeTransformer;
use App\Transformers\OrderTransformer;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Order;
use App\Models\Employee;

class OrdersController extends Controller
{
    public function show(Order $order)
    {
        $employee = \Auth::guard('api')->user();
        if ($order->member->employee->id !== $employee->id) {
            return $this->response->errorForbidden('该订单不属于您的客户');
        }
        return $this->response->item($order, new OrderTransformer());
    }

    public function index(Request $request)
    {
        $orders = Order::paginate();

        return $this->response->paginator($orders, new OrderTransformer());
    }

    public function memberIndex(Request $request, Member $member)
    {
        $orders = $member->orders()->paginate();

        return $this->response->paginator($orders, new OrderTransformer());
    }

    public function employeeIndex(Request $request, Employee $employee)
    {
        $orders = $employee->orders()->paginate();

        return $this->response->paginator($orders, new OrderTransformer());
    }

    public function store(OrderRequest $request, Order $order)
    {
        $member = Member::find($request->member_id);
        if (!$member->belongsToAuthorizer()) {
            return $this->response->errorBadRequest('该ID不属于您的客户');
        }

        $order->fill($request->all());
        $order->status = 0;

        $order->save();

        return $this->response->created();
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return $this->response->noContent();
    }


}
