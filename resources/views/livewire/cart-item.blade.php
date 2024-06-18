<div>
  <div class="grid grid-cols-12 border-b border-b-black">
    <x-table.row class="col-span-12 md:col-span-9 font-europa-bold font-bold flex justify-between">
      <span>{{ $product['title'] }}</span>
    </x-table.row>
    <x-table.row class="col-span-12 md:col-span-3">
      <span>[buttons]</span>
    </x-table.row>
  </div>
  <div class="grid grid-cols-12 mt-32 border-b border-b-black">
    <x-table.row class="col-span-9">
      <span>{{ $product['description'] }}</span>
    </x-table.row>
    <x-table.row class="col-span-3 flex justify-between 2xl:pl-16">
      <span>CHF</span>
      <span>{{ $product['price'] }}</span>
    </x-table.row>
  </div>
</div>