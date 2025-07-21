<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembeli extends Model
{
    use HasFactory;

    protected $table = 'pembelis';

    protected $fillable = [
        'user_id', 
        'name',
        'email',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Transaksi
    public function transaksis(){
        return $this->hasMany(Transaksi::class);
    }
}
