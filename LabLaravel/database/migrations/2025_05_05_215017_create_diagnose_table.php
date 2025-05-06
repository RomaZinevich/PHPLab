<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnoseTable extends Migration
{
    public function up()
    {
        Schema::create('diagnose', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('instructions')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diagnose');
    }
}
