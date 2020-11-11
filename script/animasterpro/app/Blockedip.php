<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blockedip extends Model
{
    protected $fillable = ['ip_address'];
}
