<div class="w-full" x-data="{ quantity: {{ $itemsInCart }} }">
  <div class="flex items-center justify-between">
      <button x-on:click="quantity > 1 ? quantity-- : null" class="px-2 py-1 w-20">
        -
      </button>
      <input 
        x-model="quantity" 
        type="number" 
        class="w-48 px-2 py-1 text-center border-gray-300 border-l border-r" 
        min="1">
      <button x-on:click="quantity++" class="px-2 py-1 w-20">
        +
      </button>
  </div>
  <button wire:click="addToCart(quantity)" class="px-4 py-2 mt-2 font-bold text-white w-full bg-black">
    Add to Cart
  </button>
</div>