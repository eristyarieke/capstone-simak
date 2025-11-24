<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapel', function (Blueprint $table) {
    $table->increments('id_mapel');
    $table->string('kode_mapel', 20);
    $table->string('nama_mapel', 100);
    $table->unsignedInteger('id_guru');

    $table->foreign('id_guru')->references('id_guru')->on('guru');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapel');
    }
};
