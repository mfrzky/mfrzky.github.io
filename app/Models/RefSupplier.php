<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefSupplier extends Model
{
    use HasFactory;

    protected $table = 'PCL_REFSUPPLIER';

    public function userEmail() {
        return $this->belongsTo('App\Models\RefSupplierEmail');
    }
}
