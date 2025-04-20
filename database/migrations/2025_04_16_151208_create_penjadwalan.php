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
            $table->string('lokasi');
            $table->date('tanggal');
            $table->time('waktu');
            $table->integer('total_berat');
            $table->string('gambar');
            $table->timestamps();

            $table->foreignId('use_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('metode_pengambilan_id')->constrained('metode_pengambilan')->onDelete('cascade');
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
