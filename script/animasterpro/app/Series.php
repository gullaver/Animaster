<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Post;

class Series extends Model
{
    protected $fillable =['category_id', 'seriesname', 'image', 'image_src','content'];
    protected $guarded = [];

    //Relations
    //1-With Categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //2-With posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
