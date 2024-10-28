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

Route::controller(PembayaranController::class)->middleware('auth')->group(function () {
    Route::get('/pembayaran/{id}', 'edit')->name('pembayaran.edit');
    Route::get('/pembayaran/get/{id}', 'get')->name('pembayaran.get');
    Route::put('/pembayaran/{id}', 'update')->name('pembayaran.update');
    Route::delete('/pembayaran/{id}', 'destroy')->name('pembayaran.destroy');
    Route::put('/upload-bukti/{id}', 'uploadBukti')->name('upload.bukti');
    Route::get('/pembayaran/table/customer', 'tableCustomer')->name('pembayaran.tableCustomer');
    Route::get('/pembayaran-customer', 'viewCustomer');
});

// Route::resource('chat', ChatController::class);
Route::prefix('chat')->controller(MessageController::class)->middleware('auth')->group(function () {
    Route::get('/', 'view')->name('message.view');
    Route::get('/{id}', 'view')->name('message.view');
    Route::get('detail/{id}', 'detail')->name('message.detail');
    Route::post('create/{id}', 'create')->name('message.create');
    Route::put('end_session/{id}', 'end_session')->name('message.end_session');
});



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


Route::get('/forgot_password', function () {
    return view('forgot_password');
})->name('forgot_password');


// TALENT
Route::get('/talent', [TalentController::class, 'getUsersWithRoleIdTwo']);
Route::get('/talent/get/{id}', [TalentController::class, 'get'])->name('talent.get');
Route::post('/talent/store', [TalentController::class, 'store'])->name('talent.store');
Route::get('/talent/search', [TalentController::class, 'search'])->name('talent.search');


// PROFESIONAL
Route::get('/profesional', [ProfesionalController::class, 'getUsersWithRoleIdTwo']);
Route::get('/profesional/get/{id}', [ProfesionalController::class, 'get'])->name('profesional.get');
Route::post('/profesional/store', [ProfesionalController::class, 'store'])->name('profesional.store');
Route::get('/profesional/search', [ProfesionalController::class, 'search'])->name('profesional.search');
