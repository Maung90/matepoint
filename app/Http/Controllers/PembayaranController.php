<?php

namespace App\Http\Controllers;
use App\Models\Pembayaran;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{ 
    public function index()
    {
        $pembayarans = Pembayaran::join('users as customer', 'pembayaran.id_customer', '=', 'customer.id')
        ->join('users as worker', 'pembayaran.id_worker', '=', 'worker.id') 
        ->select('*', 'customer.name as nama_customer', 'worker.name as nama_worker')  
        ->get();
        return view('pembayaran', compact('pembayarans'));
    }
    public function get()
    {
        $pembayarans = Pembayaran::join('users as customer', 'pembayaran.id_customer', '=', 'customer.id')
        ->join('users as worker', 'pembayaran.id_worker', '=', 'worker.id') 
        ->select('*', 'customer.name as nama_customer', 'worker.name as nama_worker')  
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

}
