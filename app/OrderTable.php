<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTable extends Model
{
    protected $table = 'order_tables';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','user_id','ot_status','ot_payment'
    ]; 

    public $timestamps = true;

    //Hoá đơn có nhiều hóa đơn chi tiết
    public function otdetail()
    {
        return $this->hasMany('App\OtDetail');
    }

    //Hóa đơn thuộc người dùng nào
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
