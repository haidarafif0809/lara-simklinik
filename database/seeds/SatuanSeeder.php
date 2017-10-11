<?php

use Illuminate\Database\Seeder;
use App\Satuan;
class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

    Satuan::create(['nama_satuan' => 'PCS']);
    }
}
