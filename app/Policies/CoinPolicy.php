<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Coin;

class CoinPolicy extends Policy
{
    public function update(User $user, Coin $coin)
    {
        // return $coin->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Coin $coin)
    {
        return true;
    }
}
