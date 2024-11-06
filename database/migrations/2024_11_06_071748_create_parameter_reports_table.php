<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('parameter_reports', function (Blueprint $table) {
            $table->id(); 
            $table->string('parameter'); 
            $table->string('normal_range'); 
            $table->string('weekly_status'); 
            $table->text('information')->nullable(); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('parameter_reports');
    }
};
