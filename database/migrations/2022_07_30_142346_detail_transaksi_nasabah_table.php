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
        Schema::create('detail_transaksi_nasabah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_nasabah_id')->constrained('transaksi_nasabah')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sampah_id')->constrained('sampah')->onDelete('cascade')->onUpdate('cascade');
            $table->double('kuantitas');
            $table->BigInteger('subtotal_harga');
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
        Schema::dropIfExists('detail_transaksi_nasabah');
    }
};
