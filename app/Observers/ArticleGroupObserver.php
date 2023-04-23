<?php

namespace App\Observers;

use App\Http\Controllers\API\ArticleController;
use App\Models\ArticleGroup;

class ArticleGroupObserver
{
    /**
     * Handle the ArticleGroup "created" event.
     */
    public function created(ArticleGroup $articleGroup): void
    {
        //
    }

    /**
     * Handle the ArticleGroup "updated" event.
     */
    public function updated(ArticleGroup $articleGroup): void
    {
        //
    }

    //before deleting article row delete article image
    public function deleting(ArticleGroup $articleGroup)
    {
        foreach ($articleGroup->articles as $article){
            deleteFile($article->picture);
        }
    }

    /**
     * Handle the ArticleGroup "deleted" event.
     */
    public function deleted(ArticleGroup $articleGroup): void
    {
        //
    }

    /**
     * Handle the ArticleGroup "restored" event.
     */
    public function restored(ArticleGroup $articleGroup): void
    {
        //
    }

    /**
     * Handle the ArticleGroup "force deleted" event.
     */
    public function forceDeleted(ArticleGroup $articleGroup): void
    {
        //
    }
}
