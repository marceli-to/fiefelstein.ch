@props(['product' => ''])
<a 
  href="{{ route('page.product.show', ['product' => $product->slug]) }}"
  title="{{ $product->title }}">
  <x-media.picture :image="$product->image" :alt="$product->title" />
</a>