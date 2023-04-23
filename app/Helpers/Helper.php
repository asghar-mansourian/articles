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

?>
