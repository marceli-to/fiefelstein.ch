<div x-data="{ showCart: $wire.entangle('showCart') }">
<div 
  class="absolute z-50 h-[calc(100vh_-_150px)] w-1/6 bg-yellow-100 top-120 right-16 {{ isset($cart['quantity']) && $cart['quantity'] > 0 ? 'block' : 'hidden' }}"
  x-show="showCart">
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
