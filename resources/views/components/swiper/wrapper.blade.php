@props([
  'type' => 'product',
  'containerClass' => '',
  'wrapperClass' => '',
])
<div class="swiper {{ $containerClass ?? '' }}">
  <div class="swiper-wrapper {{ $wrapperClass ?? '' }}">
    {{ $slot }}
  </div>
  <a 
    href="javascript:;" 
    class="js-swiper-prev absolute z-90 top-1/2 -translate-y-1/2 left-10 {{ $type == 'landing' ? 'lg:left-[calc(16.666%_+_32px)]' : 'lg:left-[calc(25%_+_32px)]' }}">
    <x-icons.chevron-left-medium class="w-11 h-auto block md:hidden" />
    <x-icons.chevron-left-large class="w-24 h-auto hidden md:block" />
  </a>
  <a 
    href="javascript:;" 
    class="js-swiper-next absolute z-90 top-1/2 -translate-y-1/2 right-16 {{ $type == 'landing' ? 'lg:right-[calc(16.666%_+_32px)]' : 'lg:right-[calc(25%_+_32px)]' }}">
    <x-icons.chevron-right-medium class="w-11 h-auto block md:hidden" />
    <x-icons.chevron-right-large class="w-24 h-auto hidden md:block" />
  </a>
</div>