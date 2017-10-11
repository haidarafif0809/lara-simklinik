<?php

use Illuminate\Database\Seeder;
use App\Suplier;
class SuplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Suplier::create(['nama_suplier' => 'suplier contoh','alamat_suplier' => 'lampung','no_telp_suplier' => '08122']);
    }
}
