<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePakaiMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pakai_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('is_delete')->default(0);
            $table->date('tgl_pakai')->nullable();

            $table->bigInteger("unit_id")->unsigned()->nullable();
            $table->foreign("unit_id")->references("id")->on("m_unitrumah");
            
            // $table->integer('pekerjaan_id')->default(0);
            $table->bigInteger("material_id")->unsigned()->nullable();
            $table->foreign("material_id")->references("id")->on("m_material");

            $table->decimal('qty',10,2)->default(0.00);
            
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
        Schema::dropIfExists('t_pakai_materials');
    }
}
