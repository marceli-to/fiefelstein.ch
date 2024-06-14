@extends('app')
@section('content')
<div class="md:grid md:grid-cols-12 md:gap-x-16 mb-20 lg:mb-0 lg:mt-90">
  <div class="md:col-span-6 md:col-start-2 lg:col-span-6 lg:col-start-4">
    <h1 class="text-lg">
      {{ $product->title }}
    </h1>
  </div>
</div>
<div class="relative pb-32 md:pb-0 lg:mt-30">
  <x-swiper.wrapper 
    type="product"
    containerClass="js-swiper-product" 
    wrapperClass="swiper-product">
    @if ($product->image)
      <x-swiper.slide productUuid="{{ $product->uuid }}">
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
            <x-swiper.slide productUuid="{{ $loop->first ? $variation->uuid : '' }}">
              @if ($card['type'] == 'Bild')
                <x-media.picture :image="$card['image']" :alt="$product->title" :lazy="false" />
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