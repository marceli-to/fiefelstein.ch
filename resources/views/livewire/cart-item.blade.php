<div class="mb-32 last-of-type:mb-0 divide-y divide-black border-t border-t-black">
  <div class="grid grid-cols-4 border-b border-b-black">
    <x-table.row class="border-none col-span-4 md:col-span-3 font-europa-bold font-bold flex justify-between">
      <span>{{ $item['title'] }}</span>
    </x-table.row>
    <x-table.row class="border-none col-span-4 md:col-span-1 2xl:pl-16">
      <div class="w-full max-w-[50%] md:max-w-none mx-auto flex items-center justify-between min-h-32">
        <button 
          wire:click="decrement()" 
          class="w-full min-h-30 text-center flex items-center justify-start leading-none">
          <x-icons.minus />
        </button>
        <input 
          value="{{ $quantity }}"
          wire:model="quantity"
          wire:change="change()"
          type="number" 
          class="w-48 min-h-30 p-0 text-sm text-center border-none appearance-none focus:outline-none focus:border-none outline-none !ring-0 !shadow-none" 
          min="1">
        <button 
          wire:click="increment()" 
          class="w-full min-h-30 text-center flex items-center justify-end leading-none">
          <x-icons.plus />
        </button>
      </div>
    </x-table.row>
  </div>
  <div class="grid grid-cols-4 mt-32">
    <x-table.row class="border-none col-span-3 md:col-span-3">
      <span>{{ $item['description'] }}</span>
    </x-table.row>
    <x-table.row class="border-none col-span-1 flex justify-between 2xl:pl-16">
      <span>CHF</span>
      <span>{{ number_format($total, 2, '.', '&thinsp;') }}</span>
    </x-table.row>
  </div>
  <div class="grid grid-cols-4 !border-b border-b-black">
    <x-table.row class="border-none col-span-3 md:col-span-3">
      <span>Verpackung und Versand</span>
    </x-table.row>
    <x-table.row class="border-none col-span-1 flex justify-between 2xl:pl-16">
      <span>CHF</span>
      <span>{{ number_format($shipping, 2, '.', '&thinsp;') }}</span>
    </x-table.row>
  </div>
</div>