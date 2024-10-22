<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\ProfesionalController;

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
// Route::get('/pembayaran-customer', function () {
//     return view('bayarCustomer');
// });

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
Route::get('/daftar', function () {
    return view('register');
});

Route::resource('list-pembayaran', PembayaranController::class);
Route::get('/pembayaran/{id}', [PembayaranController::class, 'edit'])->name('pembayaran.edit'); // get all
Route::get('/pembayaran/get/{id}', [PembayaranController::class, 'get'])->name('pembayaran.get'); //get by id
Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update'); //update status
Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayarans.destroy'); //delete
Route::post('/upload-bukti', [PembayaranController::class, 'uploadBukti'])->name('upload.bukti'); //upload bukti
Route::get('/pembayaran-customer', [PembayaranController::class, 'getForCustomer']);


// Route::resource('chat', ChatController::class);
Route::controller(MessageController::class)->group(function () {
    Route::get('/message', 'view')->name('message.view');
    Route::get('get/{id}', 'get')->name('message.get');
    Route::get('detail/{id}', 'detail')->name('message.detail');
    Route::post('create/{id}', 'create')->name('message.create');
});

Route::get('/chat/{id}', [ChatController::class, 'getChat'])->name('chat.getChat');


// Route untuk tampilan login
Route::get('/login', function () {
    return view('login');
});

// Route untuk proses login
Route::post('/login', [LoginController::class, 'login']);

// Route untuk halaman beranda setelah login
Route::get('/home', function () {
    return view('home'); // pastikan file home.blade.php ada di resources/views
})->name('home')->middleware('auth');
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login']);
});



Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register']);
// Route untuk logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Anda telah logout.');
})->middleware('auth')->name('logout');

Route::get('/dashboard', function () {
    return view('home');
})->middleware('auth')->name('home');


// TALENT
Route::get('/talent', [TalentController::class, 'getUsersWithRoleIdTwo']);
Route::get('/talent/get/{id}', [TalentController::class, 'get'])->name('talent.get');
Route::post('/talent/store', [TalentController::class, 'store'])->name('talent.store');



// PROFESIONAL
Route::get('/profesional', [ProfesionalController::class, 'getUsersWithRoleIdTwo']);
Route::get('/profesional/get/{id}', [ProfesionalController::class, 'get'])->name('profesional.get');
Route::post('/profesional/store', [ProfesionalController::class, 'store'])->name('profesional.store');
