<?php

namespace App\Models;

class Product extends Model
{
    protected $fillable = ['name', 'intro', 'content', 'discount', 'image', 'sales', 'is_sale', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function specs()
    {
        return $this->hasMany(Spec::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function stockOrders()
    {
        return $this->hasMany(StockOrder::class);
    }

    public function hasOrder()
    {
        return $this->orders()->count() > 0 || $this->stockOrders()->count() > 0;
    }

    protected function getColorsAttribute($value)
    {
        if(is_array($value)) {
            return $value;
        }

        return json_decode($value, true);
    }

    protected function getFitBrandsAttribute($value)
    {
        if(is_array($value)) {
            return $value;
        }

        return json_decode($value, true);
    }

}
