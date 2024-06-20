@extends('app')
@section('content')
<x-layout.page-title>
  Rechnungsadresse
</x-layout.page-title>
<div class="md:grid md:grid-cols-12 gap-x-16 lg:mt-30">
  <div class="hidden md:block md:col-span-2 md:col-start-2">
    <x-order.menu order_step="{{ $order_step }}" />
  </div>
  <div class="md:col-span-6 lg:col-span-5 xl:col-span-4">
    <form method="POST" action="{{ route('order.invoice-address-store') }}">
      @csrf
      <div class="space-y-1">
        <x-table.row>
          <x-form.input 
            name="salutation" 
            placeholder="Anrede" 
            value="{{ $cart['invoice_address']['salutation'] ?? old('salutation') }}" />
        </x-table.row>
        <x-table.row>
          <x-form.input 
            name="firstname" 
            placeholder="Vorname"
            required="true"
            value="{{ $cart['invoice_address']['firstname'] ?? old('firstname') }}" />
        </x-table.row>
        <x-table.row>
          <x-form.input 
            name="name" 
            placeholder="Nachname" 
            required="true"
            value="{{ $cart['invoice_address']['name'] ?? old('name') }}" />
        </x-table.row>
        <x-table.row>
          <x-form.input 
            name="company" 
            placeholder="Firma" 
            value="{{ $cart['invoice_address']['company'] ?? old('company') }}" />
        </x-table.row>
        <x-table.row>
          <x-form.input 
            name="street" 
            placeholder="Strasse" 
            required="true"
            value="{{ $cart['invoice_address']['street'] ?? old('street') }}" />
        </x-table.row>
        <x-table.row>
          <x-form.input 
            name="street_number" 
            placeholder="Hausnummer" 
            value="{{ $cart['invoice_address']['street_number'] ?? old('street_number') }}" />
        </x-table.row>
        <x-table.row>
          <x-form.input 
            name="zip" 
            placeholder="PLZ" 
            required="true"
            value="{{ $cart['invoice_address']['zip'] ?? old('zip') }}" />
        </x-table.row>
        <x-table.row>
          <x-form.input 
            name="city" 
            placeholder="Ort" 
            required="true"
            value="{{ $cart['invoice_address']['city'] ?? old('city') }}" />
        </x-table.row>
        <x-table.row>
          <x-form.select 
            name="country" 
            placeholder="Land" 
            required="true"
            :options="config('countries')"
            value="{{ $cart['invoice_address']['country'] ?? old('country') }}" />
        </x-table.row>
        <x-table.row class="border-b border-b-black">
          <x-form.input 
            name="email" 
            placeholder="E-Mail-Adresse" 
            required="true"
            value="{{ $cart['invoice_address']['email'] ?? old('email') }}" />
        </x-table.row>
      </div>

      <x-table.row class="border-none mt-32">
        <x-buttons.primary label="Lieferadresse" type="button" />
      </x-table.row>
    </form>
  </div>
</div>
@endsection