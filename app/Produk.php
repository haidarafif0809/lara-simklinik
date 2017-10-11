<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //

    protected $fillable = ['kode_produk','nama_produk','kategori','tipe_produk','harga_beli','harga_jual_1','harga_jual_2','harga_jual_3','satuan'];



    public function satuan(){
   		return $this->belongsTo('App\Satuan','satuan','id');
   	} 
   	public function kategori(){
   		return $this->belongsTo('App\KategoriProduk','kategori','id');
   	}


     public function getTipeProdukAttribute($tipe_produk)
	 {    

			  	if ($tipe_produk == 1) {
			  		return $this->attributes['tipe_produk'] = 'Barang';
			  	}
			  	else {

			       return $this->attributes['tipe_produk'] = 'Jasa';
			  	}
	 }
}
