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
        Schema::create('saldo_sampah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('sampah_id')->constrained('sampah')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('jenis_satuan_sampah_id')->constrained('jenis_satuan_sampah')->onDelete('cascade')->onUpdate('cascade');
            $table->double('qty');
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
        Schema::dropIfExists('saldo_sampah');
    }
};
