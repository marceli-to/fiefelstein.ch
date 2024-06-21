@extends('app')
@section('content')
<x-layout.page-title>
  Zusammenfassung
</x-layout.page-title>
<div class="md:grid md:grid-cols-12 gap-x-16 lg:mt-30">
  <div class="hidden md:block md:col-span-2 md:col-start-2">
    <x-order.menu order_step="{{ $order_step }}" />
  </div>
  <div class="md:col-span-6 lg:col-span-5 xl:col-span-4">
    <x-table.row class="font-europa-bold font-bold">
      <span>Warenkorb</span>
    </x-table.row>
    @foreach ($cart['items'] as $item)
    <div class="mb-32 last-of-type:mb-0 divide-y divide-black border-t border-t-black mt-1">
      <div class="grid grid-cols-4">
        <x-table.row class="border-none col-span-4 md:col-span-3 flex justify-between">
          <span>{{ $item['title'] }}</span>
        </x-table.row>
        <x-table.row class="border-none col-span-4 md:col-span-1 flex justify-end">
          <span>{{ $item['quantity'] }}</span>
        </x-table.row>
      </div>
      <div class="grid grid-cols-4">
        <x-table.row class="border-none col-span-3 md:col-span-3">
          <span>{{ $item['description'] }}</span>
        </x-table.row>
        <x-table.row class="border-none col-span-1 flex justify-between 2xl:pl-16">
          <span>CHF</span>
          <span>{{ number_format($item['total'], 2, '.', '&thinsp;') }}</span>
        </x-table.row>
      </div>
      <div class="grid grid-cols-4 !border-b border-b-black">
        <x-table.row class="border-none col-span-3 md:col-span-3">
          <span>Verpackung und Versand</span>
        </x-table.row>
        <x-table.row class="border-none col-span-1 flex justify-between 2xl:pl-16">
          <span>CHF</span>
          <span>{{ number_format($item['total_shipping'], 2, '.', '&thinsp;') }}</span>
        </x-table.row>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection