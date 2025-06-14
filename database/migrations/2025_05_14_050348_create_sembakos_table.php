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
        Schema::create('sembakos', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('nilai_rupiah');
            $table->string('gambar');
            $table->integer('poin_harga');
            $table->boolean('isActive')->default(1); // 0 = false, 1 = true
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sembakos');
    }
};
