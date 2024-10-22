<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private $id_pengirim;

    public function __construct()
    { 
        $this->id_pengirim = session('user_id'); 
    }

    public function view($id = null)
    {
        if ($id) {
            $messages = Message::with('pengirim', 'penerima')
            ->where(function ($query) use ($id) {
                $query->where('id_pengirim', $this->id_pengirim)
                ->where('id_penerima', $id);
            })
            ->orWhere(function ($query) use ($id) {
                $query->where('id_pengirim', $id)
                ->where('id_penerima', $this->id_pengirim);
            })
            ->orderBy('created_at', 'asc')
            ->get();
        } else {
            $messages = Message::with('pengirim', 'penerima')
            ->where('id_pengirim', $this->id_pengirim)
            ->orderBy('created_at', 'asc')
            ->get();
        }

        $list = Message::getChatUsers($this->id_pengirim);
        // $list = Pembayaran::with('customer')->where('id_customer', $this->id_pengirim)->get();

        return view('message', compact('messages', 'list', 'id'));
    }


    public function detail($id)
    {
        try {
            $messages = Message::with('pengirim', 'penerima')
            ->where(function ($query) use ($id) {
                $query->where('id_pengirim', $this->id_pengirim)
                ->where('id_penerima', $id);
            })
            ->orWhere(function ($query) use ($id) {
                $query->where('id_pengirim', $id)
                ->where('id_penerima', $this->id_pengirim);
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d');
            });

            if ($messages->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada pesan untuk ditampilkan.'
                ], 404);
            }

            return view('detail-message', compact('messages', 'id'));
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }


    public function create(Request $request, $id)
    {
        try {
            if (!$id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Penerima tidak ditemukan.'
                ], 404);
            }

            $checkTrx = Pembayaran::where('id_worker', $id)->where('id_customer', $this->id_pengirim)->first();
            if (!$checkTrx) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak dapat meminta Konsultasi.'
                ], 404);
            }

            if (!User::find($id)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Penerima tidak ditemukan dalam sistem.'
                ], 404);
            }

            Message::create([
                'id_penerima' => $id,
                'id_pengirim' => $this->id_pengirim,
                'body' => $request->body
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Pesan terkirim.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

}
