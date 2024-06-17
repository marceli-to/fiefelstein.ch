<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class CheckoutController extends BaseController
{
  public function index()
  {  
    return view('pages.basket.overview');
  }
}