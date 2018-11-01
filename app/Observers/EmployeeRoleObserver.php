<?php

namespace App\Observers;

use App\Models\EmployeeNode;
use App\Models\EmployeeRole;
use Illuminate\Support\Facades\Cache;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class EmployeeRoleObserver
{
    public function saving(EmployeeRole $role)
    {
        $node_ids = is_array($role->node_ids) ? $role->node_ids : json_decode($role->node_ids);
        $nodes = EmployeeNode::whereIn('id', $node_ids)->pluck('action_name')->toArray();
        $role->node_names = implode(',', $nodes);
        $role->store_id = \Auth::guard('store')->user()->store_id;
    }

    public function saved(EmployeeRole $role)
    {
        EmployeeRole::refreshNodeTree();
    }

}