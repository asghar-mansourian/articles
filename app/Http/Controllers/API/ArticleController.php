<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ArticleRequest;
use App\Http\Requests\API\ArticleUpdatRequest;
use App\Http\Resources\ArticlesResource;
use App\Models\Article;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except('show','index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy('created_at','desc')->paginate(10);

        return ArticlesResource::collection($articles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $picture = uploadFile($request->picture,'public/articles');

        Article::create([
            'author_id' => 1,//Auth::id(),
            'article_group_id' => $request->article_group_id,
            'slug' => str_replace(' ','-',$request->title),
            'title' => $request->title,
            'picture' => $picture,
            'content' => $request->content
        ]);
        return response()->json('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $article = Article::where('slug',$slug)->get();
        if($article)
            return ArticlesResource::collection($article);

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdatRequest $request, string $id)
    {
        $article = Article::findOrFail($id);

        $picture = file_exists($request->picture)? uploadFile($request->picture,'public/articles'):$article->picture;

        $article->update([
            'author_id' => 1,//Auth::id(),
            'article_group_id' => $request->article_group_id,
            'title' => $request->title,
            'slug' => str_replace(' ','-',$request->title),
            'picture' => $picture,
            'content' => $request->content
        ]);

        return ArticlesResource::collection($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        deleteFile($article->picture);
        $article->delete();
        return response()->json('success');
    }
}
