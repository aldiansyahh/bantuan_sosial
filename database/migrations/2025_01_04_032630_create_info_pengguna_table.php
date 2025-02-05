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
        Schema::create('info_pengguna', function (Blueprint $table) {
            $table->id('no_pengguna');
            $table->unsignedBigInteger('no_kepala_keluarga'); // Match with 'id' type
            $table->string('wilayah');
            $table->string('tahun');
            $table->foreign('no_kepala_keluarga')
                ->references('no_kepala_keluarga')
                ->on('kepala_keluarga')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_pengguna');
    }
};
