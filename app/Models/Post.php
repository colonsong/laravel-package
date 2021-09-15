<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'user_id', 'body', 'published_at', 'categorys_id'];

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function comments()
    {

        return $this->hasMany(Comment::class, 'posts_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Categorys::class, 'categorys_id', 'id');
    }
}
