@props(['product'])
@if ($product)
<a 
  href="{{ route('product.show', ['product' => $product->slug]) }}"
  title="{{ $product->title }}"
  class="relative">
  <h2 class="absolute top-12 lg:top-70 left-16 lg:left-[calc((100vw/12)_-_2px)] text-lg">
    {{ $product->title }}
  </h2>
  <x-media.picture :image="$product->image" :alt="$product->title" />
</a>
@endif