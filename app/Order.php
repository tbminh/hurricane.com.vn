<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','user_id','order_status','order_payment'
    ]; 

    public $timestamps = true;

    //Hoá đơn có nhiều hóa đơn chi tiết
    public function orderdetail()
    {
        return $this->hasMany('App\OrderDetail');
    }

    //Hóa đơn thuộc người dùng nào
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //Hóa đơn thuộc khách vãng lai nào
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

}

