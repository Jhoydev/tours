<?php

namespace App\Http\Controllers;

use App\Helpers\ImageStore\ImageStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function publicBackgrounds()
    {

        $files = scandir(public_path('img/backgrounds/thumbs'));
        $res   = [];
        foreach ($files as $f) {
            if ($f != "." && $f != "..") {
                array_push($res, asset('img/backgrounds/thumbs' . '/' . $f));
            }
        }
        return $res;
    }

    public function flyer($company, $event, $filename)
    {
        return ImageStore::getImage("companies/$company/events/$event/flyer/$filename");
    }

}
