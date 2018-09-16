<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/store/welcome';

    public function __construct()
    {
        $this->middleware('guest:store')->except('logout');
    }

    // 展示登录界面
    public function showLoginForm()
    {
        return view('store.auth.login');
    }

    /**
     * 重写登录attemptLogin，添加店长身份(type=1)验证
     * @param Request $request
     * @return mixed
     */
    protected function attemptLogin(Request $request)
    {
        $authData = ['phone' => $request->phone, 'password' => $request->password, 'type' => 1];
        return $this->guard()->attempt($authData, $request->filled('remember'));
    }

    // 定义用户名字段
    public function username()
    {
        return 'phone';
    }

    // 定义守护器
    protected function guard()
    {
        return \Auth::guard('store');
    }

    // 退出登录事件
    protected function loggedOut(Request $request)
    {
        return redirect()->route('store.login');
    }
}
