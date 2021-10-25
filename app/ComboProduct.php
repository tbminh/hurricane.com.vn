<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComboProduct extends Model
{
    protected $table = 'combo_products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','combo_id','product_id','quantity_combo'
    ];

    public function products()
    {
        return $this->belongsTo('App\Product');
    }

    public function combos()
    {
        return $this->belongsTo('App\Combo');
    }
}
