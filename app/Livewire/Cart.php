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

  public function removeCartItem($productUuid)
  {
    $this->cart = session()->get('cart');
    $this->cart['items'] = collect($this->cart['items'])
      ->reject(function ($item) use ($productUuid) {
        return $item['uuid'] == $productUuid;
      })
      ->values()
      ->all();
    
    // update cart quantity
    $this->cart['quantity']--;

    // update cart total
    $this->cart['total'] = collect($this->cart['items'])->sum(function ($item) {
      return $item['quantity'] * $item['price'];
    });

    session()->put('cart', $this->cart);
    $this->dispatch('cart-updated');

  }

  public function render()
  {
    return view('livewire.cart');
  }
}
