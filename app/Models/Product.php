<?php

namespace App\Models;

class Product extends Model
{
    protected $fillable = ['name', 'intro', 'content', 'image', 'sales', 'is_sale', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
