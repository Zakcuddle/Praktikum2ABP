<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Kolom yang boleh diisi secara massal
    protected $fillable = ['name', 'email', 'phone', 'address'];

    // Relasi ke tabel transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
