<?php

use Illuminate\Database\Seeder;
use App\Kas;

class KasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Kas::create(['kode_kas' => '0101','nama_kas' => 'BNI']);
        Kas::create(['kode_kas' => '0202','nama_kas' => 'BCA']);
        Kas::create(['kode_kas' => '0303','nama_kas' => 'MUAMALAT']);
    }
}
