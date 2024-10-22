<?php

namespace App\Http\Controllers;
use App\Models\Pembayaran;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{ 
    public function index()
    {
        $pembayarans = Pembayaran::join('users as customer', 'pembayaran.id_customer', '=', 'customer.id')
        ->join('users as worker', 'pembayaran.id_worker', '=', 'worker.id') 
        ->select('*', 'pembayaran.id as idPembayaran', 'customer.name as nama_customer', 'worker.name as nama_worker')
        ->orderBy('pembayaran.id','DESC')  
        ->get();
        return view('pembayaran', compact('pembayarans'));
    }
    public function getForCustomer()
    {
        $pembayarans = Pembayaran::join('users as customer', 'pembayaran.id_customer', '=', 'customer.id')
        ->join('users as worker', 'pembayaran.id_worker', '=', 'worker.id') 
        ->select('*', 'pembayaran.id as idPembayaran', 'customer.name as nama_customer', 'worker.name as nama_worker')
        ->where('pembayaran.id_customer',session('user_id')) 
        ->orderBy('pembayaran.id','DESC')  
        ->get();
        return view('bayarCustomer', compact('pembayarans'));
    }
    public function get($id)
    {
        $pembayarans = Pembayaran::join('users as customer', 'pembayaran.id_customer', '=', 'customer.id')
        ->join('users as worker', 'pembayaran.id_worker', '=', 'worker.id') 
        ->select('*', 'customer.name as nama_customer', 'worker.name as nama_worker')->where('pembayaran.id',$id) 
        ->get();
        return response()->json($pembayarans);
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::find($id);
        return response()->json($pembayaran);
    }
    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        // Validasi data
        $request->validate([
            'status_bayar' => 'required|in:paid,nonpaid',
        ]);

        // Update status pembayaran
        $pembayaran->status_bayar = $request->status_bayar;
        $pembayaran->updated_at = now();
        $pembayaran->save();

        return response()->json(['success' => 'Data has been updated'], 200);
    }
    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);
        
        if ($pembayaran) {
            $pembayaran->delete();
            return response()->json(['success' => 'Data deleted successfully.']);
        } else {
            return response()->json(['error' => 'Data not found.'], 404);
        }
    }

    public function uploadBukti(Request $request)
    {
        // Validasi file
        $validator = Validator::make($request->all(), [
            'bukti_bayar' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Maksimal 2MB
            'id_pembayaran' => 'required|integer|exists:pembayaran,id', // Validasi ID pembayaran
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan pembayaran yang ingin di-update
        $pembayaran = Pembayaran::find($request->id_pembayaran);

        if ($pembayaran) {
            // Upload file
            $file = $request->file('bukti_bayar');
            // Pastikan menggunakan store untuk menyimpan di folder public
            $path = $file->store('uploads/bukti_bayar', 'public'); // Menyimpan file di folder public/uploads/bukti_bayar
            
            // Hapus file lama jika ada
            if ($pembayaran->bukti_bayar) {
                Storage::disk('public')->delete($pembayaran->bukti_bayar);
            }

            // Update path bukti bayar di database
            $pembayaran->bukti_bayar = $path; // Update kolom bukti_bayar
            $pembayaran->save(); // Simpan perubahan

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Bukti bayar berhasil di-upload.');
        }

        // Jika pembayaran tidak ditemukan, kembalikan dengan error
        return redirect()->back()->with('error', 'Pembayaran tidak ditemukan.');
    }


}
