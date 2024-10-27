<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SharingSession extends Model
{
    use HasFactory;

    protected $table = 'sharing_session';

    protected $guarded = ['id'];

    protected $casts = [
        'expired_at' => 'timestamp',
    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }

}
