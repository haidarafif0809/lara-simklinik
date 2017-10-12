<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKasMutasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas_mutasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_faktur')->unique();
            $table->integer('dari_kas');
            $table->integer('ke_kas');
            $table->float('jumlah',11,2)->default(0.00);
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('kas_mutasis');
    }
}
