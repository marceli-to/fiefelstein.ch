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

  #[On('cart-toggle')]
  public function toggleCart()
  {
    $this->showCart = !$this->showCart;
  }

  #[On('cart-updated')]
  public function updateCart()
  {
    $this->cart = session()->get('cart');
  }

  public function render()
  {
    return view('livewire.cart');
  }
}
