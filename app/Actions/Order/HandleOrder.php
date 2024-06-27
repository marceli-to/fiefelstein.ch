<?php
namespace App\Actions\Order;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Actions\Product\FindProduct;
use App\Actions\Cart\GetCart;
use App\Actions\Cart\DestroyCart;
use App\Services\Pdf\Pdf;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderConfirmationNotification;

class HandleOrder
{
  public function execute()
  {
    $order = $this->create(
      (new GetCart())->execute()
    );
    $invoice = $this->invoice($order);
    $this->notify($order, $invoice);
    (new DestroyCart())->execute();
    return $order;
  }

  private function create($data)
  {
    $order = Order::create([
      'uuid' => \Str::uuid(),
      'salutation' => $data['invoice_address']['salutation'] ?? '',
      'company' => $data['invoice_address']['company'] ?? '',
      'firstname' => $data['invoice_address']['firstname'],
      'name' => $data['invoice_address']['name'],
      'street' => $data['invoice_address']['street'],
      'street_number' => $data['invoice_address']['street_number'] ?? '',
      'zip' => $data['invoice_address']['zip'],
      'city' => $data['invoice_address']['city'],
      'country' => $data['invoice_address']['country'],
      'email' => $data['invoice_address']['email'],
      'use_invoice_address' => $data['shipping_address']['use_invoice_address'] ?? 0,
      'shipping_company' => $data['shipping_address']['company'] ?? '',
      'shipping_firstname' => $data['shipping_address']['firstname'] ?? '',
      'shipping_name' => $data['shipping_address']['name'] ?? '',
      'shipping_street' => $data['shipping_address']['street'] ?? '',
      'shipping_street_number' => $data['shipping_address']['street_number'] ?? '',
      'shipping_zip' => $data['shipping_address']['zip'] ?? '',
      'shipping_city' => $data['shipping_address']['city'] ?? '',
      'shipping_country' => $data['shipping_address']['country'] ?? '',
      'payment_method' => $data['payment_method']['name'],
      'payed_at' => now(),
    ]);
   
    // Create order products
    foreach ($data['items'] as $item)
    {
      $product = (new FindProduct())->execute($item['uuid']);
      OrderProduct::create([
        'order_id' => $order->id,
        'product_id' => $product->isVariation ? $product->product_id : $product->id,
        'product_variation_id' => $product->isVariation ? $product->id : null,
        'title' => $product->title,
        'description' => $product->description,
        'image' => $product->image,
        'quantity' => $item['quantity'],
        'price' => $item['price'] * $item['quantity'],
        'shipping' => $item['shipping'] * $item['quantity'],
        'is_variation' => $product->isVariation ? 1 : 0,
      ]);

      // Update product stock
      $product->stock -= $item['quantity'];
      $product->save();

    }

    // Update order total
    $order->total = $order->products->sum(function ($product) {
      return $product->price + $product->shipping;
    });
    $order->save();


    // return order with products
    return Order::with('products')->find($order->id);
  }

  private function invoice($order)
  {
    $pdf = (new Pdf())->create([
      'data' => $order,
      'view' => 'invoice',
      'name' => config('invoice.invoice_prefix') . $order->uuid,
    ]);
    return $pdf;
  }

  private function notify($order, $invoice)
  {
    try {
      Notification::route('mail', env('MAIL_TO'))
        ->notify(
          new OrderConfirmationNotification($order, $invoice)
        );
    } 
    catch (\Exception $e) {
      \Log::error($e->getMessage());
    }
  }
}