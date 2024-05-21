<a 
  href="javascript:;"
  x-on:click="menu = ! menu"
  class="block mt-60 w-25 h-25">
  <span x-show="menu === false">
    <x-icons.burger />
  </span>
  <span x-cloak x-show="menu === true">
    <x-icons.cross-large />
  </span>
</a>