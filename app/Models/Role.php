<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class Role extends Model
{
    protected $table = 'admin_roles';

    protected $fillable = ['name', 'node_ids', 'node_names'];

    // 超级管理员ID
    public $superAdminRoleId = 1;

    public function isNotSuperAdmin()
    {
        if ($this->id === $this->superAdminRoleId) {
            return false;
        }
        return true;
    }

    // 获取角色权限树
    public static function getNodeTree()
    {
        if (!Cache::has('roleNodes')) {
            Role::cacheNodeTree();
        }

        return Cache::get('roleNodes');
    }

    public static function refreshNodeTree()
    {
        Cache::forget('roleNodes');
        Role::getNodeTree();
    }

    public static function cacheNodeTree()
    {
        $tree = [];
        $roles = Role::all();
        $nodes = Node::all();
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
        Cache::forever('roleNodes', $tree);
    }


    public function getNodeIdsAttribute($value)
    {
        return json_decode($value);
    }

}
