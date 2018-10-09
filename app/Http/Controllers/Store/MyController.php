<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests\PasswordEditRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Hashing\HashManager as Hasher;

class MyController extends Controller
{
    public function passwordEdit(Request $request)
    {
        $manager = \Auth::guard('store')->user();
        return view('store.my.password_edit', compact('manager'));
    }

    public function passwordUpdate(PasswordEditRequest $request, Hasher $hasher)
    {
        $manager = \Auth::guard('store')->user();

        if($request->has('password') && $request->password) {
            if(!$hasher->check($request->password, $manager->password)) {
                return redirect()->back()->with('danger', '原密码输入错误！');
            }
            $manager->password = $hasher->make($request->password);
        }
        $manager->save();

        return redirect()->back()->with('success', '密码修改成功！');
    }

    public function storeEdit()
    {
        $manager = \Auth::guard('store')->user();
        $store = $manager->store;
        return view('store.my.store_edit', compact('store', 'manager'));
    }

    public function storeUpdate(StoreRequest $request, Store $store)
    {

    }
}
