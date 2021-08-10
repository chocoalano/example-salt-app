<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Saldo extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'saldos';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id','saldo'
    ];
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
