<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * Get the associated pictures for this blog
     * @return Collection
     */
    public function pictures()
    {
        return $this->hasMany(\App\BlogPicture::class);
    }

    /**
     * Create a uniform slug for the blog post
     * @return string A slug
     */
    public function createSlug()
    {
        if (!$this->created_at) {
            $this->created_at = Carbon::now();
        }
        return str_slug($this->created_at->format('d-m-Y-') . $this->title);
    }

    /**
     * Remove the files and records for pictures associated with this blog
     */
    public function removePictures()
    {
        foreach ($this->pictures as $picture) {
            $picture->removeFile();
            $picture->delete();
        }
    }

    /**
     * Parse the blog body as markdown and return the html result
     * @return string HTML version of the markdown
     */
    public function getBody()
    {
        return Markdown::convertToHtml($this->body);
    }
}
