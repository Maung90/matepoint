<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\SharingSession;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private $user;

    public function __construct()
    { 
        $this->user = Auth::user(); 
    }

    public function view($id = null)
    {
        if ($id) {
            $messages = Message::with('pengirim', 'penerima')
            ->where(function ($query) use ($id) {
                $query->where('id_pengirim', $this->user->id)
                ->where('id_penerima', $id);
            })
            ->orWhere(function ($query) use ($id) {
                $query->where('id_pengirim', $id)
                ->where('id_penerima', $this->user->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();
        } else {
            $messages = Message::with('pengirim', 'penerima')
            ->where('id_pengirim', $this->user->id)
            ->orderBy('created_at', 'asc')
            ->get();
        }
        
        if ($this->user->role_id !== 2 && $this->user->role_id !== 3) {
            $list = SharingSession::whereHas('pembayaran', function ($query) {
                $query->where('id_customer', $this->user->id);
            })->with('pembayaran.customer')->get();
        } else {
            $list = SharingSession::whereHas('pembayaran', function ($query) {
                $query->where('id_worker', $this->user->id);
            })->with('pembayaran.customer')->get();
        }
        
        return view('message', compact('messages', 'list', 'id'));
    }


    public function detail($id)
    {
        try {
            $messages = Message::with('pengirim', 'penerima')
            ->whereHas('sharingSession', function ($query) use ($id) {
                $query->where('uuid', $id);
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

            $sharing = SharingSession::where('uuid', $id)->with('pembayaran.customer')->first();

            if (!$sharing) {
                return response()->json([
                    'status' => false,
                    'message' => 'Session Sharing tidak ditemukan.'
                ], 404);
            }

            if (\Carbon\Carbon::parse($sharing->expired_at)->lessThan(now())) {
                if ($sharing->pembayaran->worker->role_id == 3) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Session Sharing sudah berakhir.'
                    ], 404);
                }
            }

            if ($this->user->role_id !== 2 && $this->user->role_id !== 3) {
                $penerima = $sharing->pembayaran->worker->id;
            } else {
                $penerima = $sharing->pembayaran->customer->id;
            }

            Message::create([
                'id_penerima' => $penerima,
                'id_pengirim' => $this->user->id,
                'body' => $request->body,
                'id_sharing' => $sharing->id
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

    public function end_session($id)
    {
        try {
            $sharing = SharingSession::where('uuid', $id)->first();
            $sharing->update([
                'expired_at' => now()
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Sharing Session telah selesai.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
