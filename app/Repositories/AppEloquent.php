<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;

class AppEloquent
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index($join)
    {
      try {
          $u = $this->model;
          if ($join != '') {
              $u = $u->with($join);
          }
          return $u->latest()->paginate(5);
      } catch (\Exception $e) {
          return response()->json(['message' => $e->getMessage()], 500);
      }
    }

    public function show($id,$join){
        try {
            $u = $this->model;
            if ($join != '') {
                $u = $u->with($join);
            }
            return $u->findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function deleted($id){
        try {
            $u = $this->model;
            return $u->findOrFail($id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}