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
    Schema::table('laporan', function (Blueprint $table) {
        $table->timestamp('tanggal_laporan')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('laporan', function (Blueprint $table) {
        $table->dropColumn('tanggal_laporan');
    });
}
};
