<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PageController extends BaseController
{
  public function brocante()
  {  
    return view('pages.brocante');
  }

  public function idea()
  {  
    return view('pages.idea');
  }

  public function contact()
  {  
    return view('pages.contact');
  }

}