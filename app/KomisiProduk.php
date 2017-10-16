<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;


class KomisiProduk extends Model
{
    //
use AuditableTrait;

    protected $fillable = ['produk','petugas','prosentase','nominal'];
    protected $primaryKey = 'id_komisi';

    public function petugas(){
   		return $this->hasOne('App\User','id','petugas');
   	} 
   	public function produk(){
   		return $this->hasOne('App\Produk','id','produk');
   	}

}
