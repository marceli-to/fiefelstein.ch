<?php
namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Collection;
use App\Actions\Product\FindProduct;
use App\Actions\Cart\GetCart;
use App\Actions\Cart\StoreCart;

class CartItem extends Component
{
  public $uuid;
  public $item;
  public $quantity;
  public $total;
  public $shipping;
  public $product;
  public $cart;

  public function mount($uuid)
  {
    $this->uuid = $uuid;
    $this->cart = (new GetCart())->execute();
    $this->item = collect($this->cart['items'])->where('uuid', $this->uuid)->first();
    $this->quantity = $this->item['quantity'] ?? 1;
    $this->product = (new FindProduct())->execute($this->uuid);
    $this->setTotal();
  }

  public function decrement()
  {
    $this->quantity--;
    if ($this->quantity == 0)
    {
      return $this->remove();
    }
    $this->update();
  }

  public function increment()
  {
    $this->quantity = ($this->quantity < $this->product->stock) ? $this->quantity + 1 : $this->product->stock;
    $this->update();
  }

  public function change()
  {
    if ($this->quantity == 0)
    {
      return $this->remove();
    }
    $this->quantity = ($this->quantity < $this->product->stock) ? $this->quantity : $this->product->stock;
    $this->update();
  }

  public function update()
  {
    $this->setTotal();

    // update the cart
    $this->cart['items'] = collect($this->cart['items'])->map(function ($item) {
      if ($item['uuid'] == $this->uuid) {
        $item['quantity'] = $this->quantity;
      }
      return $item;
    })->toArray();

    // update the cart total
    $this->cart['total'] = collect($this->cart['items'])->sum(function ($item) {
      return $item['price'] * $item['quantity'];
    });

    // store the cart
    (new StoreCart())->execute($this->cart);
  }

  private function remove()
  {
    $this->cart['items'] = collect($this->cart['items'])
    ->reject(function ($item) {
      return $item['uuid'] == $this->uuid;
    })
    ->values()
    ->all();
    $this->cart['quantity']--;
    $this->cart['total'] = collect($this->cart['items'])->sum(function ($item) {
      return $item['price'] * $item['quantity'];
    });
    (new StoreCart())->execute($this->cart);
    return redirect()->route('order.overview');
  }

  private function setTotal()
  {
    $this->total = number_format($this->item['price'] * $this->quantity, 2, '.', '&thinsp;');
    $this->shipping = number_format($this->item['shipping'] * $this->quantity, 2, '.', '&thinsp;');
  }

  public function render()
  {
    return view('livewire.cart-item');
  }
}