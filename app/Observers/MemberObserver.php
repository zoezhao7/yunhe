<?php

namespace App\Observers;

use App\Models\Member;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class MemberObserver
{
    public function creating(Member $member)
    {
        //
    }

    public function updating(Member $member)
    {
        //
    }
}