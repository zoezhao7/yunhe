<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\Member;
use App\Models\Store;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request)
	{
	    $query = Member::query()
            ->selectRaw('members.id, members.name, members.coin_count, members.phone, members.created_at, employees.name as employee_name, stores.name as store_name')
            ->leftJoin('employees', 'members.employee_id', '=', 'employees.id')
            ->leftJoin('stores', 'employees.store_id', '=', 'stores.id');

        if ($memberName = (string)$request->member_name) {
            $query->where('members.name', 'like', "%{$memberName}%");
        }
        if ($employeeName = (string)$request->employee_name) {
            $query->where('employees.name', 'like', "%{$employeeName}%");
        }
        if ($storeId = (string)$request->store_id) {
            $query->where('stores.id', $storeId);
        }
        if($orderBy = (string) $request->order_by){
            $query->orderBy($orderBy, 'desc');
        } else {
            $query->orderBy('members.id', 'desc');
        }

        $members = $query->paginate();
        $stores = Store::select('id', 'name')->where('is_open', 1)->get();

		return view('admin.members.index', compact('members', 'request', 'stores'));
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
	    // $this->authorize('update', $member);
		return view('admin.members.create_and_edit', compact('member'));
	}

	public function update(MemberRequest $request, Member $member)
	{
		// $this->authorize('update', $member);

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