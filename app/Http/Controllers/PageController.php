<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\ContactPage;
use App\Models\IdeaPage;

class PageController extends BaseController
{
  public function brocante()
  {  
    return view('pages.brocante');
  }

  public function idea()
  {  
    return view('pages.idea', [
      'data' => IdeaPage::first()
    ]);
  }

  public function contact()
  {  
    return view('pages.contact', [
      'data' => ContactPage::first()
    ]);
  }

}