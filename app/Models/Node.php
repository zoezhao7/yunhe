<?php

namespace App\Models;

class Node extends Model
{
    protected $table = 'admin_nodes';

    protected $fillable = ['controller_name', 'controller', 'action_name', 'action'];

}
