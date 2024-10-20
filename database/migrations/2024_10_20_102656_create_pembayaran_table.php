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
            $table->string('kode_pembayaran');
            $table->string('bukti_bayar');
            $table->string('status_bayar');
            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_customer')->references('id')->on('users')->onDelete('cascade'); 
            $table->unsignedBigInteger('id_worker');
            $table->foreign('id_worker')->references('id')->on('users')->onDelete('cascade'); 
            $table->timestamps();
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
