@props(['product', 'category'])
<div class="md:col-span-4" data-product-category="{{ $category }}">
  <x-media.picture :image="$product->image" :alt="$product->title" />
  <x-table.row class="mt-32">
    <h3>{{ $product->title }}</h3>
  </x-table.row>
  <x-table.row>
    {{ $product->description }}
  </x-table.row>
  @foreach($product->attributes as $attribute)
    @if ($attribute)
      <x-table.row>
        {{ $attribute }}
      </x-table.row>
    @endif
  @endforeach
  <x-table.row>
    CHF {{ $product->price }}
  </x-table.row>
  <x-table.row class="italic border-b border-b-black">
    {{ $product->stock }} Stück abholbereit
  </x-table.row>
  @if ($product->stock > 0)
    <livewire:cart-button :productUuid="$product->uuid" :key="$product->uuid" />
  @endif
</div>