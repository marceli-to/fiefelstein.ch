@props([
  'containerClass' => '',
  'wrapperClass' => '',
])
<div class="swiper {{ $containerClass ?? '' }}">
  <div class="swiper-wrapper {{ $wrapperClass ?? '' }}">
    {{ $slot }}
  </div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>