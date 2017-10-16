<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Pasien extends Model
{
    //
use AuditableTrait;

    protected $fillable = ['nama_pasien','alamat_pasien','no_telp_pasien','jenis_kelamin'];

    

}
