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
        Schema::create('sambutan_kepsek', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kepsek');
            $table->string('foto')->nullable();
            $table->text('isi_sambutan');
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
        Schema::dropIfExists('sambutan_kepsek');
    }
};
