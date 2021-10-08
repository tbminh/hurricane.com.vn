<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtDetail extends Model
{
    protected $table = 'ot_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'ot_id','product_id', 'ot_quantity','ot_price'
    ]; 

    public $timestamps = true;


    //Chi tiết của hóa đơn
    public function Order()
    {
        return $this->belongsTo('App\OrderTable');
    }

    //Hóa đơn chi tiết chứa id của sản phẩm
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
