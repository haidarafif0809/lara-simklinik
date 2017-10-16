<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Poli extends Model
{
    //

    use AuditableTrait;


    protected $fillable = ['nama_poli'];
}
