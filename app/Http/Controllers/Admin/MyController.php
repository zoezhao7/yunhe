<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PasswordEditRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Hashing\HashManager as Hasher;

class MyController extends Controller
{
    public function passwordEdit(Request $request)
    {
        $admin = \Auth::guard('admin')->user();
        return view('admin.my.password_edit', compact('admin'));
    }

    public function passwordUpdate(PasswordEditRequest $request, Hasher $hasher)
    {
        $admin = \Auth::guard('admin')->user();

        if($request->has('old_password') && $request->old_password) {
            if(!$hasher->check($request->old_password, $admin->password)) {
                return redirect()->back()->with('danger', '原密码输入错误！');
            }
            $admin->password = $hasher->make($request->password);
        }
        $admin->save();

        return redirect()->back()->with('success', '密码修改成功！');
    }

}
