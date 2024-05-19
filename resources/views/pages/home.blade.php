@extends('app')
@section('content')
<div class="relative h-[calc(100%_-_40px)]">

  <h1 class="font-europa-regular text-xl">Test</h1>

  <x-swiper.wrapper>
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

  <div class="absolute bg-white bg-red-50 h-full z-50 top-0 left-[calc((100%_/_12)_-_16px)] w-[calc((100%/6)+5px)] pl-16">
    <div>
      <div class="min-h-32 flex items-center border-t border-t-black">Alice</div>
      <div class="min-h-32 flex items-center border-t border-t-black">Beistelltisch</div>
      <div class="min-h-32 flex items-center border-t border-t-black">Esche natur</div>
    </div>
  </div>
</div>
@endsection