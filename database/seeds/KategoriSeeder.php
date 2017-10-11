<?php

use Illuminate\Database\Seeder;
use App\KategoriProduk;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        KategoriProduk::create(['nama_kategori' => 'obat']);
        KategoriProduk::create(['nama_kategori' => 'makanan']);
        KategoriProduk::create(['nama_kategori' => 'minuman']);
    }
}
