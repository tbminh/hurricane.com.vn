<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_carts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','user_id','product_id','quantity'
    ];

    public $timestamps = true;

    //Gio hang thuoc nguoi dung
    public function roleaccess()
    {
        return $this->belongsTo('App\RoleAccess');
    }

    //San pham trong gio hang thuoc san pham
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
