<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = [
        'kode_pembayaran',
        'harga',
        'bukti_bayar',
        'status_bayar',
        'sharing_session',
        'status_konsul',
        'id_customer',
        'id_worker',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'id_worker');
    }
}
