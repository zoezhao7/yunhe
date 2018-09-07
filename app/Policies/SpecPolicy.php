<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Spec;

class SpecPolicy extends Policy
{
    public function update(User $user, Spec $spec)
    {
        // return $spec->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Spec $spec)
    {
        return true;
    }
}
