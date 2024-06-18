<?php
namespace App\Actions\Product;
use App\Models\Product;
use App\Models\ProductVariation;

class FindProduct
{
  public function execute($uuid)
  {
    $product = Product::with('variations')->where('uuid', $uuid)->first();

    if (!$product)
    {
      $product = ProductVariation::where('uuid', $uuid)->first();
    }

    return $product;
  }
}