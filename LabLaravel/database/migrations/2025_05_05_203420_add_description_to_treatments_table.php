<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('treatments', function (Blueprint $table) {
            $table->text('description')->after('name');
        });
    }

    public function down()
    {
        Schema::table('treatments', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
