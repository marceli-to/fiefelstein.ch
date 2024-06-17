<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;

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

Route::get('/', [LandingController::class, 'index'])->name('page.home');
Route::get('/produkt/{product}', [ProductController::class, 'show'])->name('page.product.show');
Route::get('/boutique', [ProductController::class, 'listing'])->name('page.product.listing');
Route::get('/brocante', [PageController::class, 'brocante'])->name('page.brocante');
Route::get('/idee', [PageController::class, 'idea'])->name('page.idea');
Route::get('/kontakt', [PageController::class, 'contact'])->name('page.contact');

Route::get('/warenkorb/uebersicht', [CheckoutController::class, 'index'])->name('page.basket.overview');

Route::get('/img/{template}/{filename}/{maxSize?}/{coords?}/{ratio?}', [ImageController::class, 'getResponse']);


// Route::view('/', 'pages.home')->name('page.home');
// Route::view('/produkt/{id}', 'pages.product')->name('page.product');