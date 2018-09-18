<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Memo;

class MemoPolicy extends Policy
{
    public function update(User $user, Memo $memo)
    {
        // return $memo->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Memo $memo)
    {
        return true;
    }
}
