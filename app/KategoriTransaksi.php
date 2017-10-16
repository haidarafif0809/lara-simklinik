<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Yajra\Auditable\AuditableTrait;

class KategoriTransaksi extends Model
{
    //
use AuditableTrait;
        protected $fillable = ['nama_kategori_transaksi'];


        //MODEL EVENT 
	public static function boot() {
		parent::boot();

	    self::deleting(function($kategori) {

	      $kategori_masuk_terpakai =  KasMasuk::where('kategori', $kategori->id)->count();
	      $kategori_keluar_terpakai =  KasKeluar::where('kategori', $kategori->id)->count();
	      $kategori_terpakai = $kategori_masuk_terpakai + $kategori_keluar_terpakai;
	      
	      if ($kategori_terpakai > 0) {

	         $pesan_alert = 
	               "<div class='container-fluid'>
	                    <div class='alert-icon'>
	                    <i class='material-icons'>error</i>
	                    </div>
	                    <b>Gagal : $kategori->nama_kategori_transaksi Sudah Terpakai Tidak Boleh Di Hapus</b>
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
