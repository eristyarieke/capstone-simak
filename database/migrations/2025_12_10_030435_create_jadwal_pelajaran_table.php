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

    Schema::create('jadwal_pelajaran', function (Blueprint $table) {
    $table->increments('id_jadwal');
    $table->unsignedInteger('id_kelas');
    $table->unsignedInteger('id_mapel');
    $table->unsignedInteger('id_guru');
    $table->unsignedInteger('id_tahun_ajaran');
    $table->enum('hari', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']);
    $table->time('jam_mulai');
    $table->time('jam_selesai');

    $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
    $table->foreign('id_mapel')->references('id_mapel')->on('mapel');
    $table->foreign('id_guru')->references('id_guru')->on('guru');
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
        Schema::dropIfExists('jadwal_pelajaran');
    }
};
