<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;

class Comment extends Model
{
    protected $fillable = ['post_id', 'user_id', 'value', 'role'];

    protected $guarded =[];

    //Relationships
    //1-With Posts
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    //2-With Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
