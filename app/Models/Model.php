<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends EloquentModel
{
    use SoftDeletes;

    protected $dates = ['delete_at'];

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }

}
