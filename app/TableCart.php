<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableCart extends Model
{
    protected $table = 'table_carts';
    protected $primaryKey = 'id';

    protected $fillable = ['id','user_id','table_id','product_id','tc_quantity'];

    //TableCart thuoc User
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //TableCart thuoc Table
    public function table()
    {
        return $this->belongsTo('App\Table');
    }

    //TableCart thuoc User
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    
}