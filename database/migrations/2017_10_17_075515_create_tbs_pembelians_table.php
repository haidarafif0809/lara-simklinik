<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbsPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbs_pembelians', function (Blueprint $table) {
            $table->increments('id_tbs_pembelian');    
            $table->string('session_id');
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
        Schema::dropIfExists('tbs_pembelians');
    }
}
