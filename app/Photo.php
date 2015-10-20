<?php

namespace App;

use App\Gallery;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Photo extends Model
{
    protected $fillable = ['name', 'filename'];

    protected $baseDir = 'mt_photos/';

    public function galleries()
    {
        return $this->belongsToMany(Gallery::class)->orderBy('name');
    }

    public function galleryList()
    {
        return $this->galleries()->lists('gallery_id')->toArray();
    }

    public function createFromUpload($file)
    {
        $newFilename = $this->makeSafeFilename($file);
        $file->move($this->baseDirectory(), $newFilename);
        $this->filename = $newFilename;
        $this->makeFullsizeImage();
        $this->makeThumbnailImage();
        return $this;
    }

    public static function getRecent($numberOfImages = 20)
    {
        return static::orderBy('updated_at', 'desc')->take($numberOfImages)->get();
    }

    public function thumbnailPath()
    {
        return $this->baseDir . '/tn_' . $this->filename;
    }

    public function imagePath()
    {
        return $this->baseDir . $this->filename;
    }

    public function imageUrl()
    {
        return asset($this->imagePath());
    }

    public function baseDirectory()
    {
        return public_path() . '/' . $this->baseDir;
    }

    public function fullPath($filename = null)
    {
        if ($filename == null) {
            $filename = $this->filename;
        }
        return $this->baseDirectory() . $filename;
    }

    public function makeSafeFilename($file)
    {
        $newFilename = preg_replace('/[^a-zA-Z0-9]/', '_', microtime() . $file->getClientOriginalName());
        return $newFilename . '.' . $file->getClientOriginalExtension();
    }

    public function makeThumbnailFilename($filename = null)
    {
        if ($filename == null) {
            $filename = $this->filename;
        }
        return $this->baseDirectory() . 'tn_' . $filename;
    }

    public function makeFullsizeImage($maxWidth = 1280, $maxHeight = 1280)
    {
        return Image::make($this->fullPath())->resize($maxWidth, $maxHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save();
    }

    public function makeThumbnailImage($maxWidth = 160, $maxHeight = 160)
    {
        return Image::make($this->fullPath())->resize($maxWidth, $maxHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($this->makeThumbnailFilename());
    }

    public function removeFile()
    {
        if (file_exists($this->fullPath())) {
            unlink($this->fullPath());
        }
    }

    public function attachToGalleries($galleryList)
    {
        if (!$galleryList) {
            $galleryList = [];
        }
        $this->galleries()->sync($galleryList);
    }
}
