<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['topic_id', 'user_id', 'content'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postLikes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function likesCount()
    {
        return $this->postLikes()->where('type', 'like')->count();
    }

    public function dislikesCount()
    {
        return $this->postLikes()->where('type', 'dislike')->count();
    }
    public function replies()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }
}
