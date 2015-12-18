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
        $photo->attachToGalleries($request->input('galleries'));
        $photo->save();
        return redirect()->route('admin.index_photos');
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
        $photo->removeFile();
        $photo->delete();
        return redirect()->route('admin.index_photos');
    }

    public function bulkEdit()
    {
        $photos = Photo::with('galleries')->orderBy('created_at', 'desc')->get();
        $galleries = Gallery::orderBy('name')->get();
        return view('admin.photo_bulk_edit', compact('photos', 'galleries'));
    }

    public function bulkUpdate(Request $request)
    {
        foreach ($request->name as $id => $name) {
            $photo = Photo::findOrFail($id);
            $photo->name = $name;
            $photo->save();
            if ($request->has("galleries.$id")) {
                $photo->galleries()->sync($request->galleries[$id]);
            }
        }
        return redirect()->route('admin.index_photos');
    }
}
