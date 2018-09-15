<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CarBrand;

class CarBrandPolicy extends Policy
{
    public function update(User $user, CarBrand $car_brand)
    {
        // return $car_brand->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, CarBrand $car_brand)
    {
        return true;
    }
}
