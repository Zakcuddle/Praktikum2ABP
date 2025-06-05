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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Kolom ID unik untuk setiap transaksi
            $table->unsignedBigInteger('customer_id'); // ID dari customer yang melakukan transaksi
            $table->unsignedBigInteger('product_id'); // ID dari produk yang dibeli
            $table->decimal('total_price', 10, 2); // Total harga transaksi, tipe data decimal
            $table->date('transaction_date'); // Tanggal transaksi, tipe data date
            $table->timestamps(); // Kolom untuk mencatat waktu pembuatan dan perubahan data

            // Relasi ke tabel customers dan products
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
