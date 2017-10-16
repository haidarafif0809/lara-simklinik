<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Yajra\Auditable\AuditableTrait;

class KategoriProduk extends Model
{
    //

    use AuditableTrait;

    protected $fillable = ['nama_kategori'];

    //MODEL EVENT 
	public static function boot() {
		parent::boot();

	    self::deleting(function($kategori) {

	      $kategori_terpakai =  Produk::where('kategori', $kategori->id)->count();
	      
	      if ($kategori_terpakai > 0) {

	         $pesan_alert = 
	               "<div class='container-fluid'>
	                    <div class='alert-icon'>
	                    <i class='material-icons'>error</i>
	                    </div>
	                    <b>Gagal : $kategori->nama_kategori Sudah Terpakai Tidak Boleh Di Hapus</b>
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
