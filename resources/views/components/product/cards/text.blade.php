@props(['text' => '', 'class' => ''])
<article class="{{ $class }}">
  {!! nl2br($text) !!}
</article>