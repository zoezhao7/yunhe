<?php

namespace App\Observers;

use App\Models\StockOrder;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class StockOrderObserver
{
    public function creating(StockOrder $stock_order)
    {
        $stock_order->idnumber = $stock_order->getIdnumber();
    }
}