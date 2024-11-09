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
        Schema::create('diagnosa_penyakit', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jenis_koi');
            $table->string('penyakit');
            $table->string('penyebab');
            $table->string('gambar_koi')->nullable(); // Bisa diisi dengan path gambar
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnosa_penyakit');
    }
};