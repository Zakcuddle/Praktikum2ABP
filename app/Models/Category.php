<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Kolom yang boleh diisi secara massal
    protected $fillable = ['name', 'description'];

    // Relasi ke tabel products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}