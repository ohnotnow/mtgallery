<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Gallery extends Model
{
    protected $fillable = ['name'];

    /**
     * List of photo's in this gallery
     * @return Relation
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }
}
