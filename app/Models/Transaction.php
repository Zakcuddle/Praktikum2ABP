<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Kolom yang boleh diisi secara massal
    protected $fillable = ['customer_id', 'product_id', 'total_price', 'transaction_date'];

    // Relasi ke tabel customers
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi ke tabel products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
