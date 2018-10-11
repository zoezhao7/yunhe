<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Http\Requests\AccountRequest;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request)
	{
	    $manager = \Auth::guard('store')->user();
	    $query = Account::query()->with('employee')->where('store_id', $manager->store_id)->recent();

	    if($request->has('stime') && $request->stime) {
	        $query->where('operated_at', '>=', $request->stime);
        }
        if($request->has('etime') && $request->stime) {
            $query->where('operated_at', '<=', $request->etime);
        }

		$accounts = $query->paginate();
		return view('store.accounts.index', compact('accounts', 'request'));
	}

	public function create(Account $account)
	{
		return view('store.accounts.create_and_edit', compact('account'));
	}

	public function store(AccountRequest $request)
	{
        $manager = \Auth::guard('store')->user();

	    $data = $request->all();
	    $data['store_id'] = $manager->store_id;
	    $data['employee_id'] = $manager->id;

		Account::create($data);
		return redirect()->route('store.accounts.index')->with('success', '账务记录添加成功！');
	}

	public function destroy(Account $account)
	{
		$account->delete();

		return redirect()->route('store.accounts.index')->with('success', '账务记录删除成功！');
	}
}