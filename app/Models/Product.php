<?php

namespace App\Models;

class Product extends Model
{
    protected $fillable = ['name', 'intro', 'content', 'discount', 'image', 'sales', 'is_sale', 'category_id', 'colors', 'fit_brands'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function specs()
    {
        return $this->hasMany(Spec::class);
    }

    public function orderProducts()
    {
        return $this->hasManyThrough(OrderProduct::class, Spec::class);
    }

    public function stockOrderProducts()
    {
        return $this->hasManyThrough(StockOrderProduct::class, Spec::class);
    }

    public function hasOrder()
    {
        return $this->orderProducts()->count() > 0 || $this->stockOrderProducts()->count() > 0;
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
