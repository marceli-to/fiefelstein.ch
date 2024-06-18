<div class="flex flex-col">
  <div class="w-full flex justify-between">
    <x-table.row class="font-europa-bold font-bold flex justify-between">
      <span>{{ $product['title'] }}</span>
    </x-table.row>
    <x-table.row class="md:col-span-1">
    </x-table.row>
  </div>
  <div class="w-full flex justify-between">
    <x-table.row class="md:col-span-3 flex justify-between border-b border-b-black">
      <span>{{ $product['description'] }}</span>
    </x-table.row>
    <x-table.row class="md:col-span-1 flex justify-between border-b border-b-black">
      <span>CHF</span>
      <span>{{ $product['price'] }}</span>
    </x-table.row>
  </div>
</div>