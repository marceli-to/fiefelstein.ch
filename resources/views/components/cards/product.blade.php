@props(['product' => ''])
<a 
  href="{{ route('page.product.show', ['slug' => Str::slug($product->title), 'id' => $product->id]) }}"
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