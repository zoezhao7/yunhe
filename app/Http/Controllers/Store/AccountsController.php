<?php

namespace App\Http\Controllers\Store;

use App\Models\Account;
use App\Http\Requests\AccountRequest;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
	    $manager = \Auth::guard('store')->user();
		$accounts = Account::with('employee')->where('store_id', $manager->store_id)->paginate();
		return view('store.accounts.index', compact('accounts'));
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