<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKepTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kep', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nis');
            $table->string('kelakuan', 100);
            $table->string('kerajinan', 100);
            $table->string('kebersihan', 100);
            $table->integer('kelas_id');
            $table->integer('smt');
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
        Schema::dropIfExists('kep');
    }
}
