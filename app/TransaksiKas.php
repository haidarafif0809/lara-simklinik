<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class TransaksiKas extends Model
{
    //

    use AuditableTrait;

        protected $fillable = ['no_faktur','jenis_transaksi','tipe_transaksi','jumlah_masuk' ,'jumlah_keluar' ,'kas' ];

}
