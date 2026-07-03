@props(['image' => null, 'text' => '', 'link' => null])
<a
  href="{{ $link ? url($link) : '#' }}"
  class="relative block">
  @if ($text)
    <h2 class="absolute w-[calc(100%_-_32px)] z-50 top-12 lg:top-70 left-16 lg:left-[calc((100vw/12)_-_2px)] text-lg">
      {!! nl2br(e($text)) !!}
    </h2>
  @endif
  @if ($image)
    <x-media.picture :image="$image" :alt="$text" />
  @endif
</a>
