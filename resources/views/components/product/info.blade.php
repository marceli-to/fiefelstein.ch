@props(['product', 'parent' => null, 'isVariation' => false])
<div 
  {{ $attributes->merge(['class' => 'bg-white w-full mt-32 md:mt-0 lg:pl-16 md:absolute md:h-full md:z-30 md:top-0 lg:left-[calc((100%_/_12)_-_16px)] md:w-[calc((100%/6)+5px)]']) }}
  data-variation-wrapper="{{ $product->uuid }}">
  <div>
    <x-table.row class="font-europa-bold font-bold">
      {{ $product->title }}
    </x-table.row>
    <x-table.row>
      {{ $product->description }}
    </x-table.row>

    @foreach($product->attributes as $attribute)
      <x-table.row>
        {{ $attribute }}
      </x-table.row>
    @endforeach

    <x-table.row>
      CHF {{ $product->price }}
    </x-table.row>

    <x-table.row class="italic">
      {{ $product->quantity }} Stück abholbereit
    </x-table.row>

    @if ($parent && $parent->variations && $parent->variations->count() > 0)

      <div class="mt-32">
        <x-table.row>
          <x-product.buttons.switcher :product="$parent" />
        </x-table.row>
        @foreach($parent->variations as $variation)
          <x-table.row class="{{ $loop->last ? 'border-b border-b-black' : ''}} {{ $variation->uuid == $product->uuid ? 'font-europa-bold font-bold' : ''}}">
            <x-product.buttons.switcher :product="$variation" />
          </x-table.row>
        @endforeach
      </div>

    @elseif ($product->variations && $product->variations->count() > 0)
      
      <div class="mt-32">
        <x-table.row class="font-europa-bold font-bold">
          <x-product.buttons.switcher :product="$product" />
        </x-table.row>
        @foreach($product->variations as $variation)
          <x-table.row class="{{ $loop->last ? 'border-b border-b-black' : ''}}">
            <x-product.buttons.switcher :product="$variation" />
          </x-table.row>
        @endforeach
      </div>

    @endif

    <livewire:cart-button :productUuid="$product->uuid" :key="$product->uuid" :isVariation="$isVariation" />
  </div>
</div>