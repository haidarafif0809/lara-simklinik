<?php

use Illuminate\Database\Seeder;
use App\Gudang;
class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Gudang::create(['nama_gudang' => 'gudang contoh']);
    }
}
