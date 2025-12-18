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

    Schema::create('siswa', function (Blueprint $table) {
    $table->increments('id_siswa');
    $table->string('nama', 100);
    $table->string('jenis_kelamin', 10);
    $table->enum('agama', ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu']);
    $table->unsignedInteger('id_kelas');
    $table->unsignedInteger('id_tahun_ajaran');

    $table->foreign('id_kelas')
          ->references('id_kelas')
          ->on('kelas');

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
        Schema::dropIfExists('siswa');
    }
};
