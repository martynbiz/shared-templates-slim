<?php

namespace App\Models;

class User extends BaseModel
{
    protected $fillable = array('name', 'username', 'email', 'password', 'salt');
    
    public function account()
    {
        return $this->hasMany('Account');
    }
}