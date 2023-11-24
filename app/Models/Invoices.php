<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;

    protected $table = 'VDR_INVOICE';
    public $timestamps = false;
    protected $fillable = ['TANGGAL' , 'IDCURRENCY', 'TAX_NOFAKTUR', 'TAX_TANGGAL'];
}
