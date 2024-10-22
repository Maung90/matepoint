<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailChat extends Model
{
    use HasFactory;

    protected $table = 'detail_chat';

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
