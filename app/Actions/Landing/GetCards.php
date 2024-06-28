<?php
namespace App\Actions\Landing;
use App\Models\LandingPage;
use App\Models\Product;

class GetCards
{
  public function execute()
  {
    $landingPage = LandingPage::first();
    $cards = [];
    foreach ($landingPage->cards as $card)
    {
      if ($card['type'] === 'Produkt')
      {
        $cards[] = [
          'type' => 'product',
          'product' => Product::find($card['product_id']),
        ];
      } 
      else
      {
        $cards[] = [
          'type' => 'text',
          'text' => $card['text'],
        ];
      }
    }
    return $cards;
  }
}