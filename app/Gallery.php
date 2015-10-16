<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Gallery extends Model
{
    protected $fillable = ['name'];

    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }
}
