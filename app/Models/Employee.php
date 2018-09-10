<?php

namespace App\Models;
use App\Http\Requests\AuthorizationRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;

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

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function hasMember()
    {
        return !empty($this->members());
    }

}
