<?php
namespace App\Livewire;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Collection;

class CartButton extends Component
{
  public $productId;
  public $itemsInCart;
  public $cart;

  public function mount($productId)
  {
    $this->productId = $productId;
    $this->cart = $this->getCart();
    $product = collect($this->cart['items'])->where('product_id', $this->productId)->first();
    $this->itemsInCart = $product ? 1 : 0;
  }

  public function addToCart($quantity)
  {
    $this->cart = $this->getCart();
    $product   = Product::findOrFail($this->productId);
    $cartItems = collect($this->cart['items']);
    $cartItem  = $cartItems->where('product_id', $product->id)->first();

    if ($cartItem)
    {
      if ($quantity == 0)
      {
        $this->removeFromCart($product);
      }
      else
      {
        $cartItem['quantity'] = $quantity;
        $this->updateCartItem($cartItem);
      }
    } 
    else
    {
      if ($quantity > 0)
      {
        $this->addItemToCart($product, $quantity);
      }
    }

    $this->updateCartTotal();
  }

  public function updateCartTotal()
  {
    $this->cart['total'] = collect($this->cart['items'])->sum(function ($item) {
      return $item['price'] * $item['quantity'];
    });

    session()->put('cart', $this->cart);
    $this->dispatch('cart-updated');
  }

  public function getCart()
  {
    return session()->get('cart', [
      'items' => [],
      'quantity' => 0,
      'total' => 0,
    ]);
  }

  private function removeFromCart($product)
  {
    $this->cart['items'] = collect($this->cart['items'])
      ->reject(function ($item) use ($product) {
        return $item['product_id'] == $product->id;
      })
      ->values()
      ->all();

    $this->cart['quantity']--;
  }

  private function updateCartItem($cartItem)
  {
    $this->cart['items'] = collect($this->cart['items'])
      ->map(function ($item) use ($cartItem) {
        return $item['product_id'] == $cartItem['product_id'] ? $cartItem : $item;
      })
      ->values()
      ->all();
  }

  private function addItemToCart($product, $quantity)
  {
    $this->cart['items'][] = [
      'product_id' => $product->id,
      'title' => $product->title,
      'description' => $product->description,
      'price' => $product->price,
      'quantity' => $quantity,
    ];
    $this->cart['quantity']++;
  }

  public function render()
  {
    return view('livewire.cart-button');
  }
}