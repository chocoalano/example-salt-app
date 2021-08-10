<?php

namespace App\Repositories\Product;
use App\Repositories\AppEloquent;
use App\Models\Product;

class ProductRepository extends AppEloquent
{
  protected $model;
  public function __construct(Product $model)
  {
      $this->model = $model;
  }
}