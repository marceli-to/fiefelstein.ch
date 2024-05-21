<div 
  x-data="{ showCart: false, toggleCart() { this.showCart = !this.showCart; } }"
  @toggle-cart.window="toggleCart"
  @display-updated-cart.window="showCart = true"
  @hide-updated-cart.window="showCart = false"
  class="absolute">
  <div 
    x-cloak 
    x-show="showCart" 
    class="fixed z-50 h-full w-1/6 bg-white top-0 right-16 pt-120 px-16 border-l border-l-black">
    <h2>Warenkorb</h2>
    <ul>
      @if (isset($cart['items']))
        @foreach($cart['items'] as $item)
          <li>{{ $item['title'] }} - {{ $item['price'] }} - {{ $item['quantity'] }}</li>
        @endforeach
      @endif
    </ul>
    @if (isset($cart['total']))
      Total: {{ $cart['total'] }}
    @endif
  </div>
</div>
