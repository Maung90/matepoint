<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'notelp' => 'required|string|max:255', // Validasi untuk no telepon
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat user baru dengan role_id default 2 (member)
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'notelp' => $request->notelp,
            'password' => Hash::make($request->password), // Enkripsi password
            'role_id' => 4, // Menetapkan role_id sebagai 2 untuk member
        ]);

        // Redirect atau berikan respon
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
