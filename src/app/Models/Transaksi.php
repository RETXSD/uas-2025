<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // Define the table associated with the model
    protected $table = 'transaksi';

    // Define the fillable attributes
    protected $fillable = [
        'user_id',
        'product_name',
        'price',
        'quantity',
        'status',
        'receipt',
    ];

    // Define the relationship with User
    public function user(){
        return $this->belongsTo(User::class);
    }
    // Define the relationship with Product
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');  
}
}
