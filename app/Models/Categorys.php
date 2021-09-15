<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorys extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'published_at'];

    public function posts()
    {

        return $this->hasMany(Post::class, 'posts_id', 'id');
    }
}
