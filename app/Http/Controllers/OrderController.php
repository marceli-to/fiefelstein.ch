<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceAddressStoreRequest;
use App\Http\Requests\ShippingAddressStoreRequest;
use App\Http\Requests\PaymentMethodStoreRequest;
use App\Http\Requests\OrderStoreRequest;
use App\Actions\Cart\GetCart;
use App\Actions\Cart\StoreCart;
use App\Actions\Cart\UpdateCart;
use App\Actions\Order\HandleOrder;
use App\Models\Order;

class OrderController extends BaseController
{
  public function index()
  {  
    return view('pages.order.overview', [
      'cart' => (new GetCart())->execute(),
      'order_step' => $this->handleStep(1),
    ]);
  }

  public function invoice()
  {
    return view('pages.order.invoice-address', [
      'cart' => (new GetCart())->execute(),
      'order_step' => $this->handleStep(1),
    ]);
  }

  public function storeInvoice(InvoiceAddressStoreRequest $request)
  {
    $cart = (new UpdateCart())->execute([
      'invoice_address' => $request->only(
        ['salutation', 'company', 'firstname', 'name', 'street', 'street_number', 'zip', 'city', 'country', 'email']
      ),
      'order_step' => $this->handleStep(2),
    ]);
    return redirect()->route('order.shipping-address');
  }

  public function shipping()
  {
    $cart = (new GetCart())->execute();
    $can_use_invoice_address = in_array(
      $cart['invoice_address']['country'], 
      config('countries.delivery')
    ) ?? FALSE;

    return view('pages.order.shipping-address', [
      'cart' => (new GetCart())->execute(),
      'order_step' => $this->handleStep(2),
      'can_use_invoice_address' => $can_use_invoice_address,
    ]);
  }

  public function storeShipping(ShippingAddressStoreRequest $request)
  {
    $cart = (new UpdateCart())->execute([
      'shipping_address' => !$request->use_invoice_address ? 
        $request->only(['use_invoice_address', 'company', 'firstname', 'name', 'street', 'street_number', 'zip', 'city', 'country']) : 
        $request->only(['use_invoice_address']),
      'order_step' => $this->handleStep(3),
    ]);
    return redirect()->route('order.payment');
  }

  public function payment()
  {
    return view('pages.order.payment', [
      'cart' => (new GetCart())->execute(),
      'order_step' => $this->handleStep(4),
    ]);
  }

  public function storePaymentMethod(PaymentMethodStoreRequest $request)
  {
    $cart = (new UpdateCart())->execute([
      'payment_method' => $request->payment_method,
      'order_step' => $this->handleStep(4),
    ]);
    return redirect()->route('order.summary');
  }

  public function summary()
  {
    return view('pages.order.summary', [
      'cart' => (new GetCart())->execute(),
      'order_step' => $this->handleStep(5),
    ]);
  }

  public function finalize(OrderStoreRequest $request)
  {
    // Set Stripe API key from config
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

    // Get cart
    $cart = (new GetCart())->execute();

    // Create pending order (unpaid) before redirecting to Stripe
    $order = (new HandleOrder())->createPending($cart);

    // Build items array with prices from database
    $items = [];
    foreach ($order->orderProducts as $orderProduct)
    {
      // Calculate unit amount (price + shipping per item)
      $unitPrice = $orderProduct->price / $orderProduct->quantity;
      $unitShipping = $orderProduct->shipping / $orderProduct->quantity;
      $unit_amount = (int) (($unitPrice + $unitShipping) * 100);

      $items[] = [
        'price_data' => [
          'currency' => 'chf',
          'unit_amount' => $unit_amount,
          'product_data' => [
            'name' => $orderProduct->title,
            'images' => $orderProduct->image ? [config('app.url') . "/img/small/" . $orderProduct->image] : [],
          ],
        ],
        'quantity' => $orderProduct->quantity,
      ];
    }

    // Create Stripe checkout session
    $checkout_session = \Stripe\Checkout\Session::create([
      'customer_email' => $order->email,
      'submit_type' => 'pay',
      'payment_method_types' => ['card'],
      'line_items' => $items,
      'mode' => 'payment',
      'locale' => app()->getLocale(),
      'success_url' => route('order.payment.success', ['order' => $order->uuid]),
      'cancel_url' => route('order.payment.cancel', ['order' => $order->uuid]),
    ]);

    // Store Stripe session ID on order
    $order->stripe_session_id = $checkout_session->id;
    $order->save();

    // Note: Cart is NOT destroyed here. If payment is cancelled, user can retry.
    // Cart will be destroyed on successful payment (via paymentSuccess redirect)

    // Redirect to Stripe
    return redirect()->away($checkout_session->url);
  }

  public function paymentSuccess(Order $order)
  {
    // Webhook handles payment confirmation - just redirect to confirmation page
    // The order may still show "processing" until the webhook confirms payment

    // Destroy cart on successful redirect from Stripe
    (new \App\Actions\Cart\DestroyCart())->execute();

    return redirect()->route('order.confirmation', $order);
  }

  public function paymentCancel(Order $order)
  {
    // If order is already paid (webhook processed), redirect to confirmation
    if ($order->payed_at) {
      return redirect()->route('order.confirmation', $order);
    }

    // User cancelled payment - delete the pending order and redirect back to summary
    // Restore stock for the cancelled order products
    foreach ($order->orderProducts as $orderProduct) {
      // Handle product variations and regular products
      $item = $orderProduct->is_variation
        ? $orderProduct->productVariation
        : $orderProduct->product;

      if ($item) {
        $item->stock += $orderProduct->quantity;
        if ($item->state->value === 'not_available' && $item->stock > 0) {
          $item->state = 'available';
        }
        $item->save();
      }
    }

    $order->delete();

    return redirect()->route('order.summary')->with('error', 'Zahlung wurde abgebrochen.');
  }

  public function confirmation(Order $order)
  {
    return view('pages.order.confirmation', [
      'order' => $order,
      'order_step' => $this->handleStep(6),
    ]);
  }

  private function handleStep($current)
  {
    $cart = (new GetCart())->execute();
    $step = isset($cart['order_step']) && $cart['order_step'] > $current ? $cart['order_step'] : $current;
    (new UpdateCart())->execute([
      'order_step' => $cart['items'] ? $step : 1,
    ]);
    return $step;
  }
}