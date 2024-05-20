<div>
  <a 
    href="javascript:;" 
    class="relative inline-block"
    wire:click="toggleCart()">
    @if ($cartItemCount > 0)
      <span class="absolute top-0 right-0 inline-flex items-center justify-center w-20 h-20 text-xs font-bold leading-none text-white bg-red-500 rounded-full">
        {{ $cartItemCount }}
      </span>
    @endif
  </a>
</div>