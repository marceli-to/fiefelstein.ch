<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Services\Pdf\Pdf;

class TestController extends Controller
{
  protected $headers = [
    'Content-Type: application/pdf',
    'Cache-Control: no-store, no-cache, must-revalidate',
    'Expires: Sun, 01 Jan 2014 00:00:00 GMT',
    'Pragma: no-cache'
  ];

  public function invoice()
  {  
    $pdf = (new Pdf())->create([
      'data' => '',
      'view' => 'invoice',
      'name' => 'fiefelstein.ch-rechnung-ea029ddd-fd2e-4c6e-a215-8db35e511cc8'
    ]);

    return response()->download($pdf['path'], $pdf['name'], $this->headers);
  }

}