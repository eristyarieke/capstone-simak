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

        Schema::create('kelas', function (Blueprint $table) {
    $table->increments('id_kelas');
    $table->string('nama_kelas', 50);
    $table->unsignedInteger('wali_kelas');
    $table->unsignedInteger('id_tahun_ajaran');

    $table->foreign('wali_kelas')
          ->references('id_guru')
          ->on('guru');

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
        Schema::dropIfExists('kelas');
    }
};
