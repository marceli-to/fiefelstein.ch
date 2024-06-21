<?php
namespace App\Livewire;
use Livewire\Component;
use Livewire\Attributes\On; 
use App\Actions\Cart\GetCart;

class CartTotal extends Component
{
  public $cart;
  public $subtotal;
  public $tax;
  public $total;

  public function mount()
  {
    $this->cart = (new GetCart())->execute();
    $this->setTotal();
  }

  #[On('cart-updated')]
  public function setTotal()
  {
    $this->subtotal = 0;
    $this->tax = 0;
    $this->total = 0;
    $this->cart = (new GetCart())->execute();

    if ($this->cart)
    {
      foreach ($this->cart['items'] as $item)
      {
        $this->subtotal += $item['total'] + $item['total_shipping'];
      }
    }

    $this->tax = round( ( ( $this->subtotal ) / 100 * config('invoice.tax_rate')) * 20 ) / 20;
    $this->total = $this->subtotal + $this->tax;
  }

  public function render()
  {
    return view('livewire.cart-total');
  }
}
