<?php
namespace App\Livewire;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Actions\Product\FindProduct;
use App\Actions\Product\FindProductVariation;
use Livewire\Component;
use Illuminate\Support\Collection;

class CartButton extends Component
{
  public $productUuid;
  public $isVariation;
  public $itemsInCart;
  public $cart;

  public function mount($productUuid, $isVariation)
  {
    $this->productUuid = $productUuid;
    $this->isVariation = $isVariation;
    $this->cart = $this->getCart();
    $product = collect($this->cart['items'])->where('uuid', $this->productUuid)->first();
    $this->itemsInCart = $product['quantity'] ?? 1;
  }

  public function addToCart($quantity)
  {
    $this->cart = $this->getCart();
    $product   = $this->isVariation ? (new FindProductVariation())->execute($this->productUuid) : (new FindProduct())->execute($this->productUuid);
    $cartItems = collect($this->cart['items']);
    $cartItem  = $cartItems->where('uuid', $product->uuid)->first();
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
        return $item['uuid'] == $product->uuid;
      })
      ->values()
      ->all();

    $this->cart['quantity']--;
  }

  private function updateCartItem($cartItem)
  {
    $this->cart['items'] = collect($this->cart['items'])
      ->map(function ($item) use ($cartItem) {
        return $item['uuid'] == $cartItem['uuid'] ? $cartItem : $item;
      })
      ->values()
      ->all();
  }

  private function addItemToCart($product, $quantity)
  {
    $this->cart['items'][] = [
      'uuid' => $product->uuid,
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