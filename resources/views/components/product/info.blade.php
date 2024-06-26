@props(['product', 'parent' => null])
<div 
  {{ $attributes->merge(['class' => 'bg-white w-full mt-32 md:mt-0 lg:pl-16 md:absolute md:h-full md:z-30 md:top-0 lg:left-[calc((100%_/_12)_-_15px)] md:w-[calc((100%/6)_+_19px)]']) }}
  data-variation-wrapper="{{ $product->uuid }}">
  <div class="md:pr-16">
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

    <x-table.row class="italic border-b border-b-black">
      {{ $product->stock }} Stück abholbereit
    </x-table.row>

    @if ($parent && $parent->variations && $parent->variations->count() > 0)

      <div class="mt-32">
        <x-table.row>
          <x-product.buttons.switcher :value="$parent->uuid" :label="$parent->title" />
        </x-table.row>
        @foreach($parent->variations as $variation)
          <x-table.row class="{{ $loop->last ? 'border-b border-b-black' : ''}} {{ $variation->uuid == $product->uuid ? 'font-europa-bold font-bold' : ''}}">
            <x-product.buttons.switcher :value="$variation->uuid" :label="$variation->title" :active="$product->uuid == $variation->uuid ? true : false" />
          </x-table.row>
        @endforeach
      </div>

    @elseif ($product->variations && $product->variations->count() > 0)
      
      <div class="mt-32">
        <x-table.row class="font-europa-bold font-bold">
          <x-product.buttons.switcher :value="$product->uuid" :label="$product->title" :active="true" />
        </x-table.row>
        @foreach($product->variations as $variation)
          <x-table.row class="{{ $loop->last ? 'border-b border-b-black' : ''}}">
            <x-product.buttons.switcher :value="$variation->uuid" :label="$variation->title" />
          </x-table.row>
        @endforeach
      </div>

    @endif
    
    @if ($product->stock > 0)
      <livewire:cart-button :productUuid="$product->uuid" :key="$product->uuid" />
    @endif

    <x-table.row class="hidden lg:flex mt-64 border-none">
      <a 
        href="javascript:;" 
        :class="{ '!border-y-flame !text-flame': shippingInfo }"
        x-on:click="shippingInfo = !shippingInfo"
        class="min-h-32 w-full flex items-center leading-none space-x-6 hover:text-flame group-hover:text-flame border-y border-y-black hover:border-y-flame transition-all"
        title="Versandinstruktionen anzeigen">
        <x-icons.chevron-right-tiny class="w-6 h-auto" />
        <span>Versandinformationen</span>
      </a>
    </x-table.row>
  </div>
</div>