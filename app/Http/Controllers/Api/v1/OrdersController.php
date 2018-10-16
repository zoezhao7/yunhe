<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\OrderRequest;
use App\Models\OrderProduct;
use App\Transformers\EmployeeTransformer;
use App\Transformers\OrderTransformer;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Order;
use App\Models\Employee;
use App\Models\Product;

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
        $query = Order::query();

        if ($request->has('key_word') && $request->key_word) {
            $keyWord = (string)$request->key_word;
            $product_ids = Product::where('name', 'like', '%' . $keyWord . '%')->pluck('id')->toArray();

            if (!empty($product_ids)) {
                $query->whereIn('product_id', $product_ids);
            } else {
                $member_ids = Member::where('name', 'like', '%' . $keyWord . '%')->pluck('id')->toArray();
                if (!empty($member_ids)) {
                    $query->whereIn('member_id', $member_ids);
                } else {
                    return $this->response->array(['data' => []]);
                }
            }
        }
        $orders = $query->paginate();

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

        $data = $request->all();
        $order->fill($data);
        $order->status = 0;
        $order->save();

        // 保存订单产品
        if (!is_array($data['products'])) {
            $data['products'] = json_decode($data['products'], true);
        }
        if (is_array($data['products'])) {
            foreach ($data['products'] as $product) {
                $orderProduct = [];
                $orderProduct['order_id'] = $order->id;
                $orderProduct['spec_id'] = $product['spec_id'];
                $orderProduct['color'] = $product['color'];
                $orderProduct['number'] = $product['number'];
                OrderProduct::create($orderProduct);
            }
        }

        return $this->response->created();
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return $this->response->noContent();
    }


}
