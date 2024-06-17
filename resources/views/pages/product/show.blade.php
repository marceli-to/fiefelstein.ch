@extends('app')
@section('content')
<div class="md:grid md:grid-cols-12 md:gap-x-16 mb-20 lg:mb-0 lg:mt-90">
  <div class="md:col-span-6 md:col-start-2 lg:col-span-6 lg:col-start-4">
    <h1 class="text-lg">
      {{ $product->group_title }}
    </h1>
  </div>
</div>
<div 
  class="relative pb-32 md:pb-0 lg:mt-30"
  x-data="{ shippingInfo: false }">
  <div 
    class="hidden lg:block absolute inset-0 z-20 m-32 left-[calc((100%_/_4))] top-0 w-[calc((100%/2)_-_64px)] h-[calc(100vh_-_249px)]"
    x-cloak
    x-show="shippingInfo">
    <div class="bg-flame font-europa-bold font-bold text-white text-lg w-full h-full p-32 relative">
      <a
        href="javascript:;"
        x-on:click="shippingInfo = !shippingInfo"
        class="absolute right-16 top-16"
        title="Versandinstruktionen verbergen">
        <x-icons.cross-large />
      </a>
      <x-product.shipping-instructions />
    </div>
  </div>
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
        <x-swiper.slide productUuid="{{ $product->uuid }}">
          @if ($card['type'] == 'Bild')
            <x-media.picture :image="$card['image']" :alt="$product->title" :lazy="false" />
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
            <x-swiper.slide productUuid="{{ $variation->uuid }}">
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

  <x-table.row class="mt-64 lg:hidden">
    <div>
      <span class="font-europa-bold font-bold">Versandinformationen</span>
      <x-product.shipping-instructions />
    </div>
  </x-table.row>

</div>
@endsection