<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBagianToKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_karyawan', function (Blueprint $table) {
            $table->bigInteger("bagian_id")->unsigned()->nullable();
            $table->foreign("bagian_id")->references("id")->on("m_bagian");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_karyawan', function (Blueprint $table) {
            $table->dropForeign('m_karyawan_bagian_id_foreign');
            $table->dropColumn('bagian_id');
        });
    }
}
