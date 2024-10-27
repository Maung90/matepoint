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
        Schema::create('sharing_session', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pembayaran');
            $table->foreign('id_pembayaran')->references('id')->on('pembayaran')->onDelete('cascade');
            $table->uuid('uuid');
            $table->timestamp('expired_at');
            $table->timestamps();
        });

        Schema::create('message', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengirim');
            $table->foreign('id_pengirim')->references('id')->on('users')->onDelete('cascade'); 
            $table->unsignedBigInteger('id_penerima');
            $table->foreign('id_penerima')->references('id')->on('users')->onDelete('cascade'); 
            $table->unsignedBigInteger('id_sharing');
            $table->foreign('id_sharing')->references('id')->on('sharing_session')->onDelete('cascade'); 
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sharing_session');
        Schema::dropIfExists('message');
    }
};
