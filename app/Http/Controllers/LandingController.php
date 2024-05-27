<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Actions\Product\GetProducts;
use Illuminate\Http\Request;

class LandingController extends BaseController
{
  /**
   * Shows the landing page
   * 
   * @return \Illuminate\Http\Response
   */
  public function index()
  {  
    return view('pages.landing', [
      'products' => (new GetProducts())->execute(),
    ]);
  }
}
