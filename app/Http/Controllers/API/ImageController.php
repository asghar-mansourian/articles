<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ImageRequest;
use App\Models\Image;

class ImageController extends Controller
{
    public function upload(ImageRequest $request)
    {
        $url = uploadFile($request->image,'public/articles');
        $url = url('/') . '/storage/articles/' . basename($url);
        return response()->json(['url' => $url],200);
    }

    public function destroy($name)
    {
        $image = Image::where('name',$name)->first();

        if($image){
            deleteFile($image->name);
            $image->delete();
            return response()->json('success');
        }

        return response()->json('not found',404);
    }
}
