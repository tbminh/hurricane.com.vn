<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'role_id', 'full_name','user_name','password','address','phone','email'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Người người thuộc quyền nào
    public function roleaccess()
    {
        return $this->belongsTo('App\RoleAccess');
    }

    //Người dùng chỉ có một giỏ hàng
    public function shoppingcart()
    {
        return $this->hasOne('App\ShoppingCart');
    }

    //Người dùng có nhiều hóa đơn
    public function order()
    {
        return $this->hasMany('App\Order');
    }

    //Người dùng có nhiều bình luận
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    //Người dùng có nhiều reply_comment
    public function reply_comment()
    {
        return $this->hasMany('App\Reply_comment');
    }



}
