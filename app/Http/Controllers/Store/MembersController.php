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

        $query = Member::selectRaw('members.*, em1.name as employee_name, em1.type as employee_type, em2.name as superior_name')
            ->leftJoin('employees as em1', 'employee_id', '=', 'em1.id')
            ->leftJoin('employees as em2', 'em1.superior_id', '=', 'em2.id')
            ->where('em1.store_id', '=', $employee->store_id);

        if ($memberName = (string)$request->member_name) {
            $query->where('members.name', 'like', "%{$memberName}%");
        }
        if ($employeeName = (string)$request->employee_name) {
            $query->where('em1.name', 'like', "%{$employeeName}%");
        }
        if($orderBy = (string) $request->order_by){
            $query->orderBy($orderBy, 'desc');
        } else {
            $query->orderBy('members.id', 'desc');
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