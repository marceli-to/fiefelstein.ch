<x-mail::message>
  <div class="main text-base">
    <h1>Herzlichen Dank für Deine Bestellung</h1>
    <div class="table">
      <table cellpadding="0" cellspacing="0">
        @foreach($data->products as $product)
          <tr>
            <td colspan="2">{{ $product->title }}</td>
            <td class="quantity">{{ $product->quantity }}</td>
          </tr>
          <tr>
            <td>{{ $product->description }}</td>
            <td class="currency">CHF</td>
            <td class="amount text-right">{{ $product->price }}</td>
          </tr>
          <tr>
            <td>Verpackung und Versand</td>
            <td class="currency">CHF</td>
            <td class="amount text-right">
              {!! number_format($product->shipping, 2, '.', '&thinsp;') !!}
            </td>
          </tr>
          <tr>
            <td>Total</td>
            <td class="currency">CHF</td>
            <td class="amount text-right">
              {!! number_format($product->price + $product->shipping, 2, '.', '&thinsp;') !!}
            </td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
        @endforeach
        <tr>
          <td colspan="3">Lieferadresse</td>
        </tr>
        @if ($data->use_invoice_address)
          @if ($data->salutation)
            <tr>
              <td colspan="3">{{ $data->salutation }}</td>
            </tr>
          @endif
          <tr>
            <td colspan="3">{{ $data->invoice_name }}</td>
          </tr>
          <tr>
            <td colspan="3">{{ $data->invoice_address }}</td>
          </tr>
          <tr>
            <td colspan="3">{{ $data->invoice_location }}</td>
          </tr>
          <tr>
            <td colspan="3">{{ $data->country }}</td>
          </tr>
        @else
          <tr>
            <td colspan="3">{{ $data->shipping_full_name }}</td>
          </tr>
          @if ($data->shipping_company)
            <tr>
              <td colspan="3">{{ $data->shipping_company }}</td>
            </tr>
          @endif
          <tr>
            <td colspan="3">{{ $data->shipping_address }}</td>
          </tr>
          <tr>
            <td colspan="3">{{ $data->shipping_location }}</td>
          </tr>
          <tr>
            <td colspan="3">{{ $data->shipping_country }}</td>
          </tr>
        @endif
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">Zahlung</td>
        </tr>
        <tr>
          <td>{{ $data->payment_info }}</td>
          <td class="currency">CHF</td>
          <td class="amount text-right">{{ $data->total }}</td>
        </tr>
      </table>
      <!--<table cellpadding="0" cellspacing="0" style="border-top: 0">
        <tr>
          <td>Transaktions-Nummer</td>
          <td class="uuid">ea029ddd-fd2e-4c6e-a215-8db35e511cc8</td>
        </tr>
        <tr>
          <td>Order ID</td>
          <td class="uuid">e930518c-126b-4a5c-8404-92db710b4ad8</td>
        </tr>
      </table> -->
    </div>
    <div class="pt-lg">
      <p style="line-height: 1.54">Kleinere Produkte versenden wir innerhalb der Schweiz und des Fürstentums Lichtenstein. Grössere Produkte können auf Voranmeldung bei uns an der Binzstrasse abgeholt oder auf Anfrage persönlich oder per Kurier überbracht werden. Bitte kontaktiere uns hierfür per E-Mail: <a href="mailto:anliegen@fiefelstein.ch" style="text-decoration: none; color: #000000">anliegen@fiefelstein.ch</a></p>
    </div>
    <div class="pt-xl">
      <a href="https://www.instagram.com/fiefelstein/" target="_blank" title="fiefelstein.ch auf Instagram">
        <img src="{{ config('app.url') }}/img/instagram.png" alt="fiefelstein.ch auf Instagram" height="20" width="20" style="display:block; height:auto; width: 20px;">
      </a>
    </div>
  </div>
</x-mail::message>
