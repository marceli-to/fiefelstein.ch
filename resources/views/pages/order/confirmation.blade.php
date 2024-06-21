@extends('app')
@section('content')
<x-layout.page-title>
  Herzlichen Dank für Deine Bestellung
</x-layout.page-title>
<div class="md:grid md:grid-cols-12 gap-x-16 lg:mt-30 pb-20 lg:pb-40">
  <div class="hidden md:block md:col-span-2 md:col-start-2">
    <x-order.menu />
  </div>
  <div class="md:col-span-6 lg:col-span-5 xl:col-span-4">

  </div>
</div>
@endsection