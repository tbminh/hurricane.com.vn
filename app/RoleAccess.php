<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleAccess extends Model
{
    protected $table = 'role_accesses';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'role_name','role_describe'
    ];

    public $timestamps = true;

    //Quyền có nhiều người dùng
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
