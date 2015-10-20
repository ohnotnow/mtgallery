<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogPicture;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogPictureController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $blogId)
    {
        $blog = Blog::findOrFail($blogId);
        $file = $request->file('file');
        if (!$file) {
            return response(401);
        }
        $photo = new BlogPicture;
        $photo->createFromUpload($file, $blogId);
        $photo->save();
        return response(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($blogId, $id)
    {
        $photo = BlogPicture::findOrFail($id);
        $photo->removeFile();
        $photo->delete();
        return redirect('/admin/blog');
    }
}
