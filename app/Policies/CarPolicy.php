<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Car;

class CarPolicy extends Policy
{
    public function update(User $user, Car $car)
    {
        // return $car->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Car $car)
    {
        return true;
    }
}
