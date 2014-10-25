<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class BaseModel extends \Illuminate\Database\Eloquent\Model
{
    use SoftDeletingTrait;
}