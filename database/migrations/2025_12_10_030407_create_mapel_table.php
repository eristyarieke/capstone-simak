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
    $table->unsignedInteger('id_tahun_ajaran');

    $table->foreign('id_tahun_ajaran')
          ->references('id_tahun_ajaran')
          ->on('tahun_ajaran')
          ->onDelete('cascade');

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
        Schema::dropIfExists('mapel');
    }
};
