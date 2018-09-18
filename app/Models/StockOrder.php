<?php

namespace App\Models;

class StockOrder extends Model
{
    protected $fillable = ['store_id', 'employee_id', 'spec_id', 'color', 'number', 'status', 'product_idnumber', 'transport_number', 'delivery_notes', 'receipted_at', 'transported_at', 'received_at'];

    public function getIdnumber()
    {
        return $this->store_id . $this->employee_id . $this->spec_id . rand(1111, 9999) . time();
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
