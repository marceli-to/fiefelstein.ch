<?php
namespace App\Actions\Order;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Actions\Product\FindProduct;
use App\Services\Pdf\Pdf;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderConfirmationNotification;

class HandleOrder
{
  public function execute($data)
  {
    // dd($data);
    // Create order
    $this->createOrder($data);

    // Send notification
    $this->notify($data);
  }

  private function createOrder($data)
  {
    // Create order
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
      'shipping_company' => $data['shipping_address']['shipping_company'] ?? '',
      'shipping_firstname' => $data['shipping_address']['shipping_firstname'] ?? '',
      'shipping_name' => $data['shipping_address']['shipping_name'] ?? '',
      'shipping_street' => $data['shipping_address']['shipping_street'] ?? '',
      'shipping_street_number' => $data['shipping_address']['shipping_street_number'] ?? '',
      'shipping_zip' => $data['shipping_address']['shipping_zip'] ?? '',
      'shipping_city' => $data['shipping_address']['shipping_city'] ?? '',
      'shipping_country' => $data['shipping_address']['shipping_country'] ?? '',
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
        'price' => $item['price'],
        'total' => $item['total'],
        'total_shipping' => $item['total_shipping'],
        'grand_total' => $item['grand_total'],
        'is_variation' => $product->isVariation ? 1 : 0,
      ]);
    }
  }

  private function notify($data)
  {
      try {
        Notification::route('mail', env('MAIL_TO'))
          ->notify(
            new OrderConfirmationNotification($data)
          );
      } 
      catch (\Exception $e) {
        \Log::error($e->getMessage());
      }
  }
}