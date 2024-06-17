<div class="md:grid md:grid-cols-12 gap-x-16">
  @foreach($cart['items'] as $item)
    <x-table.row class="md:col-span-9 font-europa-bold font-bold flex justify-between">
      <span>{{ $item['title'] }}</span>
    </x-table.row>
    <x-table.row class="md:col-span-3">
    </x-table.row>
    <x-table.row class="md:col-span-9 flex justify-between border-b border-b-black {{ !$loop->last ? 'mb-32' : '' }}">
      <span>{{ $item['description'] }}</span>
    </x-table.row>
    <x-table.row class="md:col-span-3 flex justify-between border-b border-b-black {{ !$loop->last ? 'mb-32' : '' }}">
      <span>CHF</span>
      <span>{{ $item['price'] }}</span>
    </x-table.row>
  @endforeach
</div>