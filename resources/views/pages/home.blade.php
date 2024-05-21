@extends('app')
@section('content')
<section class="pb-20">
  <div class="flex flex-col gap-y-16 md:hidden">
    <x-cards.product.image image="/media/alice_01.jpg" />
    <x-cards.product.image image="/media/fisch_und_vogel_01.jpg" />
    <x-cards.product.text text="Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim esse sit a ad mollitia nihil, consequatur ipsum est sapiente veniam incidunt consectetur dolores corrupti qui vitae ea ut illum veritatis." />
    <x-cards.product.image image="/media/palace_a_01.jpg" />
    <x-cards.product.image image="/media/shibuya_01.jpg" />
  </div>
  <div class="hidden md:block">
    <x-swiper.wrapper 
      containerClass="js-swiper-landing"
      wrapperClass="swiper-landing">
      <x-swiper.slide>
        <x-cards.product.image image="/media/alice_01.jpg" />
      </x-swiper.slide>
      <x-swiper.slide>
        <x-cards.product.image image="/media/fisch_und_vogel_01.jpg" />
      </x-swiper.slide>
      <x-swiper.slide>
        <x-cards.product.text text="Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim esse sit a ad mollitia nihil, consequatur ipsum est sapiente veniam incidunt consectetur dolores corrupti qui vitae ea ut illum veritatis." />
      </x-swiper.slide>
      <x-swiper.slide>
        <x-cards.product.image image="/media/palace_a_01.jpg" />
      </x-swiper.slide>
      <x-swiper.slide>
        <x-cards.product.image image="/media/shibuya_01.jpg" />
      </x-swiper.slide>
      <x-swiper.slide>
        <x-cards.product.image image="/media/alice_01.jpg" />
      </x-swiper.slide>
    </x-swiper.wrapper>
  </div>
</section>

@endsection