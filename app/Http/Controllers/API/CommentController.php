<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function store(CommentRequest $request)
    {
        $article = Article::findOrFail($request->article_id);
        $article->comments()->create([
            'user_id' => auth()->user()->id,
            'parent_id' => $request->parent_id??null,
            'message' => $request->message,
        ]);

        $comments = $article->comments()->where('parent_id',null)->get();

        return response()->json([
            'data' => buildTree($comments)
        ],200);
    }

    public function update(Request $request,Comment $comment)
    {
        $article = Article::findOrFail($request->aricle_id);
        $comment->update([
            'user_id' => auth()->user()->id,
            'article_id' => $request->article_id,
            'parent_id' => $request->parent_id??null,
            'message' => $request->message,
        ]);

        $comments = $article->comments()->where('parent_id',null)->get();

        return response()->json([
            'data' => buildTree($comments)
        ],200);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json('success',200);
    }
}
