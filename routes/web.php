<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PembayaranController;

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


// Route::resource('chat', ChatController::class);
Route::controller(MessageController::class)->group(function () {
    Route::get('/message', 'view')->name('message.view');
    Route::get('get/{id}', 'get')->name('message.get');
    Route::get('detail/{id}', 'detail')->name('message.detail');
    Route::post('create/{id}', 'create')->name('message.create');
});
Route::get('/chat/{id}', [ChatController::class, 'getChat'])->name('chat.getChat');

