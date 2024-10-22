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

    public static function getChatUsers($id)
    {
        $from = self::where('id_pengirim', $id)->distinct()->pluck('id_penerima')->toArray();
        $to = self::where('id_penerima', $id)->distinct()->pluck('id_pengirim')->toArray();
        $data = array_unique(array_merge($from, $to));
        $latest_message = [];
        foreach ($data as $other) {
            $message = self::where(function ($query) use ($id, $other) {
                $query->where('id_pengirim', $id)
                    ->where('id_penerima', $other);
            })->orWhere(function ($query) use ($id, $other) {
                $query->where('id_pengirim', $other)
                    ->where('id_penerima', $id);
            })->latest()->first();

            if ($message) {
                $latest_message[$other] = $message;
            }
        }

        return User::whereIn('id', $data)->get();
    }
}
