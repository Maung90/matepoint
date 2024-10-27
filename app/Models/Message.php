<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'message';

    protected $guarded = ['id'];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'id_pengirim');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'id_penerima');
    }

    public function sharingSession()
    {
        return $this->belongsTo(SharingSession::class, 'id_sharing');
    }

    public static function getChatUsers($id)
    {
        $from = self::where('id_pengirim', $id)->distinct()->pluck('id_penerima')->toArray();
        $to = self::where('id_penerima', $id)->distinct()->pluck('id_pengirim')->toArray();
        $data = array_unique(array_merge($from, $to));

        return User::whereIn('id', $data)->get();
    }
}
