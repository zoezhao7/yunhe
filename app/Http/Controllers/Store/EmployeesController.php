<?php

namespace App\Http\Controllers\Store;

use App\Models\Store;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
	public function index(Request $request, Store $store)
	{
        $manager = \Auth::guard('store')->user();

	    $query = Employee::query();

	    // 搜索
	    if($keyWord = $request->input('search_key')) {
	        $query->where('name', 'like', '%' . $keyWord . '%');
        }
        $employees = $query->where('store_id', '=', $manager->store_id)->recent()->paginate();

		return view('store.employees.index', compact('employees'));
	}

    public function show(Employee $employee)
    {
        return view('store.employees.show', compact('employee'));
    }

	public function create(Employee $employee)
	{
        $manager = \Auth::guard('store')->user();
        $store_id = $manager->store_id;

        $employees = Employee::select('id', 'name')->whereIn('type', [1, 2])->where('store_id', $manager->store_id)->get()->toArray();

		return view('store.employees.create_and_edit', compact('employee', 'store_id', 'employees'));
	}

	public function store(EmployeeRequest $request)
	{
	    $manager = \Auth::guard('store')->user();

		$data = $request->all();
		if($request->has('password') && $request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $data['store_id'] = $manager->store_id;

        Employee::create($data);

		return redirect()->route('store.employees.index')->with('success', '员工创建成功！');
	}

	public function edit(Employee $employee)
	{
        $manager = \Auth::guard('store')->user();
        $store_id = $manager->store_id;

        $employees = Employee::select('id', 'name')->whereIn('type', [1, 2])->where('store_id', $manager->store_id)->get()->toArray();

		return view('store.employees.create_and_edit', compact('employee', 'store_id', 'employees'));
	}

	public function update(EmployeeRequest $request, Employee $employee)
	{
        $data = $request->all();
        unset($data['store_id']);
        if($request->has('password') && $request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $employee->update($data);

		return redirect()->back()->with('success', '员工编辑成功！');
	}
}