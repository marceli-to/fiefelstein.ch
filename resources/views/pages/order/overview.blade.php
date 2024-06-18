@extends('app')
@section('content')
<x-layout.page-title>
  Warenkorb
</x-layout.page-title>
<div class="md:grid md:grid-cols-12 gap-x-16 lg:mt-30">
  <div class="hidden md:block md:col-span-2 md:col-start-2">
    [Basket Nav]
  </div>
  <div class="md:col-span-4 bg-yellow-100">
    @foreach($cart['items'] as $item)
      <livewire:cart-item :productUuid="$item['uuid']" :key="$item['uuid']" />
    @endforeach
    {{-- <livewire:cart-total /> --}}
  </div>
</div>
@endsection