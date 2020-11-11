<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Comment;

class Post extends Model
{
    protected $fillable =['category_id', 'series_id', 'title', 'epn', 'upvideo', 'videxten', 'watchserversname', 'watchserverscode', 'downserversname', 'downserverslink', 'downloadoption', 'content', 'image', 'image_src','tags', 'views'];
    protected $guarded = [];

    //Relations
    //1-With Categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //2-With Series
    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    //3-With Comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
