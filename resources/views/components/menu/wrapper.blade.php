<div
  x-cloak 
  x-show="menu"
  x-transition:enter="transition ease-in duration-100"
  x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100"
  x-transition:leave="transition ease-in duration-0"
  x-transition:leave-start="opacity-100"
  x-transition:leave-end="opacity-0"
  class="fixed left-0 top-145 lg:top-0 bg-white bg-opacity-95 w-full h-[calc(100vh_-_145px)] lg:h-full z-50">
  <div class="px-16 lg:grid lg:grid-cols-12 lg:gap-x-16">
    <ul class="text-lg -mt-10 lg:mt-90 lg:col-span-5 lg:col-start-3">
      <li>Produkte</li>
      @if ($menuItems)
        @foreach ($menuItems as $item)
          <li>
            <x-menu.item :title="$item['title']" :url="$item['url']" :current="$item['current']" class="font-europa-light font-light" />
          </li>
        @endforeach
      @endif
      <li class="my-12">
        <x-menu.item title="Brocante" :url="route('page.brocante')" :current="request()->routeIs('page.brocante')" />
      </li>
      <li class="my-12">
        <x-menu.item title="Boutique" :url="route('page.product.listing')" :current="request()->routeIs('page.product.listing')" />
      </li>
      <li class="my-12">
        <x-menu.item title="Idee" :url="route('page.idea')" :current="request()->routeIs('page.idea')" />
      </li>
      <li class="my-12">
        <x-menu.item title="Kontakt" :url="route('page.contact')" :current="request()->routeIs('page.contact')" />
      </li>
    </ul>
  </div>
</div>