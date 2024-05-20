@extends('app')
@section('content')
<div class="relative h-[calc(100%_-_40px)]">
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
</div>
@endsection