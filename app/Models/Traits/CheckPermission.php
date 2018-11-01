<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/10/19
 * Time: 15:08
 */

namespace App\Models\Traits;

use App\Models\Role;

trait CheckPermission
{
    // 获取用户的权限节点清单
    public function getNodes()
    {
        $role_ids = $this->role_ids;
        $roleNodeTree = Role::getNodeTree();

        $nodes = [];

        foreach ($role_ids as $role_id) {
            if (isset($roleNodeTree[$role_id])) {
                $nodes = array_merge($nodes, $roleNodeTree[$role_id]);
            }
        }

        return array_unique($nodes);
    }

    public function getRoleIdsAttribute($value)
    {
        return is_array($value) ? $value : json_decode($value);
    }

    // 验证权限
    public function checkPermission($actionName)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($actionName && in_array(strtolower((string)$actionName), $this->getNodes())) {
            return true;
        }

        return false;
    }
}