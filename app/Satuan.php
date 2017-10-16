<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Yajra\Auditable\AuditableTrait;


class Satuan extends Model
{
    //

    use AuditableTrait;

     protected $fillable = [
        'nama_satuan'
    ];


    //MODEL EVENT 
	public static function boot() {
		parent::boot();

	    self::deleting(function($Satuan) {

	      $satuan_terpakai =  Produk::where('satuan', $Satuan->id)->count();
	      
	      if ($satuan_terpakai > 0) {

	         $pesan_alert = 
	               "<div class='container-fluid'>
	                    <div class='alert-icon'>
	                    <i class='material-icons'>error</i>
	                    </div>
	                    <b>Gagal : $Satuan->nama_satuan Sudah Terpakai Tidak Boleh Di Hapus</b>
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
