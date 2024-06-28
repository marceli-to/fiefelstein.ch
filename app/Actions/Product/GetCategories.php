<?php
namespace App\Actions\Product;
use App\Models\Product;
use App\Models\ProductCategory;

class GetCategories
{
  public function execute()
  {
    return ProductCategory::whereHas('products', function ($query) {
      $query->published();
    })->get();
  }
}