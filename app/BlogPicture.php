<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class BlogPicture extends Model
{

    public function blog()
    {
        return $this->belongsTo(\App\Blog::class);
    }

    /**
     * Get the directory in public/ that we will upload images too via the .env file
     * @return string
     */
    public function baseDir()
    {
        $dir = env('IMAGE_DIR');
        if (!$dir) {
            abort(501, 'No IMAGE_DIR set');
        }
        if (!preg_match('/\/$/', $dir)) {
            $dir = "$dir/";
        }
        return $dir;
    }

    public function createFromUpload($file, $blogId)
    {
        $newFilename = $this->makeSafeFilename($file);
        $file->move($this->baseDirectory(), $newFilename);
        $this->filename = $newFilename;
        $this->makeFullsizeImage();
        $this->makeThumbnailImage();
        $this->blog_id = $blogId;
        return $this;
    }

    public function thumbnailPath()
    {
        return $this->baseDir() . 'tn_' . $this->filename;
    }

    public function imagePath()
    {
        return $this->baseDir() . $this->filename;
    }

    public function baseDirectory()
    {
        return public_path() . '/' . $this->baseDir();
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

    public function makeFullsizeImage($maxWidth = 1024, $maxHeight = 1024)
    {
        $tag = env('APP_COPYRIGHT', '(C) Monkeytwizzle Photography');
        return Image::make($this->fullPath())->resize($maxWidth, $maxHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->text($tag, 12, 22, function ($font) {
            $font->color([0, 0, 0, 0.5]);
            $font->align('left');
            $font->valign('bottom');
        })->text($tag, 10, 20, function ($font) {
            $font->color([255, 255, 255, 0.5]);
            $font->align('left');
            $font->valign('bottom');
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
        if (file_exists($this->imagePath())) {
            unlink($this->imagePath());
        }
    }
}
