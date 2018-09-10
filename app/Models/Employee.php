<?php

namespace App\Models;
use App\Http\Requests\AuthorizationRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $tokenSalt = 'yhyunhe#_lsf';

    protected $fillable = ['name', 'phone', 'store_id', 'type', 'password', 'idnumber', 'api_token'];

    public static $types = [
        ['id' => 1, 'name' => '店长'],
        ['id' => 2, 'name' => '销售'],
        ['id' => 3, 'name' => '渠道'],
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getToken()
    {
        return md5(md5($this->id . '|' . $this->tokenSalt . '|' . time()));
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function hasMember()
    {
        return !empty($this->members());
    }


    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }


}
