<?php

use App\Http\Controllers\AsaasWebhookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/presentes', [GiftController::class, 'index'])->name('gifts.index');

Route::post('/carrinho/adicionar/{gift}', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrinho/remover/{gift}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrinho/limpar', [CartController::class, 'clear'])->name('cart.clear');

Route::view('/doar', 'donation.select-type')->name('donation.select');
Route::get('/doar/direto', [DonationController::class, 'direct'])->name('donation.direct');
Route::get('/checkout', [DonationController::class, 'checkout'])->name('donation.checkout');
Route::post('/checkout', [DonationController::class, 'store'])->name('donation.store');
Route::get('/pagamento/pix/{donation}', [DonationController::class, 'pix'])->name('donation.pix');
Route::get('/pagamento/status/{donation}', [DonationController::class, 'status'])->name('donation.status');
Route::get('/confirmacao/{donation}', [DonationController::class, 'confirmation'])->name('donation.confirmation');

Route::view('/como-doar', 'pages.how-to-donate')->name('how-to-donate');

Route::get('/mensagens', [MessageController::class, 'index'])->name('messages.index');
Route::post('/mensagens', [MessageController::class, 'store'])->name('messages.store');

Route::post('/api/asaas-webhook', [AsaasWebhookController::class, 'handle'])->name('asaas.webhook');
