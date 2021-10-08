<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'tables';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','table_name','table_capacity','table_status'
    ];

    //Bàn ăn có nhiều table-product
    public function tableproduct()
    {
        return $this->hasMany('App\TableProduct');
    }
}
