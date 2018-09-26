<?php

namespace App\Http\Controllers\Store;

use App\Models\Member;
use App\Models\Coin;
use Illuminate\Http\Request;
use App\Http\Requests\CoinRequest;
use App\Http\Controllers\Controller;

class CoinsController extends Controller
{
	public function index(Request $request)
	{
        $query = Coin::query()->has('member');

        if($keyWord = $request->input('search_key')) {
            $member_ids = Member::where('name', 'like', "%{$keyWord}%")->pluck('id');
            if(!empty($member_ids)) {
                $query->whereIn('member_id', $member_ids);
            }else{
                $coins = [];
                return view('store.coins.index', compact('coins'));
            }
        }

		$coins = $query->with(['employee', 'order', 'member'])->paginate();
		return view('store.coins.index', compact('coins'));
	}

    public function memberIndex(Member $member)
    {
        $coins = $member->coins()->with(['employee', 'order', 'member'])->paginate();
        return view('store.coins.index', compact('member', 'coins'));
    }

	public function memberCreate(Member $member, Coin $coin)
	{
		return view('store.coins.create_and_edit', compact('member', 'coin'));
	}

	public function memberStore(Member $member, CoinRequest $request)
	{
	    $data = $request->all();
	    $data['member_id'] = $member->id;
	    $data['type'] = 2; // 人工操作
        $data['account_number'] = $member->coin_count + ceil($data['number']);
        $data['employee_id'] = \Auth::guard('store')->user()->id;
		$coin = Coin::create($data);

		$member->coin_count = $member->coin_count + ceil($data['number']);
		$member->save();

		return redirect()->back()->with('success', '积分操作成功');
	}

}