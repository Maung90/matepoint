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
        Schema::create('chat', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('id_pengirim');
            $table->foreign('id_pengirim')->references('id')->on('users')->onDelete('cascade'); 
            $table->unsignedBigInteger('id_penerima');
            $table->foreign('id_penerima')->references('id')->on('users')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat');
    }
};
