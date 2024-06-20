@extends('app')
@section('content')
<x-layout.page-title>
  Warenkorb
</x-layout.page-title>
<div class="md:grid md:grid-cols-12 gap-x-16 lg:mt-30">
  <div class="hidden md:block md:col-span-2 md:col-start-2">
    <x-order.menu order_step="{{ $order_step }}" />
  </div>
  <div class="md:col-span-6 lg:col-span-5 xl:col-span-4">
    @empty ($cart['items'])
      <p>Ihr Warenkorb ist leer.</p>
    @else
      @foreach($cart['items'] as $item)
        <livewire:cart-item :uuid="$item['uuid']" :key="$item['uuid']" />
      @endforeach
      {{-- <livewire:cart-total /> --}}

      <x-table.row class="border-none">
        <x-buttons.primary route="{{ route('order.invoice-address') }}" label="Rechnungsadresse" />
      </x-table.row>
    @endempty
  </div>

</div>
@endsection