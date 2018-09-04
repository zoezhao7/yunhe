<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\Node;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class RoleObserver
{
    public function saving(Role $role)
    {
        $node_ids = json_decode($role->node_ids);
        $nodes = Node::whereIn('id', $node_ids)->pluck('action_name')->toArray();
        $role->node_names = implode(',', $nodes);
    }

}