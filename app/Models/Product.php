<?php

namespace App\Models;

class Product extends Model
{
    protected $fillable = ['name', 'intro', 'content', 'image', 'sales', 'is_sale'];
}
