<?php

namespace App\Repositories\Cart;

use App\Repositories\AppEloquent;
use App\Models\Cart;
use App\Models\Saldo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartRepository extends AppEloquent
{
    protected $model;
    protected $s;
    public function __construct(Cart $model, Saldo $s)
    {
        $this->model = $model;
        $this->s = $s;
    }
    public function indexCart($join)
    {
        try {
            $u = $this->model->where('user_id', Auth::user()->id);
            if ($join != '') {
                $u = $u->with($join);
            }
            return $u->latest()->paginate(5);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function storeCart($q)
    {
        try {
            $query=$this->s->where('user_id',Auth::user()->id);
            $count=$query->count();
            $fetch=$query->first();
            $calculate=($count > 0)? $fetch->saldo + $q['x']:$q['x'];
            $this->model->create([
                'user_id'=>Auth::user()->id,
                'product_id'=>$q['id'],
                'payment'=>'done',
                'payment_price'=>$q['x']
            ]);
            $this->s->updateOrCreate([
                'user_id' => Auth::user()->id,
            ],[
                'saldo' => $calculate
            ]);
            DB::commit();
            return json_encode(['msg'=>'success'],200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
