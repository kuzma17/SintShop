<?php

namespace App\Services\Contracts;

interface ImageServiceInterface{

    public function size($width, $height);
    public function path($path);
    public function format($format);
    public function quality($quality);
    public function create($image, $name = null, $width = null, $height = null, $path = null, $format = null, $quality = null);
    public function createGoodPhotos($image);
    public function delete($image);
}
