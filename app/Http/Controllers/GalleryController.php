<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Gallery;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{

    /*** Admin stuff ***/

    /**
     * Show the form for creating a new gallery
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gallery = new Gallery;
        return view('admin/create_gallery', compact('gallery'));
    }

    /**
     * Store a new gallery
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        if (!$name) {
            return back()->withInput();
        }
        $gallery = new Gallery;
        $gallery->name = $name;
        $gallery->slug = str_slug($name);
        $gallery->save();
        return redirect('/admin');
    }

    /**
     * Display a specific gallery
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::with('photos')->findOrFail($id);
        return view('admin.show_gallery', compact('gallery'));
    }

    /**
     * Edit an existing gallery
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.edit_gallery', compact('gallery'));
    }

    /**
     * Update a given gallery
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        if (!$name) {
            return back()->withInput();
        }
        $gallery = Gallery::findOrFail($id);
        $gallery->name = $name;
        $gallery->slug = str_slug($name);
        $gallery->save();
        return redirect('/admin/gallery/' . $gallery->id);
    }

    /**
     * Delete a gallery
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::destroy($id);
        return redirect('/admin');
    }

    /*** Public facing stuff ***/

    /**
     * Show the most recent photo's added to the system
     * @return \Illuminate\Http\Response
     */
    public function showRecent()
    {
        $galleries = Gallery::orderBy('name')->get();
        $json = $this->getPhotosAsJson(Photo::getRecent());
        $pageTitle = ' - Recent Photographs';
        return view('slideshow', compact('json', 'galleries', 'pageTitle'));
    }

    /**
     * Show the photo's for a specific gallery
     * @param  string $slug The gallery slug name
     * @return \Illuminate\Http\Response
     */
    public function showGallery($slug)
    {
        $galleries = Gallery::orderBy('name')->get();
        $gallery = Gallery::where('slug', '=', $slug)->first();
        if (!$gallery) {
            return response(404);
        }
        $json = $this->getPhotosAsJson($gallery->photos);
        $pageTitle = " - {$gallery->name}";
        return view('slideshow', compact('json', 'galleries', 'pageTitle'));
    }

    private function getPhotosAsJson($photos)
    {
        $photosArray = [];
        foreach ($photos as $photo) {
            $photosArray[] = [
                'image' => $photo->imageUrl(),
                'title' => $photo->name,
            ];
        }
        return json_encode($photosArray);
    }
}
