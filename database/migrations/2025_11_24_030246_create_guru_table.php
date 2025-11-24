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
    $table->string('nip', 20)->nullable();
    $table->string('nama', 100);
    $table->enum('jenis_kelamin', ['L','P']);
    $table->text('alamat');
    $table->string('no_hp', 20);
    $table->string('email', 100);
    $table->string('foto', 255)->nullable();

    $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
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
