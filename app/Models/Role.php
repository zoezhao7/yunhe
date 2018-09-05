<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class Role extends Model
{
    protected $table = 'admin_roles';

    protected $fillable = ['name', 'node_ids', 'node_names'];

    public function getRoleNodes($role_id)
    {
        if (!$role_id) {
            return [];
        }

        $key = 'role_' . $role_id . '_nodes';

        Cache::forget($key);

        if (!Cache::has($key)) {
            Cache::forever($key, $this->getNodeArray($role_id));
        }

        return Cache::get($key);
    }

    public function getNodeArray($role_id)
    {
        $role = Role::find($role_id);

        if (!$role) {
            return [];
        }

        $node_collect = Node::whereIn('id', $role->node_ids)->select('controller', 'action')->get();

        $nodes = [];
        foreach ($node_collect as $node) {
            $actions = explode(',', $node->action);
            foreach ($actions as $action) {
                $nodes[] = $node->controller . '.' . $action;
            }
        }

        return $nodes;
    }

    public function getNodeIdsAttribute($value)
    {
        return json_decode($value);
    }

}
