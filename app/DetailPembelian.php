<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    //

       protected $fillable = ['no_faktur','id_produk','jumlah_produk'];
     protected $primaryKey = 'id_detail_pembelian';


     public function produk(){
		  	return $this->hasOne('App\Produk','id','id_produk');
	}

	public static function boot() {
		parent::boot();
			
		self::created(function($pembelian) {

			Hpp::create(['no_faktur' => $pembelian->no_faktur, 'id_produk' => $pembelian->id_produk, 'jenis_transaksi' => 'pembelian', 'jumlah_masuk' => $pembelian->jumlah_produk, 'harga_unit' => $pembelian->produk->harga_beli, 'total_nilai' => $pembelian->total_harga, 'jenis_hpp' => '1']);

			return true;
		
		});
	} //model event
}
