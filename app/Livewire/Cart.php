<?php
namespace App\Livewire;
use Livewire\Component;
use Livewire\Attributes\On; 

class Cart extends Component
{
  public $cart;

  public $showCart = false;

  public function mount()
  {
    $this->cart = session()->get('cart');
  }

  #[On('cart-updated')]
  public function updateCart()
  {
    $this->cart = session()->get('cart');

    if ($this->cart['quantity'] == 0) {
      $this->dispatch('hide-updated-cart');
      $this->showCart = false;
    }
    else {
      $this->dispatch('display-updated-cart');
      $this->showCart = true;
    }
  }

  public function render()
  {
    return view('livewire.cart');
  }
}
