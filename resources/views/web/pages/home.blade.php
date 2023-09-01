@extends('web.app')
@section('content')
<x-layout.section class="lg:col-span-6 lg:col-start-4">
  <x-layout.inner>
    <x-layout.grid>
      <x-layout.span class="mt-28 sm:mt-0 sm:order-1">
        <x-media.picture :image="'fiefelstein-palace'" alt="" />
      </x-layout.span>
      <x-layout.span class="bg-light-gray py-30 pl-34 sm:order-2">
        <p class="text-lg sm:text-xl leading-[1.34] sm:leading-[1.23]">Es wurde schon<br>alles gesagt,<br>nur nicht von allen.</p>
        <p class="text-sm leading-[1.85] sm:text-md sm:leading-[1.778]">Karl Valentin</p>
      </x-layout.span>
      <x-layout.span class="sm:order-4">
        <x-media.picture :image="'fiefelstein-alice'" alt="" />
      </x-layout.span>
      <x-layout.span class="bg-light-gray py-30 pl-34 sm:order-3">
        <p class="text-base sm:text-md leading-[1.34] mb-16">Fiefelstein entwirft,<br>interpretiert und vertreibt Dinge,<br>die man gebrauchen kann<br>oder haben will.</p>
        <p class="text-base sm:text-md leading-[1.34]">Ab 2024</p>
      </x-layout.span>
    </x-layout.grid>
  </x-layout.inner>
</x-layout.section>
@endsection