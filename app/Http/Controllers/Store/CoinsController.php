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
        $query = Coin::query()
            ->has('member')
            ->selectRaw("coins.id, coins.number, coins.type, coins.account_number, coins.remark, coins.created_at, coins.employee_id, members.id as member_id,
             members.name as member_name, members.coin_count as member_coin_count, 
             employees.name as employee_name")
            ->leftJoin('members', 'coins.member_id', '=', 'members.id')
            ->leftJoin('orders', 'coins.order_id', '=', 'orders.id')
            ->leftJoin('employees', 'coins.employee_id', '=', 'employees.id');

        if ($memberName = (string)$request->member_name) {
            $query->where('members.name', 'like', "%{$memberName}%");
        }
        if ($coinType = (integer)$request->coin_type) {
            $query->where('coins.type', $coinType);
        }
        if ($orderBy = (string)$request->order_by) {
            $query->orderBy((string)$request->order_by, 'desc');
        } else {
            $query->recent();
        }

        $coins = $query->paginate();
        
        $page_name = isset($member) && $member->id ? $member->name . '的积分记录' : '积分记录';

        return view('store.coins.index', compact('coins', 'request', 'page_name'));
    }

    public function memberIndex(Request $request, Member $member)
    {
        $coins = $member->coins()->with(['employee', 'order', 'member'])->paginate();

        $page_name = isset($member) && $member->id ? $member->name . '的积分记录' : '积分记录';

        return view('store.coins.index', compact('member', 'coins', 'request', 'page_name'));
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