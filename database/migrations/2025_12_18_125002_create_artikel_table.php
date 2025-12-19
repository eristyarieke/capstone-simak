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
        Schema::create('artikel', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('thumbnail')->nullable();
        $table->text('isi');
        $table->string('penulis');
        $table->enum('status', ['draft','publish'])->default('draft');
        $table->date('tanggal_publish')->nullable();
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
        Schema::dropIfExists('artikel');
    }
};
