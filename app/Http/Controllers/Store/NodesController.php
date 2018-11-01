<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Requests\NodeRequest;
use App\Http\Controllers\Controller;
use App\Models\EmployeeNode;
use App\Models\EmployeeRole;

class NodesController extends Controller
{

    public function index(Request $request, EmployeeNode $node)
    {
        $nodes = EmployeeNode::paginate();
        return view('store.nodes.index', compact('request', 'nodes'));
    }

    public function create(EmployeeNode $node)
    {
        return view('store.nodes.create_and_edit', compact('node'));
    }

    public function store(NodeRequest $request)
    {
        EmployeeNode::create($request->all());
        return redirect()->route('store.nodes.index')->with('success', '节点创建成功！');
    }

    public function edit(EmployeeNode $node)
    {
        $this->authorize('update', $node);

        return view('store.nodes.create_and_edit', compact('node'));
    }

    public function update(NodeRequest $request, EmployeeNode $node)
    {
        $this->authorize('update', $node);

        $node->update($request->all());

        return redirect()->route('store.nodes.index')->with('success', '节点更新成功！');
    }

    public function destroy(EmployeeNode $node)
    {
        $this->authorize('destroy', $node);

        $node->delete();

        return redirect()->route('store.nodes.index')->with('success', '节点删除成功！');
    }
}
