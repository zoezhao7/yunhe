<?php

namespace App\Observers;

use App\Models\Memo;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class MemoObserver
{
    public function saving(Memo $memo)
    {
        if(is_null($memo->handled_at)) {
            $memo->handled_at = $memo->created_at ? $memo->created_at : now();
        }
    }
}