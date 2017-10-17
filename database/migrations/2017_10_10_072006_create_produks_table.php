<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_produk');
            $table->string('nama_produk');
            $table->integer('kategori');
            $table->integer('satuan');
            $table->integer('tipe_produk')->default(1)->comment = "1 = barang , 2 = jasa";
            $table->integer('harga_beli')->default(0)->nullable();
            $table->integer('harga_jual_1')->default(0)->nullable();
            $table->integer('harga_jual_2')->default(0)->nullable();
            $table->integer('harga_jual_3')->default(0)->nullable();
            $table->integer('status_aktif')->default(1);
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
        Schema::dropIfExists('produks');
    }
}
