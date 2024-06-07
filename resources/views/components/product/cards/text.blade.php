@props(['text' => ''])
<div {{ $attributes->merge(['class' => 'text-md p-32 bg-ivory']) }}>
  {{ $text }}
</div>