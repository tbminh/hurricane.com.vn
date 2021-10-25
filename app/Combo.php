<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    protected $table = 'combos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','combo_name','combo_img', 'combo_discount', 'combo_total_price'
    ];

    //Bàn ăn có nhiều table-product
    public function comboproduct()
    {
        return $this->hasMany('App\ComboProduct');
    }

    public function combo_cart()
    {
        return $this->hasMany('App\ComboCart');
    }
}
