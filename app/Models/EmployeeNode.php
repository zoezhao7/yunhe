<?php

namespace App\Models;

class EmployeeNode extends Model
{
    protected $fillable = ['controller_name', 'controller', 'action_name', 'action'];

    public function getTreeNodes()
    {
        $nodes = EmployeeNode::all();

        $treeData = [];

        foreach ($nodes as $node) {
            $treeData[$node->controller]['name'] = $node->controller_name;
            $treeData[$node->controller]['actions'][] = ['action_name' => $node->action_name, 'action' =>$node->action, 'id'=>$node->id];
        }

        return $treeData;
    }
}
