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
        Schema::create('nasabah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nasabah');
            $table->string('password');
            $table->string('alamat_nasabah');
            $table->string('no_rekening');
            $table->integer('jml_keluarga');
            $table->integer('rata_volume_smph_harian');
            $table->rememberToken();
            $table->timestamp('tgl_msk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nasabah');
    }
};
