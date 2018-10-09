<?php

namespace App\Observers;

use App\Models\StockOrder;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class StockOrderObserver
{
    public function creating(StockOrder $order)
    {
        $order->idnumber = $order->getIdnumber();
    }

    public function updating(StockOrder $stockOrder)
    {
    }

    public function deleting(StockOrder $order)
    {
        if($order->status > 0) {
            denied('已接单，不允许删除！');
        }
    }
}