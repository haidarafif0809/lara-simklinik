<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditTbsPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edit_tbs_pembelians', function (Blueprint $table) {
            $table->increments('id_edit_tbs_pembelian');
            $table->string('session_id');
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
        Schema::dropIfExists('edit_tbs_pembelians');
    }
}
