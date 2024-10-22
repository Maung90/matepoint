<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $id_pengirim;

    public function __construct()
    {
        $this->id_pengirim = session('user_id');
    }

    public function view()
    {
        $user = User::find($this->id_pengirim);
        $messages = Message::with('pengirim', 'penerima')
            ->where('id_pengirim', $this->id_pengirim)
            ->orderBy('created_at', 'asc')
            ->get();

        $list = Message::getChatUsers($this->id_pengirim);

        return view('message', compact('messages', 'user', 'list'));
    }

    public function get($id)
    {
        $data = Message::find($id);

        return response()->json($data);
    }

    public function detail($id)
    {
        $messages = Message::with('pengirim','penerima')
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
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d');
            });
        
        // dd($messages);

        return view('detail-message', compact('messages', 'id'));
    }

    public function create(Request $request, $id)
    {
        Message::create([
            'id_penerima' => $id,
            'id_pengirim' => $this->id_pengirim,
            'body' => $request->body
        ]);
        
        response()->json($request->all());
    }
}
