<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Gallery;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    /**
     * Show all the photo's we currently have
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::with('galleries')->orderBy('created_at', 'desc')->get();
        return view('admin.photo_index', compact('photos'));
    }

    /**
     * Add a new photo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        if (!$file) {
            return response(401);
        }
        $photo = new Photo;
        $photo->createFromUpload($file);
        $photo->save();
        return response(200);
    }

    /**
     * Edit an existing photo
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        $galleries = Gallery::orderBy('name')->get();
        return view('admin.edit_photo', compact('photo', 'galleries'));
    }

    /**
     * Update a photo
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);
        $photo->name = $request->input('name');
        $photo->galleries()->sync($request->input('galleries'));
        $photo->save();
        return redirect('/admin/photo');
    }

    /**
     * Delete a photo
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        if (file_exists($photo->fullPath())) {
            unlink($photo->fullPath());
        }
        $photo->delete();
        return redirect('/admin/photo');
    }
}
