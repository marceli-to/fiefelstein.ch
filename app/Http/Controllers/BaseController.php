<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class BaseController extends Controller
{
  public function __construct()
  {
    $products = Product::published()->orderBy('sort')->get();
    $menuItems = [];
    foreach($products as $product)
    {
      $menuItems[] = [
        'title' => $product->title,
        'url' => route('page.product.show', ['slug' => \Str::slug($product->title), 'id' => $product->id]),
        'current' => request()->route()->parameter('id') == $product->id,
      ];
    }
    view()->share(['menuItems' => $menuItems]);
  }
}