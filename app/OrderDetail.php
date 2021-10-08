<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'order_id','product_id', 'total_quantity','total_price'
    ]; 


    public $timestamps = true;


    //Chi tiết của hóa đơn
    public function Order()
    {
        return $this->belongsTo('App\Order');
    }

    //Hóa đơn chi tiết chứa id của sản phẩm
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}
