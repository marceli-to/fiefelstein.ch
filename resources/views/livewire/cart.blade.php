<div 
  x-data="{ showCart: false, toggleCart() { this.showCart = !this.showCart; } }"
  @toggle-cart.window="toggleCart"
  @display-updated-cart.window="showCart = true"
  @hide-updated-cart.window="showCart = false"
  class="relative">
  @if (isset($cart['items']))
  <div 
    x-cloak 
    x-show="showCart" 
    class="fixed z-60 h-full w-full xs:max-w-[320px] bg-white top-0 right-0 px-16 xs:border-l xs:border-l-black">
    <div class="relative">
      <a 
        href="javascript:;"
        x-on:click="showCart = false">
        <x-icons.cross-small class="absolute top-145 right-0 xs:right-auto xs:top-20 xs:left-0 w-16 h-auto" />
      </a>
      <div class="pt-140 xs:pt-85 lg:pt-100">
        <h2 
          class="font-europa-bold font-bold mt-4"
          wire:loading.class="hidden" 
          wire:target="removeCartItem">
          Warenkorb
        </h2>
        <div 
          wire:loading 
          wire:target="removeCartItem" 
          class="fixed z-60 h-full w-full xs:max-w-[320px] bg-white">
          <h2 
            class="font-europa-bold font-bold">
            Aktualisiere Warenkorb...
          </h2>
        </div>
        <div class="w-full mt-36 space-y-32">
          @foreach($cart['items'] as $item)
          <div>
            <a 
              href="javascript:;" 
              wire:click="removeCartItem('{{ $item['uuid'] }}')" 
              class="hover:text-flame group relative" 
              title="Produkt entfernen">
              <x-icons.cross-small 
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-16 -mt-1 h-auto opacity-0 group-hover:opacity-100 bg-white" />
              <x-table.row class="font-europa-bold font-bold flex justify-between group-hover:border-flame">
                <span>{{ $item['title'] }}</span>
                <span>{{ $item['quantity'] }}</span>
              </x-table.row>
              <x-table.row class="border-b border-b-black flex justify-between group-hover:border-flame">
                <span>{{ $item['description'] }}</span>
                <span>{{ $item['price'] }}</span>
              </x-table.row>
            </a>
          </div>
          @endforeach
          <x-table.row class="font-europa-bold font-bold flex justify-between border-y border-y-black">
            <span>Total</span>
            <span>{{ number_format($cart['total'], 2, '.', '') }}</span>
          </x-table.row>
          <x-table.row class="border-none">
            <a 
              href="" 
              class="font-europa-bold font-bold min-h-32 w-full flex items-center leading-none space-x-6 hover:text-flame group-hover:text-flame border-y border-y-black hover:border-y-flame transition-all">
              <x-icons.chevron-right-tiny class="w-6 h-auto" />
              <span>Erwerben</span>
            </a>
          </x-table.row>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
