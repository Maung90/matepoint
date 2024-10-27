<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class ProfesionalController extends Controller
{
    public function getUsersWithRoleIdTwo()
    {
        // Mengambil semua user dengan role_id = 2
        $users = User::where('role_id', 2)->get();

    // Mengembalikan view dengan data users
        return view('profesional', compact('users'));
    }
    public function get($id)
    {
        $talent = User::where('id', $id)->first(); 
        return response()->json($talent);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input dari form
        $request->validate([
            'id_worker' => 'required|integer',
            'id_customer' => 'required|integer',
            'harga_worker' => 'required|integer',
            'sharing_session' => 'required|in:offline,online',
        ]);
        $statusKonsul = "proses"; 
        $statusBayar = "nonpaid"; 

        // Cek kode pembayaran terakhir di database
        $lastPayment = Pembayaran::orderBy('id', 'desc')->first();

        if ($lastPayment) { 
            $lastKode = $lastPayment->kode_pembayaran;
            $lastNumber = intval(substr($lastKode, 3)); 
            $newNumber = $lastNumber + 1;
            $kodePembayaran = 'TRX' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);  
        } else {
            $kodePembayaran = 'TRX001';
        }

        // Simpan data ke database dengan kode pembayaran yang baru
        $proses = Pembayaran::create([
            'id_worker' => $request->id_worker,
            'id_customer' => $request->id_customer,
            'harga' => $request->harga_worker,
            'sharing_session' => $request->sharingSession,
            'kode_pembayaran' => $kodePembayaran,
            'status_konsul' => $statusKonsul,
            'status_bayar' => $statusBayar,
        ]);
       // return $proses;
        // Redirect atau kembali dengan pesan sukses 
        return redirect()->back()->with('success', 'Pembayaran berhasil disimpan dengan kode: ' . $kodePembayaran);
        // return redirect()->route('/list-pembayaran')->with('success', 'Pembayaran berhasil disimpan dengan kode: ' . $kodePembayaran);
    }
}
