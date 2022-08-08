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
        Schema::create('sampah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sampah');
            $table->foreignId('jenis_harga_sampah_id')->constrained('jenis_harga_sampah')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('jenis_satuan_sampah_id')->constrained('jenis_satuan_sampah')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('harga_sampah');
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
        Schema::dropIfExists('sampah');
    }
};
