<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $guarded = ['id'];

    public function usrs()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function group()
    {
        return $this->belongsTo(ArticleGroup::class,'article_group_id');
    }
}
