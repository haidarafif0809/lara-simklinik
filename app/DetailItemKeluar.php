<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 
use Session;
class DetailItemKeluar extends Model
{
    //

       protected $fillable = ['no_faktur','id_produk','jumlah_produk'];
     protected $primaryKey = 'id_detail_item_keluar';
      // relasi ke produk
    public function produk(){
		  	return $this->hasOne('App\Produk','id','id_produk');
	}

	public function stok_produk($id_produk, $jumlah_keluar){
		$stok_produk = Hpp::select([DB::raw('IFNULL(SUM(jumlah_masuk),0) - IFNULL(SUM(jumlah_keluar),0) as jumlah_produk')])->where('id_produk', $id_produk)->first();

		$data_produk = Produk::select('nama_produk')->where('id', $id_produk)->first();

		$sisa_stok_keluar = $stok_produk->jumlah_produk - $jumlah_keluar;

		if ($sisa_stok_keluar < 0) {


					$pesan_alert = 
					'<div class="container-fluid">
	                    <div class="alert-icon">
	                    <i class="material-icons">error</i>
	                    </div>
                    		<b>Gagal : Stok " '.$data_produk->nama_produk.' " Tidak Mencukupi Untuk Dikeluarkan, Sisa Produk = " '.$stok_produk->jumlah_produk.' "</b>
                		</div>';

				        Session::flash("flash_notification", [
				            "level"     => "danger",
				            "message"   => $pesan_alert
				        ]);

			return false;
		}
		else{
			return true;
		}	
	}

	public static function boot() {
		parent::boot();
			
		self::created(function($itemKeluar) {

			$total_nilai = $itemKeluar->jumlah_produk *  $itemKeluar->produk->harga_beli;


			Hpp::create(['no_faktur' => $itemKeluar->no_faktur, 'id_produk' => $itemKeluar->id_produk, 'jenis_transaksi' => 'item_keluar', 'jumlah_keluar' => $itemKeluar->jumlah_produk, 'harga_unit' => $itemKeluar->produk->harga_beli, 'total_nilai' => $total_nilai, 'jenis_hpp' => '2']);

			return true;
		
		});
	} //model event
}
