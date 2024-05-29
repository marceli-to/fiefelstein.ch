<div 
  x-data="{ showCart: false, toggleCart() { this.showCart = !this.showCart; } }"
  @toggle-cart.window="toggleCart"
  @display-updated-cart.window="showCart = true"
  @hide-updated-cart.window="showCart = false"
  class="relative">
  <div 
    x-cloak 
    x-show="showCart" 
    class="fixed z-60 h-full w-full xs:max-w-[320px] bg-white top-0 right-0 pt-80 px-16 xs:border-l xs:border-l-black">
    <h2>Warenkorb</h2>
    <div class="w-full mt-40">
      @if (isset($cart['items']))
        @foreach($cart['items'] as $item)
          <a href="javascript:;" wire:click="removeCartItem({{ $item['product_id'] }})" class="hover:text-flame group relative" title="Produkt entfernen">
            <x-icons.cross-small 
              class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-16 h-auto opacity-0 group-hover:opacity-100 bg-white" />
            <x-table.row class="font-europa-bold font-bold flex justify-between group-hover:border-flame transition-all">
              <span>{{ $item['title'] }}</span>
              <span>{{ $item['quantity'] }}</span>
            </x-table.row>
            <x-table.row class="border-b border-b-black flex justify-between mb-32 group-hover:border-flame transition-all">
              <span>{{ $item['description'] }}</span>
              <span>{{ $item['price'] }}</span>
            </x-table.row>
          </a>
        @endforeach
      @endif
      @if (isset($cart['total']))
        <x-table.row class="font-europa-bold font-bold flex justify-between border-y border-y-black">
          <span>Total</span>
          <span>{{ number_format($cart['total'], 2, '.', '') }}</span>
        </x-table.row>
      @endif
    </div>
  </div>
</div>
