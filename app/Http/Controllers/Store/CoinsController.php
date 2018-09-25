<?php

namespace App\Http\Controllers\Store;

use App\Models\Member;
use App\Models\Coin;
use Illuminate\Http\Request;
use App\Http\Requests\CoinRequest;
use App\Http\Controllers\Controller;

class CoinsController extends Controller
{
	public function index()
	{
		$coins = Coin::paginate();
		return view('store.coins.index', compact('coins'));
	}

	public function memberCreate(Member $member, Coin $coin)
	{
		return view('store.coins.create_and_edit', compact('member', 'coin'));
	}

	public function memberStore(Member $member, CoinRequest $request)
	{
		$coin = Coin::create($request->all());
		return redirect()->route('store.coins.index')->with('success', '积分操作成功');
	}

}