<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Actions\Landing\GetCards;
use App\Models\LandingPage;
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
    // dd((new GetCards())->execute());
    return view('pages.landing', [
      'cards' =>  (new GetCards())->execute(),
    ]);
  }
}
