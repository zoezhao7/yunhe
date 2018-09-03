<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy extends Policy
{
    public function update(User $user, Product $product)
    {
        // return $product->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Product $product)
    {
        return true;
    }
}
