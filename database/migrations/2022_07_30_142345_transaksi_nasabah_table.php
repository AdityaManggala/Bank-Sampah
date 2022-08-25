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
        Schema::create('transaksi_nasabah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('nasabah')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('admin_id')->constrained('admin')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('tipe_transaksi', ['debit', 'kredit'])->nullable();
            $table->bigInteger('grand_total_harga')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('transaksi_nasabah');
    }
};
