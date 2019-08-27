<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitrumahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_unitrumah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('is_delete')->default(0)->comment('0=exists, 1=deleted');

            $table->bigInteger("type_id")->unsigned()->nullable()->default(0)->comment('id type rumah');
            $table->foreign("type_id")->references("id")->on("m_typerumah");

            // $table->integer('type_id')->default(0)->comment('id type rumah');

            // $table->integer('proyek_id')->nullable();
            $table->bigInteger("proyek_id")->unsigned()->nullable();
            $table->foreign("proyek_id")->references("id")->on("m_proyek");

            $table->string('alamat',100);
            
            $table->integer('luas_bangunan')->default(0);
            $table->integer('luas_tanah')->default(0);

            $table->unsignedTinyInteger('status_pekerjaan')->default(0)->comment('0 = Standar, 1 = Perluasan/Penambahan');
            $table->unsignedTinyInteger('status_progress')->default(0)->comment('0 = Progress, 1 = Selesai');

            // $table->string('customer_id',50)->nullable();

            $table->integer("customer_id")->unsigned()->nullable();
            $table->foreign("customer_id")->references("id")->on("m_customer");
            
            $table->integer('status_beli')->nullable();

            $table->date('mulai_bangun')->nullable();
            $table->date('selesai_bangun')->nullable();
            $table->date('tst_kunci')->nullable()->comment('Tgl Serah Terima Kunci');
            
            $table->string('keterangan',255)->nullable();

            $table->bigInteger("pekerja_id")->unsigned()->nullable();
            $table->foreign("pekerja_id")->references("id")->on("m_pekerja");
            // $table->integer('pekerja_id')->nullable();

            $table->bigInteger("arsitek_id")->unsigned()->nullable();
            $table->foreign("arsitek_id")->references("id")->on("m_karyawan");
            // $table->integer('arsitek_id')->nullable();

            $table->bigInteger("pengawas_id")->unsigned()->nullable();
            $table->foreign("pengawas_id")->references("id")->on("m_karyawan");
            // $table->integer('pengawas_id')->nullable();

            $table->bigInteger("marketing_id")->unsigned()->nullable();
            $table->foreign("marketing_id")->references("id")->on("m_karyawan");
            // $table->integer('marketing_id')->nullable();

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
        Schema::dropIfExists('m_unitrumah');
    }
}
