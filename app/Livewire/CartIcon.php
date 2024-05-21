<?php
namespace App\Livewire;
use Livewire\Component;
use Livewire\Attributes\On; 

class CartIcon extends Component
{
  public $cartItemCount = 0;

  public function mount()
  {
    $this->updateCartItemCount();
  }

  #[On('cart-updated')]
  public function updateCartItemCount()
  {
    $cart = session()->get('cart');
    $this->cartItemCount = $cart['quantity'] ?? 0;
  }

  public function render()
  {
    return view('livewire.cart-icon');
  }
}