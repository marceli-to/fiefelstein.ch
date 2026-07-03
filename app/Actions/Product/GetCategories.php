<?php
namespace App\Actions\Product;
use App\Models\Product;
use App\Models\ProductCategory;

class GetCategories
{
  public function execute()
  {
    return ProductCategory::shop()->whereHas('products', function ($query) {
      $query->published();
    })->get();
  }
}