<?php

namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkbenchController extends Controller
{
    public function index()
    {
        $employee = \Auth::guard('api')->user();

        $order_count = $employee->orders()->count();
        $member_count = $employee->members()->where('created_at', '>=', Carbon::now()->firstOfMonth())->count();

        return $this->response->array([
            'nofitication_count' => $employee->notification_count,
            'order_count' => $order_count,
            'member_count' => $member_count,
            'commission_sum' => 0,
        ]);
    }
}
