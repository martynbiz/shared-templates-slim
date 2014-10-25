<?php

namespace App\Models;

class Account extends BaseModel
{
    protected $fillable = array('name', 'amount', 'user_id');
    
    public function user()
    {
        return $this->belongsTo('User');
    }
}