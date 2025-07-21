<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembeli extends Model
{
    use HasFactory;

    protected static function boot(){
        parent::boot();

    //     static::creating(function ($pembeli) {

    //         if (empty($pembeli->api_token)) {
    //             $pembeli->api_token = str::random(10);
    //         }
    // });
    }
    protected $table = 'pembelis';

    protected $fillable = [
        'user_id', 
        'name',
        'email',
        'api_token',
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
