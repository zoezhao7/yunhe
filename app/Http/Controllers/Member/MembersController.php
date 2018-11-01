<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\MemberRequest;
use App\Models\Employee;
use App\Models\WeixinUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;

class MembersController extends Controller
{
    public function center()
    {
        $member = \Auth::guard('member')->user();

        $order = $member->orders()->with('orderProducts.spec.product.category')->recent()->where('status', 1)->first();

        return view('member.members.center', compact('member', 'order'));
    }

    public function editEmployee(Request $request)
    {
        $member = \Auth::guard('member')->user();

        if($member->employee_id) {
            return redirect()->route('member.center');
        }

        return view('member.members.edit_employee', compact('member'));
    }

    public function updateEmployee(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|regex:/^1[0-9]{10}$/',
        ]);

        $member = \Auth::guard('member')->user();

        $employee = Employee::where('phone', $request->phone)->first();

        if(!$employee) {
            return response(['status' => 'error', 'message' => '没有找到手机号码，请向销售顾问查正']);
        }

        $member->employee_id = $employee->id;
        $member->save();
        return response(['status' => 'success']);

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

        // 手机号已经存在， 绑定微信用户；不存在，用微信用户信息和手机号创建新客户信息。
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
