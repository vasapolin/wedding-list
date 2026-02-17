<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/presentes', 'gifts.index');
Route::view('/doar', 'donation.select-type');
Route::view('/doar/direto', 'donation.direct');
Route::view('/checkout', 'donation.checkout');
Route::view('/pagamento/pix', 'donation.pix');
Route::view('/confirmacao', 'donation.confirmation');
Route::view('/como-doar', 'pages.how-to-donate');
Route::view('/mensagens', 'messages.index');
