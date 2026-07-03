@props(['product', 'category', 'lightbox' => false])
@php
  // Variations have no detail page of their own -> link to the main product.
  // For variations we append a #variation-<slug> hash (slug derived from the
  // variation title) so the detail page can preselect the variation (info
  // wrapper + swiper slide) on load.
  $detailSlug = $product->isVariation ? $product->product->slug : $product->slug;
  $detailUrl = route('product.show', ['product' => $detailSlug])
    . ($product->isVariation ? '#variation-' . \Illuminate\Support\Str::slug($product->title) : '');

  // In lightbox mode (Brocante) the image opens a Fancybox gallery instead of
  // linking to a detail page. The gallery = main image + all "Bild" cards.
  $galleryImages = [];
  if ($product->image) {
    $galleryImages[] = $product->image;
  }
  foreach (($product->cards ?? []) as $card) {
    if (($card['type'] ?? null) === 'Bild' && !empty($card['image'])) {
      $galleryImages[] = $card['image'];
    }
  }
  $galleryId = 'brocante-' . $product->uuid;
@endphp
<div class="md:col-span-4" data-product-category="{{ $category }}">
  @if ($lightbox)
    @if ($product->image)
      <a data-fancybox="{{ $galleryId }}" href="/img/large/{{ $product->image }}" class="block cursor-pointer !outline-none">
        <x-media.picture :image="$product->image" :alt="$product->title" />
      </a>
      {{-- Additional gallery images: hidden triggers, same gallery group --}}
      @foreach (array_slice($galleryImages, 1) as $galleryImage)
        <a data-fancybox="{{ $galleryId }}" href="/img/large/{{ $galleryImage }}" class="hidden" aria-hidden="true" tabindex="-1"></a>
      @endforeach
    @endif
  @else
    <a href="{{ $detailUrl }}">
      <x-media.picture :image="$product->image" :alt="$product->title" />
    </a>
  @endif
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

  @if ($product->state->value() == 'deliverable' || $product->state->value() == 'ready_for_pickup')
    <x-table.row class="italic border-b border-b-black">
      {{ $product->stock }} Stück {{ $product->state->label() }}
    </x-table.row>
    @if ($product->stock > 0)
      <livewire:cart-button :productUuid="$product->uuid" :key="$product->uuid" />
    @endif
  @else
    <x-table.row class="italic border-b border-b-black">
      {{ $product->stateText }}
    </x-table.row>
    <div class="mt-32">
      <livewire:product-notification :uuid="$product->uuid" :key="$product->uuid" />
    </div>
  @endif

</div>