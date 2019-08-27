<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgresOpnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_progres_opnames', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('is_delete')->default(0);
            $table->date('tgl_progress')->nullable();

            $table->bigInteger("unit_id")->unsigned()->nullable();
            $table->foreign("unit_id")->references("id")->on("m_unitrumah");
            
            // $table->integer('pekerjaan_id')->default(0);
            $table->bigInteger("pekerjaan_id")->unsigned()->nullable();
            $table->foreign("pekerjaan_id")->references("id")->on("m_pekerjaan");

            $table->decimal('persentase',10,2)->default(0.00);
            
            $table->decimal('price',10,2)->default(0);

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
        Schema::dropIfExists('t_progres_opnames');
    }
}
