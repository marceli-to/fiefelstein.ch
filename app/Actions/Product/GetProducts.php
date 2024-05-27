<?php
namespace App\Actions\Product;
use App\Models\Product;

class GetProducts
{
  public function execute()
  {
    return Product::published()->get();
  }
}