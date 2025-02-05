<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepala_keluarga', function (Blueprint $table) {
            $table->id('no_kepala_keluarga');
            $table->string('nama')->nullable();
            $table->string('rw')->nullable();
            $table->bigInteger('penghasilan')->nullable();
            $table->string('status_bangunan')->nullable();
            $table->bigInteger('jumlah_kendaraan')->nullable();
            $table->bigInteger('jumlah_tanggungan')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('kepala_keluarga');
    }
};
