@props(
  [
    'type' => 'text', 
    'placeholder' => '', 
    'value' => '',
    'name' => '',
    'required' => false
  ]
)
<input
  type="{{ $type }}"
  name="{{ $name }}"
  placeholder="{{ $placeholder }}{{ $required ? ' *' : '' }}"
  @if($value) value="{{ $value }}" @endif
  {{ $attributes->merge(['class' => 'text-sm color-black placeholder:text-black w-full border-none !ring-0 p-0' . ($errors->has($name) ? ' text-flame placeholder:text-flame' : '')]) }}>

