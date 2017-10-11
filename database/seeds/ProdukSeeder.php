<?php

use Illuminate\Database\Seeder;
use App\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Produk::create(['kode_produk' => '010101','nama_produk' => 'sabun','kategori' => 1,'tipe_produk' => 1,'harga_beli' => 1000,'harga_jual_1' => 2000,'harga_jual_2' => 2500,'harga_jual_3' => 3000,'satuan' => 1]);
        Produk::create(['kode_produk' => '020202','nama_produk' => 'shampo','kategori' => 2,'tipe_produk' => 1,'harga_beli' => 1100,'harga_jual_1' => 2100,'harga_jual_2' => 2600,'harga_jual_3' => 3100,'satuan' => 1]);
    }
}
