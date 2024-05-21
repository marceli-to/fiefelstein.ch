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
    $this->dispatch('toggle-updated-cart');
    $this->showCart = true;
  }

  public function render()
  {
    return view('livewire.cart');
  }
}
