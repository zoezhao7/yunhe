<?php

namespace App\Http\Controllers\Store;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;

class MembersController extends Controller
{

	public function index()
	{
	    $employee = \Auth::guard('store')->user();

		$members = Member::withCount('cars')
            ->selectRaw('members.*, employees.name as employee_name, employees.type as employee_type')
            ->leftJoin('employees', 'employee_id', '=', 'employees.id')
            ->where('employees.store_id', '=', $employee->store_id)
            ->recent()
            ->paginate();

		return view('store.members.index', compact('members'));
	}

    public function show(Member $member)
    {
        return view('admin.members.show', compact('member'));
    }

	public function create(Member $member)
	{
		return view('admin.members.create_and_edit', compact('member'));
	}

	public function store(MemberRequest $request)
	{
		$member = Member::create($request->all());
		return redirect()->route('admin.members.index')->with('message', 'Created successfully.');
	}

	public function edit(Member $member)
	{
        $this->authorize('update', $member);
		return view('admin.members.create_and_edit', compact('member'));
	}

	public function update(MemberRequest $request, Member $member)
	{
		$this->authorize('update', $member);
		$member->update($request->all());

		return redirect()->route('admin.members.indx')->with('message', 'Updated successfully.');
	}

	public function destroy(Member $member)
	{
		$this->authorize('destroy', $member);
		$member->delete();

		return redirect()->route('admin.members.index')->with('message', 'Deleted successfully.');
	}
}