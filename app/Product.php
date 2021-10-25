<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','category_id','product_name','product_quantity','product_price','product_img','product_describe',
        'product_discount','unit_price'
    ];



    public function categories()
    {
        return $this->belongsTo('App\Categories');
    }

    //San pham co nhieu trong hoa don chi tiet
    public function orderdetail()
    {
        return $this->hasMany('App\OrderDetail');
    }

    //San pham co nhieu trong gio hang
    public function shoppingcart()
    {
        return $this->hasMany('App\ShoppingCart');
    }

    //San pham co nhieu (nha cung cap san pham)
    public function productsupplier()
    {
        return $this->hasMany('App\ProductSupplier');
    }

    //San pham có một slider
    // public function slider()
    // {
    //     return $this->hasOne('App\Slider');
    // }
}
