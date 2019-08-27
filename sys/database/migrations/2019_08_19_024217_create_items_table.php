<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_item', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger("material_id")->unsigned()->nullable();
            $table->foreign("material_id")->references("id")->on("m_material");

            $table->bigInteger("gudang_id")->unsigned()->nullable();
            $table->foreign("gudang_id")->references("id")->on("m_gudang");
            
            
            $table->decimal('qty',10,2)->default(0.00);
            $table->integer('harga')->nullable();
            $table->unsignedTinyInteger('is_stock')->default(0);

            $table->integer('createdby_id')->nullable();
            $table->integer('updateby_id')->nullable();
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
        Schema::dropIfExists('m_item');
    }
}
