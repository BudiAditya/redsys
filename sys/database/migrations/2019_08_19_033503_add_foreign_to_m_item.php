<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToMItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_item', function (Blueprint $table) {
            $table->bigInteger("transaski_id")->unsigned()->nullable();
            $table->foreign("transaski_id")->references("id")->on("m_transaksi");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_item', function (Blueprint $table) {
            $table->dropForeign('m_item_transaski_id_foreign');
            $table->dropColumn('transaski_id');
        });
    }
}
