<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Actions\Cart\GetCart;

class OrderController extends BaseController
{
  public function index()
  {  
    return view('pages.order.overview', [
      'cart' => (new GetCart())->execute(),
    ]);
  }
}