<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class RefSupplierEmail extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;
    use HasFactory;

    protected $table = 'PCL_REFSUPPLIEREMAIL';

    protected $fillable = [
        'EMAIL', 'PASSWORD', 'LAST_LOGIN_AT', 'LAST_LOGIN_IP'
    ];
    
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }
}

