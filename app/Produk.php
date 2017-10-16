<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Yajra\Auditable\AuditableTrait;

class Produk extends Model
{
    //

  use AuditableTrait;

    protected $fillable = ['kode_produk','nama_produk','kategori','tipe_produk','harga_beli','harga_jual_1','harga_jual_2','harga_jual_3','satuan','status_aktif'];



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


           //MODEL EVENT 
  public static function boot() {
    parent::boot();

      self::deleting(function($produk) {

        $komisi_produk_terpakai =  KomisiProduk::where('produk', $produk->id)->count();
        $produk_terpakai = $komisi_produk_terpakai ;
        
        if ($produk_terpakai > 0) {

           $pesan_alert = 
                 "<div class='container-fluid'>
                      <div class='alert-icon'>
                      <i class='material-icons'>error</i>
                      </div>
                      <b>Gagal : $produk->nama_produk Sudah Terpakai Tidak Boleh Di Hapus</b>
                  </div>";

            Session:: flash("flash_notification", [
              "level"=>"danger",
              "message"=> $pesan_alert
              ]);
          return false;
        }
        else {

          return true;
        }
   
      
      });  

  }// end model event
}
