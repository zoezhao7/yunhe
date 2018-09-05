<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class adminsController extends Controller
{
    public function index(Request $request, Admin $admin)
    {
        $admins = $admin->recent()->paginate(20);

        $this->fillRoleNames($admins);

        return view('admin.admins.index', compact('request', 'admins'));
    }

    /**
     * 填充管理员的角色名称
     * @param $admins
     */
    protected function fillRoleNames($admins)
    {
        $roles = Role::all()->toArray();
        foreach($admins as $admin)
        {
            $role_names = [];
            foreach($roles as $role) {
                if(in_array($role['id'], $admin->role_ids)) {
                    $role_names[] = $role['name'];
                }
            }
            $admin->role_names = implode('，', $role_names);
        }
    }

    public function create(Admin $admin)
    {
        $roles = Role::all();
        return view('admin.admins.create_and_edit', compact('admin', 'roles'));
    }

    public function store(AdminRequest $request, Admin $admin)
    {
        $admin->fill($request->all());
        if(is_string($request->password) && $request->password !== '') {
            $admin->password = Hash::make((string) $request->password);
        }
        $admin->save();

        return redirect()->route('admin.admins.index')->with('success', '管理员创建成功！');
    }

    public function edit(Admin $admin)
    {
        // $this->authorize('update', $admin);
        $roles = Role::all();
        return view('admin.admins.create_and_edit', compact('admin', 'roles'));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        // $this->authorize('update', $admin);
        $admin->fill($request->all());
        if(is_string($request->password) && $request->password !== '') {
            $admin->password = Hash::make((string) $request->password);
        }
        $admin->save();

        return redirect()->route('admin.admins.index')->with('success', '管理员更新成功！');
    }

    public function destroy(Admin $admin)
    {
        // $this->authorize('destroy', $admin);
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', '管理员删除成功！');
    }
}
