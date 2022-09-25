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
        Schema::create('riwayat_transaksi_nasabah', function (Blueprint $table) {
            $table->id();
            $table->string('admin_nama');
            $table->string('nasabah_nama');
            $table->string('tipe_transaksi');
            $table->bigInteger('grand_total_harga');
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
        Schema::dropIfExists('riwayat_transaksi_nasabah');
    }
};
