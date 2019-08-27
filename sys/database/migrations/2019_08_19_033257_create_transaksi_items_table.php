<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('jumlah_bayar',10,2)->default(0.00);
            $table->bigInteger("gudang_id")->unsigned()->nullable();
            $table->foreign("gudang_id")->references("id")->on("m_gudang");
            $table->integer('createdby_id')->nullable();
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
        Schema::dropIfExists('m_transaksi');
    }
}
