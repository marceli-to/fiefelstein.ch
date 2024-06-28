<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Actions\Product\GetProduct;
use App\Actions\Product\GetProducts;
use App\Actions\Product\GetCategories;
use App\Models\Product;

class ProductController extends BaseController
{
  /**
   * Shows the product detail page
   * 
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {  
    return view('pages.product.show', [
      'product' => (new GetProduct())->execute($product),
    ]);
  }

  /**
   * Shows the product collection page
   * 
   * @return \Illuminate\Http\Response
   */
  public function listing(Product $product)
  {  
    return view('pages.product.listing', [
      'products' => (new GetProducts())->execute(),
      'categories' => (new GetCategories())->execute(),
    ]);
  }
}
