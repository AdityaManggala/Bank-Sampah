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
        Schema::create('detail_riwayat_transaksi_nasabah', function (Blueprint $table) {
            $table->id();
            $table->string('sampah_nama');
            $table->foreignId('rwyt_trans_nsb_id')->constrained('riwayat_transaksi_nasabah')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kuantitas');
            $table->string('satuan');
            $table->string('subtotal_harga');
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
        Schema::dropIfExists('detail_riwayat_transaksi_nasabahs');
    }
};
