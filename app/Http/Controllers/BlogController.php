<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogPicture;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{

    /*** Public-facing stuff ***/

    /**
     * Display the public-facing blog entries
     *
     * @return \Illuminate\Http\Response
     */
    public function publicIndex()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('blog', compact('blogs'));
    }

    /**
     * Show an individual blog to the public
     * @param  string $slug The slug of the blog
     * @return \Illuminate\Http\Response
     */
    public function publicShow($slug)
    {
        $blog = Blog::where('slug', '=', $slug)->first();
        if (!$blog) {
            return response(404);
        }
        return view('blog_entry', compact('blog'));
    }

    /*** Admin Stuff ***/

    /**
     * Display the list of blog posts
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('admin.blog_index', compact('blogs'));
    }

    /**
     * Show the form for creating a new blog
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog = new Blog;
        return view('admin.blog_create', compact('blog'));
    }

    /**
     * Store a new blog
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blog;
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
        $blog->slug = str_slug(date('d-m-Y-') . $blog->title);
        $blog->save();
        return redirect('/admin/blog');
    }

    /**
     * Display the specific blog
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog_show', compact('blog'));
    }

    /**
     * Show the form for editing a blog post
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog_edit', compact('blog'));
    }

    /**
     * Update the specified blog
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
        $blog->slug = str_slug($blog->created_at->format('d-m-Y-') . $blog->title);
        $blog->save();
        return redirect('/admin/blog');
    }

    /**
     * Remove a blog and associated pictures (if any)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        foreach ($blog->pictures as $picture) {
            $picture->removeFile();
            $picture->delete();
        }
        $blog->delete();
        return redirect('/admin/blog');
    }
}
