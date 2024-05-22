@props(['cart' => null])
<li class="font-europa-bold font-bold w-full flex justify-between border-y border-y-black py-4">
  <span>Total</span>
  <span>{{ number_format($cart['total'], 2, '.', '') }}</span>
</li>