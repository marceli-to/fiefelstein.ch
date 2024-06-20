@extends('app')
@section('content')
@if ($errors->any())
  <x-form.errors>
    Bitte Zahlungsmethode auswählen.
  </x-form.errors>
@else
  <x-layout.page-title>
    Zahlung
  </x-layout.page-title>
@endif
<div class="md:grid md:grid-cols-12 gap-x-16 lg:mt-30">
  <div class="hidden md:block md:col-span-2 md:col-start-2">
    <x-order.menu order_step="{{ $order_step }}" />
  </div>
  <div class="md:col-span-6 lg:col-span-5 xl:col-span-4">
    <form method="POST" action="{{ route('order.payment-method-store') }}">
      @csrf
      <x-table.row class="border-b border-b-black min-h-34">
        <span>Zahlungsmittel</span>
      </x-table.row>
      <x-table.row class="!border-t-0 !min-h-64 flex items-center">
        <x-form.radio 
          name="payment_method" 
          value="twint" 
          checked="{{ isset($cart['payment_method']) && $cart['payment_method'] == 'twint' ? true : false  }}">
          <x-icons.twint />
        </x-form.radio>
      </x-table.row>
      <x-table.row class="!min-h-64 !mt-1 flex items-center">
        <x-form.radio 
          name="payment_method" 
          value="postfinance" 
          checked="{{ isset($cart['payment_method']) && $cart['payment_method'] == 'postfinance' ? true : false  }}">
          <x-icons.postfinance />
        </x-form.radio>
      </x-table.row>
      <x-table.row class="!min-h-64 !mt-2 flex items-center">
        <x-form.radio 
          name="payment_method" 
          value="mastercard" 
          checked="{{ isset($cart['payment_method']) && $cart['payment_method'] == 'mastercard' ? true : false  }}">
          <x-icons.mastercard />
        </x-form.radio>
      </x-table.row>
      <x-table.row class="!min-h-64 !mt-1 flex items-center">
        <x-form.radio 
          name="payment_method" 
          value="visa" 
          checked="{{ isset($cart['payment_method']) && $cart['payment_method'] == 'visa' ? true : false  }}">
          <x-icons.visa />
        </x-form.radio>
      </x-table.row>
      <x-table.row class="border-none">
        <x-buttons.primary label="Weiter" type="button" />
      </x-table.row>
    </form>
  </div>
</div>
@endsection