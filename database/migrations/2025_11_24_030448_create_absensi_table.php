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
        Schema::create('absensi', function (Blueprint $table) {
    $table->increments('id_absensi');
    $table->unsignedInteger('id_siswa');
    $table->unsignedInteger('id_jadwal');
    $table->date('tanggal');
    $table->enum('keterangan', ['Hadir','Izin','Sakit','Alfa']);

    $table->foreign('id_siswa')->references('id_siswa')->on('siswa');
    $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal_pelajaran');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
};
