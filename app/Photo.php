<?php

namespace App;

use App\Gallery;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Photo extends Model
{
    protected $fillable = ['name', 'filename'];

    protected $baseDir = 'mt_photos/';

    /**
     * Return which galleries this photo is in
     * @return Collection
     */
    public function galleries()
    {
        return $this->belongsToMany(Gallery::class)->orderBy('name');
    }

    /**
     * Get an array of just the gallery ID this photo is associated with (for populating html selects)
     * @return array
     */
    public function galleryList()
    {
        return $this->galleries()->lists('gallery_id')->toArray();
    }

    /**
     * Create a new file from an http upload (probably from dropzone.js) and store the image file and thumbnail
     * @param  UploadedFile $file The file we got via the http post in a $request
     * @return Photo       An instance of Photo filled in with the data from the request
     */
    public function createFromUpload($file)
    {
        $newFilename = $this->makeSafeFilename($file);
        $file->move($this->baseDirectory(), $newFilename);
        $this->filename = $newFilename;
        $this->makeFullsizeImage();
        $this->makeThumbnailImage();
        return $this;
    }

    /**
     * Get recent photo's
     * @param  integer $numberOfImages Maximum number of images to return
     * @return Collection
     */
    public static function getRecent($numberOfImages = 20)
    {
        return static::orderBy('updated_at', 'desc')->take($numberOfImages)->get();
    }

    /**
     * Get the path to the thumbnail of the image
     * @return string
     */
    public function thumbnailPath()
    {
        return $this->baseDir . '/tn_' . $this->filename;
    }

    /**
     * Get the path to the full-size image
     * @return string
     */
    public function imagePath()
    {
        return $this->baseDir . $this->filename;
    }

    /**
     * Get the url to the image
     * @return string
     */
    public function imageUrl()
    {
        return asset($this->imagePath());
    }

    /**
     * Get the default base path for storing photo's
     * @return [type] [description]
     */
    public function baseDirectory()
    {
        return public_path() . '/' . $this->baseDir;
    }

    /**
     * Get the full filesystem path to the Photo
     * @param  mixed $filename Name of the file to get the path for (or null)
     * @return string
     */
    public function fullPath($filename = null)
    {
        if ($filename == null) {
            $filename = $this->filename;
        }
        return $this->baseDirectory() . $filename;
    }

    /**
     * Strip out any 'dodgy' characters from the supplied filename and return a sanitised version with a timestamp
     * @param  string $file The original filename
     * @return string       The new filename
     */
    public function makeSafeFilename($file)
    {
        $newFilename = preg_replace('/[^a-zA-Z0-9]/', '_', microtime() . $file->getClientOriginalName());
        return $newFilename . '.' . $file->getClientOriginalExtension();
    }

    /**
     * Make a thumbnail filename (used for saving the thumbnail to disk)
     * @param  string $filename Filename to use or null and it'll use the models filename
     * @return string
     */
    public function makeThumbnailFilename($filename = null)
    {
        if ($filename == null) {
            $filename = $this->filename;
        }
        return $this->baseDirectory() . 'tn_' . $filename;
    }

    /**
     * Make a full-size copy of the uploaded image
     * @param  integer $maxWidth  Maximum width for the copy
     * @param  integer $maxHeight Maximum height for the copy
     */
    public function makeFullsizeImage($maxWidth = 1280, $maxHeight = 1280)
    {
        return Image::make($this->fullPath())->resize($maxWidth, $maxHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save();
    }

    /**
     * Make a thumbnail of the uploaded image
     * @param  integer $maxWidth  Maximum width of the thumbnail
     * @param  integer $maxHeight Maximum height of the thumbnail
     */
    public function makeThumbnailImage($maxWidth = 160, $maxHeight = 160)
    {
        return Image::make($this->fullPath())->resize($maxWidth, $maxHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($this->makeThumbnailFilename());
    }

    /**
     * Delete the actual file from disk
     */
    public function removeFile()
    {
        if (file_exists($this->fullPath())) {
            unlink($this->fullPath());
        }
    }

    /**
     * Sync the list of galleries this photo is attached to
     * @param  array $galleryList The list of gallery id's
     */
    public function attachToGalleries($galleryList)
    {
        if (!$galleryList) {
            $galleryList = [];
        }
        $this->galleries()->sync($galleryList);
    }
}
