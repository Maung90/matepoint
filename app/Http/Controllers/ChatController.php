<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\detailChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $penerima = Chat::join('users as pengirim', 'chat.id_pengirim', '=', 'pengirim.id')
        ->join('users as penerima', 'chat.id_penerima', '=', 'penerima.id') 
        ->select('chat.*', 'pengirim.name as nama_pengirim', 'penerima.name as nama_penerima') 
        ->where('chat.id_pengirim', 4) 
        ->get();

        return view('chat', compact('penerima'));

    }

    public function getChat($id)
    {
        $isi_chat =  Chat::find($id);

        return response()->json($isi_chat);
    }
}

