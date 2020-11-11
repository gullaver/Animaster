<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
   protected $fillable =['sitename', 'footerabout', 'facebook', 'twitter', 'youtube', 'vimo', 'facebookcomments', 'localcomments', 'facecomcode'];
}
