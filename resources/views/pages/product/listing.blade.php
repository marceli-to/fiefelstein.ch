@extends('app')
@section('content')
<div class="md:grid md:grid-cols-12 md:gap-x-16 mb-20 lg:mb-0 lg:mt-90 relative">
  <div class="md:col-span-full lg:col-span-6 lg:col-start-4">
    <h1 class="text-lg sm:flex">
      Boutique<span class="hidden sm:inline">:</span>
      <x-product.filters.boutique :categories="$categories" />
    </h1>
  </div>
</div>
<div class="md:grid md:grid-cols-12 md:gap-x-16 lg:mb-0 lg:mt-30 relative">
  <div class="md:col-span-full lg:col-span-6 lg:col-start-4 md:pb-64">
    <div class="md:grid md:grid-cols-12 md:gap-x-16 md:gap-y-64 space-y-32 md:space-y-0">
      @foreach($products as $product)
        <x-product.cards.boutique :product="$product" :category="$product->product_category_id" />
        @if ($product->variations->count() > 0)
          @foreach($product->variations as $variation)
            <x-product.cards.boutique :product="$variation" :category="$product->product_category_id" />
          @endforeach
        @endif
      @endforeach
    </div>
  </div>
</div>
@endsection