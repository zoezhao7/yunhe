<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NodeRequest;
use App\Models\Node;

class NodesController extends Controller
{
    public function index(Request $request, Node $node)
    {
        $nodes = Node::paginate();
        return view('admin.nodes.index', compact('request', 'nodes'));
    }

    public function create(Node $node)
    {
        return view('admin.nodes.create_and_edit', compact('node'));
    }

    public function store(NodeRequest $request)
    {
        $node = Node::create($request->all());
        return redirect()->route('admin.nodes.index')->with('success', '节点创建成功！');
    }

    public function edit(Node $node)
    {
        // $this->authorize('update', $node);
        return view('admin.nodes.create_and_edit', compact('node'));
    }

    public function update(NodeRequest $request, Node $node)
    {
        // $this->authorize('update', $node);
        $node->update($request->all());

        return redirect()->route('admin.nodes.index')->with('success', '节点更新成功！');
    }

    public function destroy(Node $node)
    {
        // $this->authorize('destroy', $node);
        $node->delete();

        return redirect()->route('admin.nodes.index')->with('success', '节点删除成功！');
    }
}
