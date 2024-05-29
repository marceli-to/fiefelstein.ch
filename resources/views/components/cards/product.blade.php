@props(['product' => ''])
<a 
  href="{{ route('page.product.show', ['product' => $product->slug]) }}"
  title="{{ $product->title }}">
  <figure>
    <picture>
      <source media="(min-width: 1280px)" srcset="/img/large/{{ $product->image}}">
      <source media="(min-width: 768px)" srcset="/img/medium/{{ $product->image }}">
      <img 
        src="/img/small/{{ $product->image}}" 
        width="900" 
        height="900" 
        alt="{{ $product->title }}"
        class="w-full h-auto object-cover"
        loading="lazy">
    </picture>
  </figure>
</a>