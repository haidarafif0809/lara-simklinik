<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Suplier extends Model
{
    //
    use AuditableTrait;

    protected $fillable = ['nama_suplier','alamat_suplier','no_telp_suplier'];
}
