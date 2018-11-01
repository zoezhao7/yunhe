<?php

namespace App\Observers;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class NodeObserver
{
    public function saved(Node $node)
    {
        Role::refreshNodeTree();
    }

}