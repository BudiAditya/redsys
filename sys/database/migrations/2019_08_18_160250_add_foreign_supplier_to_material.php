<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignSupplierToMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_material', function (Blueprint $table) {
            $table->bigInteger("supplier_id")->unsigned()->nullable();
            $table->foreign("supplier_id")->references("id")->on("m_supplier");
            $table->string('material_pic',100)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_material', function (Blueprint $table) {
            $table->dropForeign('m_material_supplier_id_foreign');
            $table->dropColumn('supplier_id');

            $table->dropColumn('material_pic');
        });
    }
}
