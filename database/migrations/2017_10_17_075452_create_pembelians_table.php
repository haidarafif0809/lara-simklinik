<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_faktur');
            $table->string('no_faktur_suplier')->nullable();
            $table->string('keterangan');
            $table->integer('suplier');
            $table->integer('gudang');
            $table->integer('cara_bayar')->nullable();
            $table->date('tanggal_jt')->nullable();
            $table->float('total',11,2)->default(0.00);
            $table->float('potongan',11,2)->default(0.00);
            $table->float('tunai_awal',11,2)->default(0.00);
            $table->float('kredit_awal',11,2)->default(0.00);
            $table->integer('status_awal')->comment = "1 = tunai, 2 = hutang";
            $table->unsignedInteger('created_by')->nullable()->index();            
            $table->unsignedInteger('updated_by')->nullable()->index();
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
        Schema::dropIfExists('pembelians');
    }
}
