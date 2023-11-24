<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;

    protected $table = 'VDR_SURATJALAN';
    public $timestamps = false;
    protected $fillable = ['IDSUPPLIER', 'TANGGAL', 'IDPO', 'NOSJ', 'STATUS', 'CREATEDAT'];
}
