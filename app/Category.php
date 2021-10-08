<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'category_name','category_image'
    ];

    public $timestamps = true;


    //Loại sản phẩm có nhiều sản phẩm
    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
