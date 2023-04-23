<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $guarded = ['id'];

    const STATUS_PUBLISHED = 1;

    const STATUS_UNPUBLISHED = 0;

    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function group()
    {
        return $this->belongsTo(ArticleGroup::class,'article_group_id');
    }

//    protected static function booted()
//    {
//        static::addGlobalScope('published', function(Builder $builder) {
//            $builder->where('status', Article::STATUS_PUBLISHED);
//        });
//    }
}
