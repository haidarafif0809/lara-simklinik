<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Yajra\Auditable\AuditableTrait;


class Kas extends Model
{
    //

    use AuditableTrait;

    protected $fillable = ['kode_kas','nama_kas'];



    //MODEL EVENT 
	public static function boot() {
		parent::boot();

	    self::deleting(function($kas) {

	      $kas_terpakai =  TransaksiKas::where('kas', $kas->id)->count();
	      
	      if ($kas_terpakai > 0) {

	         $pesan_alert = 
	               "<div class='container-fluid'>
	                    <div class='alert-icon'>
	                    <i class='material-icons'>error</i>
	                    </div>
	                    <b>Gagal : $kas->nama_kas Sudah Terpakai Tidak Boleh Di Hapus</b>
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
