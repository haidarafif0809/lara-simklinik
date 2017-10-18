<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelians', function (Blueprint $table) {
             $table->increments('id_detail_pembelian');
            $table->string('no_faktur');
            $table->integer('id_produk');
            $table->decimal('jumlah_produk', 65,2); 
            $table->decimal('harga_produk', 65,2); 
            $table->decimal('total_harga', 65,2); 
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
        Schema::dropIfExists('detail_pembelians');
    }
}
