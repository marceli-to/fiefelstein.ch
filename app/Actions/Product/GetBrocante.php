<?php
namespace App\Actions\Product;
use App\Models\Product;

class GetBrocante
{
  public function execute()
  {
    return Product::with(['variations', 'category'])->published()->standalone()->get();
  }
}
