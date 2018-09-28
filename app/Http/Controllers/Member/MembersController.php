<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\MemberRequest;
use App\Models\WeixinUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;

class MembersController extends Controller
{
    public function center()
    {
        return view('member.members.center');
    }

    public function editEmployee(Request $request)
    {

    }

    public function updateEmployee(Request $request)
    {

    }
    
    public function create(Request $request, WeixinUser $weixinUser)
    {
        return view('member.members.create', compact('weixinUser'));
    }

    public function store(MemberRequest $request, WeixinUser $weixinUser)
    {
        $phone = $request->phone;
        $code = $request->code;
        $verificationKey = 'verificationCode_' . $phone;

        // 验证码失效
        if (!session()->has($verificationKey)) {
            return response(['status' => 'error', 'message' => '验证码已失效，请重新发送']);
        }

        // 验证码错误
        $verifyData = session($verificationKey);
        if (!hash_equals((string)$verifyData, (string)$code)) {
            return response(['status' => 'error', 'message' => '验证码错误']);
        }

        $member = Member::where('phone', $phone)->first();

        if ($member) {
            $member->avatar = $weixinUser->headimgurl;
            $member->weixin_openid = $weixinUser->openid;
            $member->weixin_unionid = $weixinUser->unionid;
            $member->save();
        } else {
            $member = Member::create(
                [
                    'phone' => $phone,
                    'name' => $weixinUser->nickname,
                    'avatar' => $weixinUser->headimgurl,
                    'weixin_openid' => $weixinUser->openid,
                    'weixin_unionid' => $weixinUser->unionid,
                    'employee_id' => 0,
                ]
            );
        }

        \Auth::guard('member')->login($member);
        return response(['status' => 'success', 'data' => ['member' => $member->toArray()]]);
        session()->forget($verificationKey);
    }
}
