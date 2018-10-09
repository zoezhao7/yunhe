<?php

namespace App\Http\Controllers\Store;

use App\Models\Commission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommissionsController extends Controller
{
    public function index(Request $request)
    {
        $manager = \Auth::guard('store')->user();

        $store = $manager->store;

        // dd(Commission::query()->where('employee_id', '>', 0)->get());

        $query = Commission::selectRaw('commissions.*, em1.name as employee_name, em2.name as subordinate_name, orders.idnumber as order_idnumber, orders.dealt_at as order_dealt_at')
            ->leftJoin('employees as em1', 'employee_id', '=', 'em1.id')
            ->leftJoin('orders', 'order_id', '=', 'orders.id')
            ->leftJoin('employees as em2', 'subordinate_id', '=', 'em2.id')
            ->where('em1.store_id', $store->id)
            ->orderBy('commissions.employee_id', 'asc')
            ->orderBy('commissions.id', 'desc');

        if($request->has('month') && $request->month) {
            $query->where('month', $request->month);
        }
        if($request->has('employee_name') && $request->employee_name) {
            $query->where('em1.name', 'like', '%'.$request->employee_name.'%');
        }
        if($request->has('commission_type') && $request->commission_type) {
            $query->where('commissions.type', $request->commission_type);
        }

        $commissions = $query->get();

        return view('store.commissions.index', compact('commissions', 'request'));

    }
}
