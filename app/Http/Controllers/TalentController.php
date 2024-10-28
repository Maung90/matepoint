<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class TalentController extends Controller
{
    public function getUsersWithRoleIdTwo()
    {
        // Mengambil semua user dengan role_id = 3
        $users = User::where('role_id', 3)->get();

    // Mengembalikan view dengan data users
        return view('talent', compact('users'));
    }
    
    public function get($id)
    {
        $talent = User::where('id', $id)->first(); 
        return response()->json($talent);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_worker' => 'required|integer',
            'id_customer' => 'required|integer',
            'harga_worker' => 'required|integer',
            'sharing_session' => 'required|in:offline,online',
        ]);

        $lastPayment = Pembayaran::orderBy('id', 'desc')->first();

        if ($lastPayment) { 
            $lastKode = $lastPayment->kode_pembayaran;
            $lastNumber = intval(substr($lastKode, 3)); 
            $newNumber = $lastNumber + 1;
            $kodePembayaran = 'TRX' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);  
        } else {
            $kodePembayaran = 'TRX001';
        }

        Pembayaran::create([
            'id_worker' => $request->id_worker,
            'id_customer' => $request->id_customer,
            'harga' => $request->harga_worker,
            'sharing_session' => $request->sharing_session,
            'kode_pembayaran' => $kodePembayaran,
            'status_konsul' => "proses",
            'status_bayar' => "unpaid",
        ]);

        session()->flash('success', 'Pembayaran berhasil disimpan dengan kode: ' . $kodePembayaran);
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $query = $request->get('query'); // Ambil input dari permintaan pencarian
        
        // Pencarian dalam database menggunakan model
        
        $results = User::where('role_id', '3')->get();
        
        if ($query) {
            $results = User::where('name', 'LIKE', "%{$query}%")
            ->where('role_id', '=', '3')
            ->get();
        }
        
        return response()->json($results); // Kembalikan hasil dalam format JSON
    }
}
