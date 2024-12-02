<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('menu', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->decimal('harga', 8, 2); // Menyimpan harga dengan 2 angka di belakang koma
        $table->string('foto'); // Jika foto opsional, tambahkan nullable
        $table->unsignedBigInteger('kategori_id');
        $table->timestamps();

        // Foreign key ke tabel kategori (jika ada)
        $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
