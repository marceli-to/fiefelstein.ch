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
    return view('pages.order.shipping-address', [
      'cart' => (new GetCart())->execute(),
      'order_step' => $this->handleStep(2),
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
    $payment_methods = config('invoice.payment_methods');

    $cart = (new UpdateCart())->execute([
      'payment_method' => [
        'name' => $payment_methods[$request->payment_method]['name'],
        'key' => $payment_methods[$request->payment_method]['key'],
      ],
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
    // Todo: payment process
    $cart = (new UpdateCart())->execute([
      'order_step' => $this->handleStep(6),
      'is_paid' => true,
    ]);

    // Create the order
    $order = (new HandleOrder())->execute();

    // Redirect to the confirmation page
    return redirect()->route('order.confirmation', $order);
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