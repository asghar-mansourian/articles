<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('API')->group(function(){

    Route::post('/login','LoginController@login')->name('login');

    Route::resource('articles',ArticleController::class);
    Route::get('articles/show-comments/{article}','ArticleController@showComments');

    Route::resource('article-groups',ArticleGroupController::class);

    Route::resource('comments',CommentController::class);

    Route::middleware('auth:sanctum')->group(function (){
        Route::post('vote','VoteController');
    });

    Route::get('/login',function (){
        return response()->json('you must login!');
    });
    Route::post('/logout','LoginController@logout')->name('logout');

});
