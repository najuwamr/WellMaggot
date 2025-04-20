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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('total_harga');
            $table->date('tanggal_transaksi');
            $table->enum('status_transaksi',['diterima','dikirim', 'diproses']);
            $table->integer('ongkir');
            $table->timestamps();

            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('metode_pengiriman_id')->constrained('metode_pengiriman')->onDelete('cascade');
            $table->foreignId('pembayaran_id')->constrained('pembayaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
