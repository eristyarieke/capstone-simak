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
    $table->unsignedInteger('id_user');
    $table->string('nis', 20);
    $table->string('nama', 100);
    $table->enum('jenis_kelamin', ['L','P']);
    $table->date('tanggal_lahir');
    $table->text('alamat');
    $table->string('no_hp', 20);
    $table->unsignedInteger('id_kelas');
    $table->year('tahun_masuk');
    $table->string('foto', 255)->nullable();

    $table->foreign('id_user')->references('id_user')->on('users');
    $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
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
