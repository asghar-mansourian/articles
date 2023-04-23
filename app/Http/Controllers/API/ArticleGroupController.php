<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ArticleGroupRequest;
use App\Http\Resources\ArticleGroupResource;
use App\Models\ArticleGroup;
use Illuminate\Http\Request;

class ArticleGroupController extends Controller
{
    public function index()
    {
        $articleGroups = ArticleGroup::with('articles')->get();

        return ArticleGroupResource::collection($articleGroups);
    }

    public function store(ArticleGroupRequest $request)
    {
        $articleGroup = ArticleGroup::create([
            'name' => $request->name
        ]);

        return response()->json([
            'data' => $articleGroup,
            'message' => 'success'
        ],200);
    }

    public function update(ArticleGroupRequest $request,ArticleGroup $articleGroup)
    {
        $articleGroup->update([
            'name' => $request->name
        ]);

        return response()->json([
            'data' => $articleGroup,
            'message' => 'success'
        ],200);
    }

    public function show($id)
    {
        $articleGroup = ArticleGroup::where('id',$id)->with('articles')->first();
        return response()->json([
            'data' => $articleGroup,
        ],200);
    }
    public function destroy(ArticleGroup $articleGroup)
    {
        $articleGroup->delete();
        return response()->json('success');
    }
}
