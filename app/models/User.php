<?php

namespace App\Models;

class User extends BaseModel
{
    protected $fillable = array('name', 'username', 'email', 'password', 'salt');
    
    public function accounts()
    {
        return $this->hasMany('\App\Models\Account');
    }
}