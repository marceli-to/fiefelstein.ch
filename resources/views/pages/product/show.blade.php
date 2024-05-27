@extends('app')
@section('content')
{{-- 
@php
$product = collect([
  'id' => $id,
  'name' => 'Alice Beistelltisch',
  'price' => 299.99,
  'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim esse sit a ad mollitia nihil, consequatur ipsum est sapiente veniam incidunt consectetur dolores corrupti qui vitae ea ut illum veritatis.',
]);
@endphp

<div class="relative">

  <x-swiper.wrapper 
    containerClass="js-swiper-product"
    wrapperClass="swiper-product">
    <x-swiper.slide>
        <picture>
          <img src="/media/alice_01.jpg" alt="" height="1600" width="1600">
        </picture>
    </x-swiper.slide>
    <x-swiper.slide>
        <picture>
          <img src="/media/fisch_und_vogel_01.jpg" alt="" height="1600" width="1600">
        </picture>
    </x-swiper.slide>
    <x-swiper.slide>
      <div>
        <p class="text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim esse sit a ad mollitia nihil, consequatur ipsum est sapiente veniam incidunt consectetur dolores corrupti qui vitae ea ut illum veritatis.</p>
      </div>
    </x-swiper.slide>
    <x-swiper.slide>
        <picture>
          <img src="/media/palace_01.jpg" alt="" height="1600" width="1600">
        </picture>
    </x-swiper.slide>
    <x-swiper.slide>
        <picture>
          <img src="/media/palace_a_01.jpg" alt="" height="1600" width="1600">
        </picture>
    </x-swiper.slide>
    <x-swiper.slide>
        <picture>
          <img src="/media/shibuya_01.jpg" alt="" height="1600" width="1600">
        </picture>
    </x-swiper.slide>
  </x-swiper.wrapper>

  <div class="absolute bg-white h-full z-50 top-0 left-[calc((100%_/_12)_-_16px)] w-[calc((100%/6)+5px)] pl-16">
    <div>
      <div class="min-h-32 flex items-center border-t border-t-black">Alice</div>
      <div class="min-h-32 flex items-center border-t border-t-black">Beistelltisch</div>
      <div class="min-h-32 flex items-center border-t border-t-black">Esche natur</div>
      <div class="min-h-32 flex items-center border-t border-t-black w-full">
        <livewire:cart-button :productId="$product['id']" :key="$product['id']" />
      </div>
    </div>
  </div>
</div> --}}

@endsection