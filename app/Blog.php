<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function pictures()
    {
        return $this->hasMany(\App\BlogPicture::class);
    }

    public function createSlug()
    {
        if (!$this->created_at) {
            $this->created_at = Carbon::now();
        }
        return str_slug($this->created_at->format('d-m-Y-') . $this->title);
    }

    public function removePictures()
    {
        foreach ($this->pictures as $picture) {
            $picture->removeFile();
            $picture->delete();
        }
    }
}
