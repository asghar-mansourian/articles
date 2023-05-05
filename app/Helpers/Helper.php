<?php
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadFile')) {
    function uploadFile($file,$path) {
        return $file->store($path);
    }
}

if (!function_exists('deleteFile')) {
    function deleteFile($file):void {
        Storage::delete($file);
    }
}
if (!function_exists('buildTree')) {
    function buildTree($comments)
    {
        $tree = [];

        foreach ($comments as $comment) {
            $node = [
                'id' => $comment->id,
                'user' => $comment->user->name,
                'message' => $comment->message,
                'like_dislike' => $comment->votes()->selectRaw('SUM(type = "like") as like_count, SUM(type = "dislike") as dislike_count')->first(),
                'replies' => buildTree($comment->replies),
            ];

            $tree[] = $node;
        }

        return $tree;
    }
}

?>
