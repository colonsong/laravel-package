<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'published_at'];

    public function imageable()
    {
        /**
         * @param  string $name 与数据库的 imageable 前缀保持一致,并且方法名要与之一致
         * @param  string $type 与数据库的 imageable_type 字段保持一致
         * @param  string $id   与数据库的 imageable_id 字段保持一致
         */
        return $this->morphTo('imageable' , 'imageable_type' , 'imageable_id');
    }



    public function post()
    {
        /**
         * Post::class related 关联模型
         * imageable_id ownerKey 当前表关联字段
         * id relation 关联表字段
         */
        return $this->belongsTo('App\Models\Post' , 'imageable_id' , 'id');
    }


    public function user()
    {
        /**
         * Post::class related 关联模型
         * imageable_id ownerKey 当前表关联字段
         * id relation 关联表字段
         */
        return $this->belongsTo('App\Models\Post' , 'imageable_id' , 'id');
    }



}
