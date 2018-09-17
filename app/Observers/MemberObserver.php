<?php

namespace App\Observers;

use App\Models\Member;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class MemberObserver
{
    public function saving(Member $member)
    {
        $member->letter = strtoupper(substr(pinyin_abbr($member->name), 0, 1));
    }
}