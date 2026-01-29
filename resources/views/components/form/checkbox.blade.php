@props(
  [
    'name',
    'value',
    'label',
    'checked' => false,
    'data' => null,
    'iconClass' => ''
  ]
)
<div class="flex items-start space-x-14">
  <input
    type="checkbox"
    name="{{ $name }}"
    value="{{ $value }}"
    id="{{ $name }}"
    {{ $checked ? 'checked' : '' }}
    {{ $attributes->merge(['class' => $iconClass . ' w-10 h-10 mt-4 !outline-none appearance-none !bg-transparent !border-0 !ring-transparent focus:ring-offset-0 bg-radio-unchecked checked:bg-radio-checked bg-[length:10px_10px] bg-no-repeat']) }} />
  <label for="{{ $name }}" class="block -mt-1 hover:cursor-pointer select-none">
    {!! $label !!}
  </label>
</div>