<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';

    protected $guarded = ['id'];

    public function article()
    {
        return $this->belongsTo(Article::class,'article_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(self::class,'parent_id');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class,'modelable');
    }
}
