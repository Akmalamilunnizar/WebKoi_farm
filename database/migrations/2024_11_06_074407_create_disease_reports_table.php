<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('disease_reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('numberof_fish');
            $table->integer('numberof_sick');
            $table->decimal('precentage', 5, 2);
            $table->string('type_disease');
            $table->text('information')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('disease_reports');
    }
};
