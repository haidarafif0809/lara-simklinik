<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;



class Penjamin extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['nama_penjamin','alamat_penjamin','no_telp_penjamin','level_harga'];



}
