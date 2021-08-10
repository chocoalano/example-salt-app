<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'products_detail';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'desc','content','price'
    ];
    public function parent()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
