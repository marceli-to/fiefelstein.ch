@include('pdf.partials.header')
@include('pdf.partials.css.portrait')
@include('pdf.partials.css.invoice')
<header class="page-header">
  <img src="{{ asset('/img/logo.svg') }}" height="100" width="100">
  <h1>Rechnung</h1>
</header>
<footer class="page-footer">
  Fiefelstein/Flüeler, Binzstrasse 39, 8045 Zürich, anliegen@fiefelstein.ch
</footer>

<?php
$items = [
  [
    'title' => 'Ein Jahr mit Fisch und Vogel',
    'description' => 'Kochbuch',
    'price' => 60,
    'shipping' => 8,
    'quantity' => 1,
    'total' => 68
  ],
  [
    'title' => 'Palace A',
    'description' => 'Leuchtbuchstabe',
    'price' => 9900,
    'shipping' => 64,
    'quantity' => 3,
    'total' => 9964
  ],
  [
    'title' => 'Alice',
    'description' => 'Beistelltisch',
    'price' => 220,
    'shipping' => 64,
    'quantity' => 1,
    'total' => 284
  ],
  // [
  //   'title' => 'Shibuya',
  //   'description' => 'Lederetui',
  //   'price' => 50,
  //   'shipping' => 8,
  //   'quantity' => 1,
  //   'total' => 58
  // ],
];
$items = collect($items);
?>

<div class="page">
  <div class="page-address">
    Marcel Stadelmann<br>Letzigraben 149<br>8047 Zürich
  </div>
  <div class="page-content">
    <div class="page-content-header">
      <div class="font-bold">Rechnung FS2024-0000001</div>
      <div>Zürich, 21. Juni 2024</div>
    </div>
    @foreach ($items as $key => $item)
      <table class="order-details">
        <tr>
          <td class="order-detail-item font-bold">
            {{ $item['title'] }}
          </td>
          <td class="order-detail-item order-detail-item--currency">
          </td>
          <td class="order-detail-item order-detail-item--price align-right font-bold">
            {{ $item['quantity'] }}
          </td>
        </tr>
        <tr>
          <td class="order-detail-item">
            {{ $item['description'] }}
          </td>
          <td class="order-detail-item order-detail-item--currency">
            CHF
          </td>
          <td class="order-detail-item order-detail-item--price align-right">
            {!! number_format($item['price'], 2, '.', '') !!}
          </td>
        </tr>
        <tr>
          <td class="order-detail-item">
            Verpackung und Versand
          </td>
          <td class="order-detail-item order-detail-item--currency">
            CHF
          </td>
          <td class="order-detail-item order-detail-item--price align-right">
            {!! number_format($item['shipping'], 2, '.', '') !!}
          </td>
        </tr>
        <tr>
          <td class="order-detail-item font-bold">
            Total
          </td>
          <td class="order-detail-item order-detail-item--currency font-bold">
            CHF
          </td>
          <td class="order-detail-item order-detail-item--price align-right font-bold">
            {!! number_format($item['total'], 2, '.', '') !!}
          </td>
        </tr>
      </table>
    @endforeach
    <table class="order-details">
      <tr>
        <td class="order-detail-item font-bold">
          Gesamttotal
        </td>
        <td class="order-detail-item order-detail-item--currency font-bold">
          CHF
        </td>
        <td class="order-detail-item order-detail-item--price align-right font-bold">
          10'000.00
        </td>
      </tr>
    </table>
    <table class="order-details">
      <tr>
        <td class="order-detail-item order-detail-item--address font-bold">
        Lieferadresse
        </td>
      </tr>
      <tr>
        <td class="order-detail-item order-detail-item--address">
          Marcel Stadelmann
        </td>
      </tr>
      <tr>
        <td class="order-detail-item order-detail-item--address">
          Letzigraben 149
        </td>
      </tr>
      <tr>
        <td class="order-detail-item order-detail-item--address">
          8047 Zürich
        </td>
      </tr>
    </table>
    <table class="order-details">
      <tr>
        <td colspan="3" class="order-detail-item order-detail-item--address font-bold">
          Zahlung
        </td>
      </tr>
      <tr>
        <td class="order-detail-item">
          Twint / 21.06.2024, 11:23
        </td>
        <td class="order-detail-item order-detail-item--currency font-bold">
          CHF
        </td>
        <td class="order-detail-item order-detail-item--price align-right font-bold">
          10'000.00
        </td>
      </tr>
      
    </table>
    <p>
      Herzlichen Dank für Ihre Bestellung und freundliche Grüsse<br>Fiefelstein/Flüeler
    </p>
  </div>
</div>
@include('pdf.partials.footer')