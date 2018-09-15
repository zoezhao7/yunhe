<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Commission;

class CommissionPolicy extends Policy
{
    public function update(User $user, Commission $commission)
    {
        // return $commission->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Commission $commission)
    {
        return true;
    }
}
