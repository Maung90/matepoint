<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',

        'gender',
        'email',
        'password',
        'notelp',
    
        'role_id', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
 
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Helper untuk memudahkan pengecekan role berdasarkan ID
    public function hasRoleId($roleId)
    {
        return $this->role_id == $roleId;
    }


}

