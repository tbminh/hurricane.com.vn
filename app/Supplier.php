<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'supplier_name','supplier_address','supplier_describe','supplier_img'
    ];

    public $timestamps = true;

    //Nhà cung cấp có nhiều (Sản phẩm cung cấp)
    public function productsupplier()
    {
        return $this->hasMany('App\ProductSupplier');
    }
}
