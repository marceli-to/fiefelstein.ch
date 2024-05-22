<div>
  <a 
    href="javascript:;" 
    class="fixed top-20 right-16 inline-flex gap-x-10 z-[100]"
    x-on:click="$dispatch('toggle-cart')">
    @if ($cartItemCount > 0)
      <span class="inline-flex items-center justify-center w-20 h-20 text-xs font-bold leading-none text-white bg-flame rounded-full">
        {{ $cartItemCount }}
      </span>
      <x-icons.cart />
    @endif
  </a>
</div>