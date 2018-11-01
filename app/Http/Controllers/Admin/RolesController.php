<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\Node;

class RolesController extends Controller
{
    public function index(Request $request, Role $role)
    {
        $role = Role::first();

        $roles = $role->recent()->paginate(20);
        return view('admin.roles.index', compact('request', 'roles'));
    }

    public function create(Role $role, Node $node)
    {
        $nodes = $node->getTreeNodes();
        return view('admin.roles.create_and_edit', compact('role', 'nodes'));
    }

    public function store(RoleRequest $request, Role $role)
    {
        $role->name = $request->name;
        $role->node_ids = json_encode($request->node_ids);
        $role->save();

        return redirect()->route('admin.roles.index')->with('success', '角色创建成功！');
    }

    public function edit(Role $role, Node $node)
    {
        $this->authorize('update', $role);
        $nodes = $node->getTreeNodes();
        return view('admin.roles.create_and_edit', compact('role', 'nodes'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('update', $role);
        $role->fill($request->all());
        $role->node_ids = json_encode($request->node_ids);
        $role->save();

        return redirect()->route('admin.roles.index')->with('success', '角色更新成功！');
    }

    public function destroy(Role $role)
    {
        $this->authorize('destroy', $role);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', '角色删除成功！');
    }
}
