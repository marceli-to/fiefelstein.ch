@extends('app')
@section('content')


<div class="relative mt-160">

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

  <div class="absolute bg-white h-full z-30 top-0 left-[calc((100%_/_12)_-_16px)] w-[calc((100%/6)+5px)] pl-16">
    <div>
      <x-table.row class="font-europa-bold font-bold">
        {{ $product->title }}
      </x-table.row>
      @foreach($product->attributes as $attribute)
        <x-table.row>
          {{ $attribute }}
        </x-table.row>
      @endforeach
      <livewire:cart-button :productId="$product->id" :key="$product->id" />
    </div>
  </div>
</div>

@endsection