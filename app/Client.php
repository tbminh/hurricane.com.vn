<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','client_name','client_phone','client_address'
    ];
    public $timestamps = true;

    //Người dùng có nhiều hóa đơn
    public function order()
    {
        return $this->hasMany('App\Order');
    }
}
