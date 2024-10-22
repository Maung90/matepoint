<?php

namespace App\Http\Controllers;
use App\Models\Pembayaran;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{ 
    public function index()
    {
        $pembayarans = Pembayaran::all();
        return view('pembayaran', compact('pembayarans'));
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
