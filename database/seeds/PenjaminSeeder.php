<?php

use Illuminate\Database\Seeder;
use App\Penjamin;
class PenjaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Penjamin::create(['nama_penjamin'  => 'pemerintah','alamat_penjamin' => 'lampung','no_telp_penjamin' => '081222','level_harga' => 1]);
         Penjamin::create(['nama_penjamin'  => 'pemerintah kota','alamat_penjamin' => 'lampung','no_telp_penjamin' => '081222','level_harga' => 2]);
          Penjamin::create(['nama_penjamin'  => 'pemerintah negara','alamat_penjamin' => 'lampung','no_telp_penjamin' => '081222','level_harga' => 3]);
    }
}
