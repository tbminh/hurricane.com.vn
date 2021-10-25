<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComboCart extends Model
{
    protected $table = 'combo_carts';
    protected $primaryKey = 'id';

    protected $fillable = ['id','combo_id','cart_id','quantity_cc'
    ];

    public function combos(){
        return $this->belongsTo('App\Combo');
    }

    public function shopping_carts(){
        return $this->belongsTo('App\ShoppingCart');
    }
}
