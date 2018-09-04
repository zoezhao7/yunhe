<?php

namespace App\Models;

class Role extends Model
{
    protected $table = 'admin_roles';

    protected $fillable = ['name', 'node_ids', 'node_names'];

    public function getNodeIdsAttribute($value)
    {
        return json_decode($value);
    }

}
