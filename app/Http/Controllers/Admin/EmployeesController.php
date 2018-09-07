<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Store $store)
	{
	    if($keyWord = $request->input('search_key')) {
	        $employees = Employee::where('name', 'like', '%' . $keyWord . '%')->recent()->paginate();
        } else {
            $employees = Employee::recent()->paginate();
        }

		$employee_count = Employee::count();
		$stores = Store::all();

		return view('admin.employees.index', compact('employees', 'stores', 'employee_count', 'store'));
	}

	public function storeIndex(Request $request, Store $store)
    {
        if($keyWord = $request->input('search_key')) {
            $employees = Employee::where('store_id', $store->id)
                ->where('name', 'like', '%' . $keyWord . '%')->recent()->paginate();
        } else {
            $employees = $store->employees()->recent()->paginate();
        }

        $employee_count = Employee::count();
        $stores = Store::all();
        return view('admin.employees.index', compact('employees', 'stores', 'employee_count', 'store'));
    }

    public function show(Employee $employee)
    {
        return view('admin.employees.show', compact('employee'));
    }

	public function create(Employee $employee)
	{
	    $stores = Store::all();
		return view('admin.employees.create_and_edit', compact('employee', 'stores'));
	}

	public function store(EmployeeRequest $request)
	{
		$data = $request->all();
		if($request->has('password') && $request->password) {
            $data['password'] = Hash::make($request->password);
        }
        Employee::create($data);

		return redirect()->route('admin.employees.index')->with('success', '员工创建成功！');
	}

	public function edit(Employee $employee)
	{
        // $this->authorize('update', $employee);
        $stores = Store::all();
		return view('admin.employees.create_and_edit', compact('employee', 'stores'));
	}

	public function update(EmployeeRequest $request, Employee $employee)
	{
		// $this->authorize('update', $employee);
        $data = $request->all();
        if($request->has('password') && $request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $employee->update($data);

		return redirect()->back()->with('success', '员工编辑成功！');
	}

	public function destroy(Employee $employee)
	{
		// $this->authorize('destroy', $employee);
		$employee->delete();

		return redirect()->back()->with('success', '员工删除成功！');
	}
}