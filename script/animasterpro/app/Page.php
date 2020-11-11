<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Page extends Model
{
    protected $fillable = ['pagename', 'pagecontent', 'pagesorder'];
    protected $guarded = [];
}
