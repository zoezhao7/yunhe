<?php

namespace App\Http\Controllers\Store;

use App\Models\Member;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;

class MembersController extends Controller
{

    public function index(Request $request)
    {
        $employee = \Auth::guard('store')->user();

        $query = Member::withCount('cars')
            ->selectRaw('members.*, employees.name as employee_name, employees.type as employee_type')
            ->leftJoin('employees', 'employee_id', '=', 'employees.id')
            ->recent()
            ->where('employees.store_id', '=', $employee->store_id);

        if ($memberName = (string)$request->member_name) {
            $query->where('members.name', 'like', "%{$memberName}%");
        }
        if ($employeeName = (string)$request->employee_name) {
            $query->where('employees.name', 'like', "%{$employeeName}%");
        }
        if($orderBy = (string) $request->order_by){
            $query->orderBy($orderBy, 'desc');
        }

        $members = $query->paginate();

        return view('store.members.index', compact('members', 'request'));
    }

    public function show(Member $member)
    {
        return view('store.members.show', compact('member'));
    }

    public function create(Member $member)
    {
        $manager = \Auth::guard('store')->user();
        $employees = Employee::select('id', 'name')->where('store_id', $manager->store_id)->where('status', 1)->get()->toArray();

        return view('store.members.create_and_edit', compact('member', 'employees'));
    }

    public function store(MemberRequest $request)
    {
        Member::create($request->all());

        return redirect()->route('store.members.index')->with('success', '客户资料创建成功');
    }

    public function edit(Member $member)
    {
        $this->authorizeForUser(auth('store')->user(), 'storeUpdate', $member);

        $manager = \Auth::guard('store')->user();
        $employees = Employee::select('id', 'name')->where('store_id', $manager->store_id)->where('status', 1)->get()->toArray();

        return view('store.members.create_and_edit', compact('member', 'employees'));
    }

    public function update(MemberRequest $request, Member $member)
    {
        $this->authorizeForUser(auth('store')->user(), 'storeUpdate', $member);

        $member->update($request->all());

        return redirect()->back()->with('success', '客户资料编辑成功');
    }

    public function destroy(Member $member)
    {
        $this->authorizeForUser(auth('store')->user(), 'storeDestroy', $member);

        $member->delete();

        return redirect()->route('store.members.index')->with('success', '客户资料删除成功');
    }
}