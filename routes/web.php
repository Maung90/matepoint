<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
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
 
