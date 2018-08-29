<?php
namespace App\Helpers\ImageStore;

use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Http\Response;

class ImageStore {

    public static function getImage($path) {
        if (Storage::disk()->exists($path)){
            $file = Storage::disk()->get($path);
            return response($file,200)->header('Content-Type', 'image/png');
        }
        return Image::make(public_path('img/avatar_default.jpg'))->response();
    }
}