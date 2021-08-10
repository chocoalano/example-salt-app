<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'products';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name','code'
    ];
    public function child()
    {
        return $this->hasOne('App\Models\ProductDetail');
    }
    public function cart()
    {
        return $this->hasMany('App\Models\Cart');
    }
}
