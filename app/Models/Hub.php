<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hub extends Model
{
    protected $fillable = ['spec_id', 'color', 'store_id', 'stock_order_id', 'stock_order_product_id', 'order_id', 'order_product_id'];

    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class );
    }
}
