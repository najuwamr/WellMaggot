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
        Schema::create('penjadwalan', function (Blueprint $table) {
            $table->id();
            // $table->string('lokasi');
            $table->date('tanggal');
            $table->time('waktu');
            $table->integer('total_berat');
            $table->string('gambar');
            $table->timestamps();
            $table->foreignId('metode_pengambilan_id')->constrained('metode_pengambilan')->onDelete('cascade');
            $table->foreignId('detail_alamat_id')->constrained('detail_alamat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjadwalan');
    }
};
