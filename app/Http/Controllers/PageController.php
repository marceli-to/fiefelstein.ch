<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\ContactPage;
use App\Models\IdeaPage;
use App\Actions\Product\GetBrocante;

class PageController extends BaseController
{
  public function brocante()
  {
    return view('pages.brocante', [
      'products' => (new GetBrocante())->execute(),
    ]);
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