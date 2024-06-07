<?php
namespace App\Actions\Product;
use App\Models\ProductVariation;

class FindProductVariation
{
  public function execute($uuid)
  {
    return ProductVariation::where('uuid', $uuid)->firstOrFail();
  }
}