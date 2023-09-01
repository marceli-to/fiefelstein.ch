@props(['image', 'alt' => ''])
<picture class="w-full">
  <source media="(min-width: 768px)" srcset="/media/img/{{ $image }}.jpg">
  <source srcset="/media/img/{{ $image }}-sm.jpg">
  <img src="/media/img/{{ $image }}-sm.jpg" alt="{{ $alt }}" title="{{ $alt }}" height="1600" width="1050" class="w-full aspect-square">
</picture>