<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/produkt/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/boutique', [ProductController::class, 'listing'])->name('product.listing');
Route::get('/brocante', [PageController::class, 'brocante'])->name('brocante');
Route::get('/idee', [PageController::class, 'idea'])->name('idea');
Route::get('/kontakt', [PageController::class, 'contact'])->name('contact');

Route::get('/bestellung/uebersicht', [OrderController::class, 'index'])->name('order.overview');
Route::get('/bestellung/rechnungsadresse', [OrderController::class, 'invoice'])->name('order.invoice-address');
Route::post('/bestellung/rechnungsadresse/speichern', [OrderController::class, 'storeInvoice'])->name('order.invoice-address-store');
Route::get('/bestellung/lieferadresse', [OrderController::class, 'shipping'])->name('order.shipping-address');
Route::post('/bestellung/lieferadresse/speichern', [OrderController::class, 'storeShipping'])->name('order.shipping-address-store');
Route::get('/bestellung/zahlung', [OrderController::class, 'payment'])->name('order.payment');
Route::post('/bestellung/zahlungsmethode/speichern', [OrderController::class, 'storePaymentMethod'])->name('order.payment-method-store');
Route::get('/bestellung/zusammenfassung', [OrderController::class, 'summary'])->name('order.summary');
Route::get('/bestellung/bestaetigung', [OrderController::class, 'confirmation'])->name('order.confirmation');

Route::get('/img/{template}/{filename}/{maxSize?}/{coords?}/{ratio?}', [ImageController::class, 'getResponse']);


// Route::view('/', 'pages.home')->name('home');
// Route::view('/produkt/{id}', 'pages.product')->name('page.product');