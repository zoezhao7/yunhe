<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/welcome';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
            'code' => 'required',
        ]);

        $verificationKey = 'verificationCode_' . $request->phone;
        // 验证码失效
        if (!session()->has($verificationKey)) {
            return response(['success' => false, 'message' => '验证码已失效，请重新发送']);
        }
        // 验证码错误
        if (!hash_equals((string)session($verificationKey), (string)$request->code)) {
            return response(['success' => false, 'message' => '验证码错误']);
        }

        // 登录验证
        if (\Auth::attempt(['phone' => $request->phone, 'password' => $request->password], true)) {
            return response(['success' => true, 'message' => '登录成功']);
        }

        return response(['success' => false, 'message' => '用户名或密码错误']);

    }

    // 用户名字段
    public function username()
    {
        return 'phone';
    }

    // 退出登录事件
    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }
}
