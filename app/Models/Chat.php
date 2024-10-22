<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';

    protected $guarded = ['id'];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'id_pengirim');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'id_penerima');
    }
}
