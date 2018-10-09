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

    // 用户名字段
    public function username()
    {
        return 'user_name';
    }

    // 退出登录事件
    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }
}
