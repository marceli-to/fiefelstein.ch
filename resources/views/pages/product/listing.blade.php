@extends('app')
@section('content')
<div class="md:grid md:grid-cols-12 md:gap-x-16 mb-20 lg:mb-0 lg:mt-90 relative">
  <div class="md:col-span-6 md:col-start-3 lg:col-span-6 lg:col-start-4">
    <h1 class="text-lg">
      Boutique:
    </h1>
  </div>
</div>
<div class="md:grid md:grid-cols-12 md:gap-x-16 mb-20 lg:mb-0 lg:mt-30 relative">
  <div class="md:col-span-full lg:col-span-6 lg:col-start-4 md:pb-64">
    <div class="md:grid md:grid-cols-12 md:gap-x-16 md:gap-y-64">
      @foreach($products as $product)
        <x-product.cards.boutique :product="$product" />
        @if ($product->variations->count() > 0)
          @foreach($product->variations as $variation)
            <x-product.cards.boutique :product="$variation" />
          @endforeach
        @endif
      @endforeach
    </div>
  </div>
</div>
@endsection