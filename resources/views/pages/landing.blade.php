@extends('app')
@section('content')
<section class="pb-20">
  <div class="flex flex-col gap-y-16 lg:hidden">
    @foreach ($products as $product)
      <x-product.cards.teaser :product="$product" />
    @endforeach
  </div>

  <div class="hidden lg:block lg:mt-20">
    <x-swiper.wrapper 
      containerClass="js-swiper-landing"
      wrapperClass="swiper-landing">
      @foreach ($products as $product)
        <x-swiper.slide>
          <x-product.cards.teaser :product="$product" />
        </x-swiper.slide>
      @endforeach
    </x-swiper.wrapper>
  </div>
</section>
@endsection