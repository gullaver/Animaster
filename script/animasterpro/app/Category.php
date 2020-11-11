<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Category extends Model
{
    protected $fillable = ['name', 'catename', 'description'];
    protected $guarded = [];
    
    //Relations

    //1-With Series
    public function serieses()
    {
        return $this->hasMany(Series::class);
    }

    //2-With posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
