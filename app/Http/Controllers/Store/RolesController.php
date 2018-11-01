<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRoleRequest;
use App\Http\Controllers\Controller;
use App\Models\EmployeeNode;
use App\Models\EmployeeRole;

class RolesController extends Controller
{
    public function index(Request $request, EmployeeRole $role)
    {
        $manager = \Auth::guard('store')->user();
        $roles = EmployeeRole::recent()->where('store_id', $manager->store_id)->paginate(20);
        return view('store.roles.index', compact('request', 'roles'));
    }

    public function create(EmployeeRole $role, EmployeeNode $node)
    {
        $nodes = $node->getTreeNodes();
        return view('store.roles.create_and_edit', compact('role', 'nodes'));
    }

    public function store(EmployeeRoleRequest $request, EmployeeRole $role)
    {
        $role->name = $request->name;
        $role->node_ids = json_encode($request->node_ids);
        $role->save();

        return redirect()->route('store.roles.index')->with('success', '角色创建成功！');
    }

    public function edit(EmployeeRole $role, EmployeeNode $node)
    {
        $this->authorize('update', $role);
        $nodes = $node->getTreeNodes();
        return view('store.roles.create_and_edit', compact('role', 'nodes'));
    }

    public function update(EmployeeRoleRequest $request, EmployeeRole $role)
    {
        $this->authorize('update', $role);
        $role->fill($request->all());
        $role->node_ids = json_encode($request->node_ids);
        $role->save();

        return redirect()->route('store.roles.index')->with('success', '角色更新成功！');
    }

    public function destroy(EmployeeRole $role)
    {
        $this->authorize('destroy', $role);
        $role->delete();

        return redirect()->route('store.roles.index')->with('success', '角色删除成功！');
    }
}
