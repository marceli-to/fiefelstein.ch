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
    class="js-swiper-prev h-full w-80 lg:w-160 pl-10 lg:pl-32 flex justify-start absolute z-90 top-1/2 -translate-y-1/2 left-0 {{ $type == 'landing' ? 'lg:left-[calc(16.666%_+_32px)]' : 'lg:left-[25%]' }}">
    <x-icons.chevron-left-medium class="w-11 h-auto block md:hidden" />
    <x-icons.chevron-left-large class="w-24 h-auto hidden md:block" />
  </a>
  <a 
    href="javascript:;" 
    class="js-swiper-next h-full w-80 lg:w-160 pr-16 lg:pr-32 flex justify-end absolute z-90 top-1/2 -translate-y-1/2 right-0 {{ $type == 'landing' ? 'lg:right-[calc(16.666%_+_32px)]' : 'lg:right-[25%]' }}">
    <x-icons.chevron-right-medium class="w-11 h-auto block md:hidden" />
    <x-icons.chevron-right-large class="w-24 h-auto hidden md:block" />
  </a>
</div>