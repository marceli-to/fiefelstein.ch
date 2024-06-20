<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceAddressStoreRequest;
use App\Http\Requests\ShippingAddressStoreRequest;
use App\Http\Requests\PaymentMethodStoreRequest;
use App\Actions\Cart\GetCart;
use App\Actions\Cart\StoreCart;
use App\Actions\Cart\UpdateCart;

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
        ['salutation', 'company', 'firstname', 'name', 'street', 'zip', 'city', 'country', 'email']
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
      'shipping_address' => $request->only(
        ['use_invoice_address', 'company', 'firstname', 'name', 'street', 'zip', 'city', 'country']
      ),
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

  public function confirmation()
  {
    return view('pages.order.confirmation', [
      'cart' => (new GetCart())->execute(),
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