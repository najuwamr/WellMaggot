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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('midtrans_order_id'); //id yang dikirim ke midtrans
            $table->string('midtrans_tr_id'); //id dari midtrans
            $table->string('payment_type');
            $table->string('status');
            $table->decimal('gross_amount', 10, 2);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreignId('transaksi_id')->constrained('transaksi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
