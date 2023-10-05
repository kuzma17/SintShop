<?php

namespace App\Services;

use App\Services\Contracts\ImageServiceInterface;
use phpDocumentor\Reflection\Types\This;

class ImageService implements ImageServiceInterface
{
    protected $path;
    protected $width;
    protected $height;
    protected $format;
    protected $quality;

    public function __construct(){
        $this->path('/images');
        //$this->size(800, 800);
        $this->format('jpg');
        $this->quality(90);
    }

    public function size($width, $height)
    {
       $this->width = $this->getWidth($width);
       $this->height = $this->getHeight($height);
    }

    public function path($path)
    {
        $this->path = $this->getPath($path);
    }

    public function format($format)
    {
        $this->format = $format;
    }

    public function quality($quality)
    {
        $this->quality = $this->getQuality($quality);
    }

    protected function getRandomName(){
        return bin2hex(random_bytes(10)).'.'.$this->format;
    }

    protected function getName($name){
        if ($name){
//            return $name.'.'.$this->format;
            return $name;
        }
        return $this->getRandomName();
    }

    protected function getNamefromImage($mage){
        $source = explode('.', $mage);
        return $source[0];
    }

    protected function getPath($path){
        if ($path){
            $path = ($path[-1] == '/')? $path: $path.'/';
            return public_path($path);
        }
        return $this->path;
    }

    protected function getWidth($width){
        if ($width){
            return (int)$width;
        }
        return $this->width;
    }

    protected function getHeight($height){
        if ($height){
            return (int)$height;
        }
        return $this->height;
    }

    protected function getQuality($quality){
        if ($quality){
            return (int)$quality;
        }
        return $this->quality;
    }

    protected function getFormat($format){
        if($format){
            return $format;
        }
        return $this->format;
    }

    public function create($image, $name = null, $width = null, $height = null, $path = null, $format = null, $quality = null)
    {
        $name = $this->getName($name);
        $width = $this->getWidth($width);
        $height = $this->getHeight($height);
        $path = $this->getPath($path);
        $format = $this->getFormat($format);
        $quality = $this->getQuality($quality);

        $img = \Image::make($image);

        if ($width && $height){
            $img->fit($width, $height);
        }

        $img->save($path.$name, $quality, $format);

        return $name;
    }

    public function createGoodPhotos($image){

        //$name = $this->getNamefromImage($image);

        $name = $image;

        $this->size(800, 800);
        $this->create($this->path.$image,'big_'.$name);
        $this->size(400, 400);
        $name_img = $this->create($this->path.$image, $name);
        $this->size(100, 100);
        $this->create($this->path.$image,'small_'.$name);

        return $name_img;
    }

    protected function deleteImage($image){

        if (file_exists($image)){
            unlink($image);
        }
    }

    public function delete($image){

        $img = $this->path.$image;
        $img_big = $this->path.'big_'.$image;
        $img_small = $this->path.'small_'.$image;

        file_put_contents('/home/cboyezmz/shop.sint.odessa.ua/ajaxDebug.log',  $img);

        $this->deleteImage($img);
        $this->deleteImage($img_big);
        $this->deleteImage($img_small);
    }

}
