@extends('app')
@section('content')
<section class="pb-20">
  <div class="flex flex-col gap-y-16 md:hidden">
    @foreach ($cards as $card)
      @if ($card['type'] == 'product')
        <x-product.cards.teaser :product="$card['product']" />
      @else
        <x-product.cards.text :text="$card['text']" class="bg-white text-lg aspect-square flex items-center" />
      @endif
    @endforeach
  </div>

  <div class="hidden md:block lg:mt-20">
    <x-swiper.wrapper 
      type="landing"
      containerClass="js-swiper-landing"
      wrapperClass="swiper-landing">
      @foreach ($cards as $card)
        <x-swiper.slide>
          @if ($card['type'] == 'product')
            <x-product.cards.teaser :product="$card['product']" />
          @else
            <x-product.cards.text 
              :text="$card['text']" 
              class="bg-white border-r border-r-white text-lg aspect-square flex justify-center lg:justify-start items-center lg:items-start lg:absolute lg:top-70 left-16 lg:left-[calc((100vw/12)_-_2px)]" />
          @endif
        </x-swiper.slide>
      @endforeach
    </x-swiper.wrapper>
  </div>
</section>
@endsection