<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('landing-page');
});

Route::get('/dashboard', function () {
    return view('home');
});
Route::get('/user', function () {
    return view('user');
});
Route::get('/list-pembayaran', function () {
    return view('pembayaran');
});
Route::get('/chat', function () {
    return view('chat');
});
Route::get('/profesional', function () {
    return view('profesional');
});
Route::get('/talent', function () {
    return view('talent');
});
Route::get('/account-settings', function () {
    return view('account-settings');
});

Route::resource('list-pembayaran', PembayaranController::class);
Route::get('/pembayaran/{id}', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayarans.destroy');


Route::resource('chat', ChatController::class);
Route::get('/chat/{id}', [ChatController::class, 'getChat'])->name('chat.getChat');

