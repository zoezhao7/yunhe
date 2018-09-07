<?php

namespace App\Models;

class Employee extends Model
{
    protected $fillable = ['name', 'phone', 'store_id', 'type', 'password', 'idnumber', 'status'];

    public static $types = [
        ['id' => 1, 'name' => '店长'],
        ['id' => 2, 'name' => '销售'],
        ['id' => 3, 'name' => '渠道'],
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}
