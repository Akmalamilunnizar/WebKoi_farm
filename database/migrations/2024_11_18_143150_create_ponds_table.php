<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePondsTable extends Migration
{
    public function up()
    {
        Schema::create('ponds', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name', 50); 
            $table->integer('volume'); 
            $table->string('img')->nullable();
            $table->integer('jml_ikan')->default(0); 
            $table->boolean('relay_condition')->default(false); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('ponds');
    }
}
