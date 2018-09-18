<?php

use Illuminate\Database\Seeder;
use App\Models\StockOrder;

class StockOrdersTableSeeder extends Seeder
{
    public function run()
    {
        $stock_orders = factory(StockOrder::class)->times(50)->make()->each(function ($stock_order, $index) {
            if ($index == 0) {
                // $stock_order->field = 'value';
            }
        });

        StockOrder::insert($stock_orders->toArray());
    }

}

