<?php

namespace App\Http\Controllers\Store;

use App\Models\EmployeeRole;
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

	    $query = Employee::query()->where('store_id', '=', $manager->store_id)->recent();

        if ($employeeName = (string)$request->employee_name) {
            $query->where('name', 'like', "%{$employeeName}%");
        }
        if ($employeyPhone = (integer)$request->employee_phone) {
            $query->where('phone', $employeyPhone);
        }
        if ($employeeType = (integer)$request->employee_type) {
            $query->where('type', $employeeType);
        }
        if ($employeeStatus = (integer)$request->employee_status) {
            $query->where('status', $employeeStatus);
        }

        $employees = $query->paginate();

        $this->fillRoleNames($employees);

		return view('store.employees.index', compact('employees', 'request'));
	}

    /**
     * 填充管理员的角色名称
     * @param $admins
     */
    protected function fillRoleNames($employees)
    {
        $roles = EmployeeRole::all()->toArray();
        foreach($employees as $employee)
        {
            $role_names = [];
            foreach($roles as $role) {
                if(!empty($employee->role_ids) && in_array($role['id'], $employee->role_ids)) {
                    $role_names[] = $role['name'];
                }
            }
            $employee->role_names = implode('，', $role_names);
        }
    }

    public function show(Employee $employee)
    {
        return view('store.employees.show', compact('employee'));
    }

	public function create(Employee $employee)
	{
        $manager = \Auth::guard('store')->user();
        $store_id = $manager->store_id;

        $roles = EmployeeRole::where('store_id', $manager->store_id)->get();

        $employees = Employee::select('id', 'name')
            ->whereIn('type', [1, 2])
            ->where('store_id', $manager->store_id)
            ->get()->toArray();

		return view('store.employees.create_and_edit', compact('employee', 'store_id', 'employees', 'roles'));
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

        $roles = EmployeeRole::where('store_id', $manager->store_id)->get();

        $employees = Employee::select('id', 'name')->whereIn('type', [1, 2])->where('store_id', $manager->store_id)->get()->toArray();

		return view('store.employees.create_and_edit', compact('employee', 'store_id', 'employees', 'roles'));
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