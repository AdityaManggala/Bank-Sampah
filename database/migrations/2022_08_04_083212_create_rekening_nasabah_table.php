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
        Schema::create('rekening_nasabah', function (Blueprint $table) {
            $table->id();
            $table->string('no_rekening');
            $table->foreignId('nasabah_id')->constrained('nasabah')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('saldo');
            $table->integer('kredit');
            $table->string('tipe_transaksi');
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
        Schema::dropIfExists('rekening_nasabah');
    }
};
