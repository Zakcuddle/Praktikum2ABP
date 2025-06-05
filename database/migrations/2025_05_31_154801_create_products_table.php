<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Kolom ID unik untuk setiap produk
            $table->string('name'); // Nama produk, tipe data string
            $table->text('description'); // Deskripsi produk, tipe data text
            $table->decimal('price', 10, 2); // Harga produk, tipe data decimal dengan 10 digit total dan 2 digit setelah koma
            $table->unsignedBigInteger('category_id'); // ID dari kategori produk, tipe data unsignedBigInteger
            $table->timestamps(); // Kolom untuk mencatat waktu pembuatan dan perubahan data

            // Relasi antara produk dan kategori (Foreign Key)
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
