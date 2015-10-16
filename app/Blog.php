<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function pictures()
    {
        return $this->hasMany(\App\BlogPicture::class);
    }
}
