<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\MemberRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoinsController extends Controller
{
    public function index(Request $request)
    {
        $member = \Auth::guard('member')->user();

        $coins = $member->coins()->recent()->get();

        return view('member.coins.index', compact('member', 'coins'));
    }
}
