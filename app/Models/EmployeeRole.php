<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class EmployeeRole extends Model
{

    protected $fillable = ['name', 'node_ids', 'node_names'];

    // 获取角色权限树
    public static function getNodeTree()
    {
        if (!Cache::has('employeeRoleNodes')) {
            EmployeeRole::cacheNodeTree();
        }

        return Cache::get('employeeRoleNodes');
    }

    public static function refreshNodeTree()
    {
        Cache::forget('employeeRoleNodes');
        EmployeeRole::getNodeTree();
    }

    public static function cacheNodeTree()
    {
        $tree = [];
        $roles = EmployeeRole::all();
        $nodes = EmployeeNode::all();
        foreach ($roles as $role) {
            $tree[$role->id] = [];
            foreach ($nodes as $node) {
                if (in_array($node->id, $role->node_ids)) {
                    $actions = explode(',', $node->action);
                    foreach ($actions as $action) {
                        $tree[$role->id][] = strtolower($node->controller . '.' . $action);
                    }
                }
            }
        }
        Cache::forever('employeeRoleNodes', $tree);
    }


    public function getNodeIdsAttribute($value)
    {
        return json_decode($value);
    }
}
