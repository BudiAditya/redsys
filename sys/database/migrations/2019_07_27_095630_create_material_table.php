<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_material', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('is_delete')->default(0);
            $table->string('kode',10);
            // $table->integer('kategori_id');
            $table->bigInteger("kategori_id")->unsigned()->nullable();
            //Relasi Tanpa Hapus data
            //$table->foreign("kategori_id")->references("id")->on("m_kategori_material");
            $table->foreign('kategori_id')->references('id')->on('m_kategori_material')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('nama_brg',100);
            // $table->string('ukuran',50)->nullable();
            $table->string('satuan',10)->nullable();
            $table->integer('harga')->nullable();
            $table->string('keterangan',255)->nullable();
            // $table->unsignedTinyInteger('is_stock')->default(0);
            $table->integer('createdby_id')->nullable();
            $table->datetime('create_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('updateby_id')->nullable();
            $table->datetime('update_time')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_material');
    }
}
