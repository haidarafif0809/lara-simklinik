<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TbsPembelian extends Model
{
    //

      protected $fillable = ['id_tbs_pembelian','session_id','id_produk','jumlah_produk','harga_produk','total_harga'];
      
     protected $primaryKey = 'id_tbs_pembelian';

    	public function produk()
		  {
		  	return $this->hasOne('App\Produk','id','id_produk');
		  }
}
