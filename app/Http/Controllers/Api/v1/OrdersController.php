<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Order;
use App\Http\Resources\OrderResource;

class OrdersController extends Controller
{
    public function memberIndex(Request $request, Member $member)
    {
        $orders = $member->orders()->paginate();
        return $this->response->paginator($orders);
        //return OrderResource::collection($orders);
    }
}
