<?php

namespace App\Models;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'type'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
