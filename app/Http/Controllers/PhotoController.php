<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->imageService->path(env('GOOD_PHOTO_PATH'));
    }

    public function upload(Request $request){

        $files = $request->file('images');

        $photos = array_map(function ($file){
            $name = $this->imageService->create($file);
            return ['src' => $name];
        }, $files);

        return $photos;
    }

    public function delete($photo){

//        $this->imageService->delete($photo);
        return true;
    }
}
