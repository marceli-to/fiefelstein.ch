@props(['value', 'label', 'active' => false])
<a 
  href="javascript:;" 
  class="flex items-center space-x-6"
  data-variation-btn="{{ $value }}">
  <span class="w-12 h-12 !outline-none appearance-none !bg-transparent !border-0 !ring-transparent focus:ring-offset-0 bg-[url(../icons/radio-unchecked.svg)] bg-[length:12px_12px] bg-no-repeat {{ $active ? 'bg-[url(../icons/radio-checked.svg)]' : '' }}"></span>
  <label>{{ $label }}</label>
  {{ $active }}
</a>
