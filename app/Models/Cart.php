<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'carts';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id','product_id','payment','payment_price'
    ];
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
