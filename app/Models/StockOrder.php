<?php

namespace App\Models;

class StockOrder extends Model
{
    protected $fillable = ['store_id', 'employee_id', 'product_id', 'spec_id', 'color', 'number', 'remark', 'status', 'product_idnumber', 'delivery_number', 'delivery_note', 'receipted_at', 'delivered_at', 'received_at'];

    public static $statusMsg = [
        0 => ['id'=> 0, 'name' =>'待接单', 'label-class' => 'label-danger' ],
        1 => ['id'=> 1, 'name' =>'备货中', 'label-class' => 'label-warning' ],
        2 => ['id'=> 2, 'name' =>'已发货', 'label-class' => 'label-primary' ],
        3 => ['id'=> 3, 'name' =>'已收货', 'label-class' => 'label-success' ],
    ];

    public function getIdnumber()
    {
        return 'SO' . $this->spec_id . '-' . date('md') . uniqid();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
