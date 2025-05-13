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
            $table->integer('total_pembayaran');
             $table->string('midtrans_order_id'); //id yang dikirim ke midtrans
            $table->string('midtrans_tr_id')->nullable(); //id dari midtrans
            $table->string('jenis_metode');
            $table->timestamp('paid_at')->nullable();
            $table->date('tanggal_transaksi');
            $table->foreignId('status_transaksi_id')->constrained('status_transaksi')->onDelete('cascade');
            $table->foreignId('detail_alamat_id')->constrained('detail_alamat')->onDelete('cascade');
            $table->timestamps();
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
