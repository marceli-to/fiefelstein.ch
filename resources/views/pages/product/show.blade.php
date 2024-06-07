@extends('app')
@section('content')
<div class="relative pb-32 md:pb-0 lg:mt-160">

  <x-swiper.wrapper containerClass="js-swiper-product" wrapperClass="swiper-product">
    @if ($product->image)
      <x-swiper.slide>
        <x-media.picture :image="$product->image" :alt="$product->title" />
      </x-swiper.slide>
    @endif
    @if ($product->cards)
      @foreach($product->cards as $card)
        <x-swiper.slide>
          @if ($card['type'] == 'Bild')
            <x-media.picture :image="$card['image']" :alt="$product->title" />
          @endif
          @if ($card['type'] == 'Text')
            <x-product.cards.text :text="$card['text']" />
          @endif
        </x-swiper.slide>
      @endforeach
    @endif
    @if ($product->variations->count() > 0)
      @foreach($product->variations as $variation)
        @if ($variation->cards)
          @foreach($variation->cards as $card)
            <x-swiper.slide>
              @if ($card['type'] == 'Bild')
                <x-media.picture :image="$card['image']" :alt="$product->title" />
              @endif
              @if ($card['type'] == 'Text')
                <x-product.cards.text :text="$card['text']" />
              @endif
            </x-swiper.slide>
          @endforeach
        @endif
      @endforeach
    @endif
  </x-swiper.wrapper>

  <x-product.info :product="$product" />

  @if ($product->variations->count() > 0)
    @foreach($product->variations as $variation)
      <x-product.info :product="$variation" :parent="$product" isVariation="true" class="hidden" />
    @endforeach
  @endif

</div>
@endsection