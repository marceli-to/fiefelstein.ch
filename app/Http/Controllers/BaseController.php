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
        'title' => $product->group_title ?? $product->title,
        'url' => route('page.product.show', ['product' => $product->slug]),
        'current' => request()->route()->parameter('product') == $product->slug,
      ];
    }
    view()->share(['menuItems' => $menuItems]);
  }
}