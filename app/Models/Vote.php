<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $tabl = 'votes';

    protected $guarded = ['id'];

    public function modlable()
    {
        return $this->morphTo('modelable');
    }
}
