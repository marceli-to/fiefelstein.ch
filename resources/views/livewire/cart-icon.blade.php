<div>
  <a 
    href="javascript:;" 
    class="fixed top-20 right-16 inline-block z-[100]"
    x-on:click="$dispatch('toggle-cart')">
    @if ($cartItemCount > 0)
      <span class="absolute top-0 right-0 inline-flex items-center justify-center w-20 h-20 text-xs font-bold leading-none text-white bg-red-500 rounded-full">
        {{ $cartItemCount }}
      </span>
    @endif
  </a>
</div>