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
        Schema::create('guru', function (Blueprint $table) {
    $table->increments('id_guru');
    $table->unsignedInteger('id_user');
    $table->string('nama', 100);
    $table->string('jabatan', 100);
    $table->enum('jenis_kelamin', ['L','P']);
    $table->enum('agama', ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu']);
    $table->unsignedInteger('id_tahun_ajaran');

    $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('guru');
    }
};
