<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSupplier extends Model
{
    protected $table = 'product_suppliers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'product_id','supplier_id'
    ];

    public $timestamps = true;
    
    //Do Product và Supplier là quan hệ nhiều nhiều nên phải tạo ra bảng trung gian product_supplier
    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
