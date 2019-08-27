<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePekerjaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_pekerjaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('is_delete')->default(0);
            // $table->integer('kategori_id');

            $table->bigInteger("kategori_id")->unsigned()->nullable();
            $table->foreign("kategori_id")->references("id")->on("m_kategori_pekerjaan");
            
            $table->string('pekerjaan',150);
            $table->string('satuan',10)->nullable();
            $table->integer('std_harga')->nullable();
            $table->string('keterangan',255)->nullable();
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
        Schema::dropIfExists('m_pekerjaan');
    }
}
