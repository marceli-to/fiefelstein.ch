@props(['value', 'label', 'active' => false])
<a 
  href="javascript:;" 
  class="flex items-center space-x-6 group"
  data-variation-btn="{{ $value }}">
  <span class="w-12 h-12 !outline-none appearance-none !bg-transparent !border-0 !ring-transparent focus:ring-offset-0 {{ $active ? 'bg-radio-checked' : 'bg-radio-unchecked' }} group-hover:bg-radio-checked bg-[length:12px_12px] bg-no-repeat"></span>
  <label>{{ $label }}</label>
</a>
