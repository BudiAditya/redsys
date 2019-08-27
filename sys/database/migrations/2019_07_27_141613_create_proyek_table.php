<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_proyek', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('entity_id')->default(0);
            $table->unsignedTinyInteger('is_delete')->default(0);
            $table->string('kode',10)->unique();
            $table->string('nama',50);
            $table->string('lokasi',50)->nullable();
            $table->string('owner',50);
            $table->integer('anggaran')->default(0);
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->comment('1=Aktif, 2=Selesai');
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
        Schema::dropIfExists('m_proyek');
    }
}
