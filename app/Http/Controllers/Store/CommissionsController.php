<?php

namespace App\Http\Controllers\Store;

use App\Models\Commission;
use App\Models\EmployeeRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;

class CommissionsController extends Controller
{
    public function index(Request $request)
    {
        $manager = \Auth::guard('store')->user();

        $store = $manager->store;

        $query = Commission::selectRaw('commissions.*, em1.name as employee_name, em2.name as subordinate_name, orders.idnumber as order_idnumber, orders.dealt_at as order_dealt_at')
            ->leftJoin('employees as em1', 'employee_id', '=', 'em1.id')
            ->leftJoin('orders', 'order_id', '=', 'orders.id')
            ->leftJoin('employees as em2', 'subordinate_id', '=', 'em2.id')
            ->where('em1.store_id', $store->id)
            ->orderBy('commissions.employee_id', 'asc')
            ->orderBy('commissions.id', 'desc');

        if ($request->has('month') && $request->month) {
            $query->where('month', $request->month);
        }
        if ($request->has('employee_name') && $request->employee_name) {
            $query->where('em1.name', 'like', '%' . $request->employee_name . '%');
        }
        if ($request->has('commission_type') && $request->commission_type) {
            $query->where('commissions.type', $request->commission_type);
        }

        $commissions = $query->get();

        return view('store.commissions.index', compact('commissions', 'request'));

    }

    /**
     * 生成当月佣金记录
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makeCommissions()
    {
        $manager = \Auth::guard('store')->user();

        $month = date('Y-m');
        $start = $month . '-01';
        $end = date('Y-m-01', (strtotime('+1 month', strtotime($start))));

        $employees = Employee::where('store_id', $manager->store_id)
            ->whereHas('orders', function ($query) use ($start, $end) {
                $query->where('dealt_at', '>=', $start)
                    ->where('dealt_at', '<=', $end);
            })->get();


        foreach ($employees as $employee) {
            Commission::calculate($month, $employee);
        }

        return redirect()->route('store.commissions.index')->with('success', '本月佣金记录成功生成！');
    }
}
