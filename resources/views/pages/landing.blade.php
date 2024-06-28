@extends('app')
@section('content')
<section class="pb-20">
  <div class="flex flex-col gap-y-16 lg:hidden">
    @foreach ($cards as $card)
      @if ($card['type'] == 'product')
        <x-product.cards.teaser :product="$card['product']" />
      @else
        <x-product.cards.text :text="$card['text']" />
      @endif
    @endforeach
  </div>

  <div class="hidden lg:block lg:mt-20">
    <x-swiper.wrapper 
      type="landing"
      containerClass="js-swiper-landing"
      wrapperClass="swiper-landing">
      @foreach ($cards as $card)
        <x-swiper.slide>
          @if ($card['type'] == 'product')
            <x-product.cards.teaser :product="$card['product']" />
          @else
            <x-product.cards.text :text="$card['text']" />
          @endif
        </x-swiper.slide>
      @endforeach
    </x-swiper.wrapper>
  </div>
</section>
@endsection