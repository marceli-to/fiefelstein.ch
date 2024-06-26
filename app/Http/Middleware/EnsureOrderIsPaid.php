<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Actions\Cart\GetCart;

class EnsureOrderIsPaid
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    $cart = (new GetCart())->execute();
    if (!isset($cart['is_paid']) || $cart['is_paid'] !== true)
    {
      return redirect()->route('order.summary')->with('error', 'Bitte schliessen Sie den Zahlungsvorgang ab, bevor Sie fortfahren.');
    }
    return $next($request);
  }
}
