<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StockOrder;

class StockOrderPolicy extends Policy
{
    public function update(User $user, StockOrder $stock_order)
    {
        // return $stock_order->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, StockOrder $stock_order)
    {
        return true;
    }
}
