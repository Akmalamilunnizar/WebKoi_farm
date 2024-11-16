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
        Schema::table('koi_fish', function (Blueprint $table) {
            $table->date('tanggal_lahir')->after('jenis_koi')->nullable(); // tambahkan kolom di sini
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('koi_fish', function (Blueprint $table) {
            $table->dropColumn('tanggal_lahir');
        });
    }
};
