<?php

namespace App\Observers;

use App\Models\StockOrder;
use App\Models\StockOrderProduct;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class StockOrderObserver
{
    public function creating(StockOrder $order)
    {
        // 获取订单ID
        $order->idnumber = $order->getIdnumber();
    }

    public function created(StockOrder $stockOrder)
    {
        // 将备货清单中的产品绑定至备货订单
        StockOrderProduct::where('stock_order_id', 0)->update(['stock_order_id' => $stockOrder->id]);
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