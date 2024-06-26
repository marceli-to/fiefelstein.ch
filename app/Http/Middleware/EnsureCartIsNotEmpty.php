<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Actions\Cart\GetCart;

class EnsureCartIsNotEmpty
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    $cart = (new GetCart())->execute();
    if (!isset($cart['items']) || empty($cart['items'])) {
      return redirect()->route('order.overview');
    }
    return $next($request);
  }
}
