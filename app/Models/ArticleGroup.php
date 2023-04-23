<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleGroup extends Model
{
    use HasFactory;

    protected $table = 'article_groups';

    protected $guarded = ['id'];

    public function articles()
    {
        return $this->hasMany(Article::class,'article_group_id');
    }

}
