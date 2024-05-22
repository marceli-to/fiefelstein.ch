@props(['item' => null])
<li class="font-europa-bold font-bold w-full flex justify-between border-y border-y-black py-4">
  <span>{{ $item['title'] }}</span>
  <span>{{ $item['quantity'] }}</span>
</li>
<li class="w-full flex justify-between border-b border-b-black mb-32 py-4">
  <span>{{ $item['description'] }}</span>
  <span>{{ $item['price'] }}</span>
</li>