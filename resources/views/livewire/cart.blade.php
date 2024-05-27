<div 
  x-data="{ showCart: false, toggleCart() { this.showCart = !this.showCart; } }"
  @toggle-cart.window="toggleCart"
  @display-updated-cart.window="showCart = true"
  @hide-updated-cart.window="showCart = false"
  class="relative">
  <div 
    x-cloak 
    x-show="showCart" 
    class="fixed z-60 h-full w-full lg:w-1/6 bg-white top-0 right-0 pt-80 px-16 border-l border-l-black">
    <h2>Warenkorb</h2>
    <ul class="w-full mt-40">
      @if (isset($cart['items']))
        @foreach($cart['items'] as $item)
          <x-cart.item :item="$item" />
        @endforeach
      @endif
      @if (isset($cart['total']))
        <x-cart.total :cart="$cart" />
      @endif
    </ul>
  </div>
</div>
