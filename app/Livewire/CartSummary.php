<?php
namespace App\Livewire;
use Livewire\Component;
use Livewire\Attributes\On; 

class CartSummary extends Component
{
  public $cart;

  public function mount()
  {
    $this->cart = session()->get('cart');
  }

  public function render()
  {
    return view('livewire.cart-summary');
  }
}
