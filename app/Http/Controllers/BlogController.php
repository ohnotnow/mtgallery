<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogPicture;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Roumen\Feed\Facades\Feed;

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
            abort(404);
        }
        return view('blog_entry', compact('blog'));
    }

    /**
     * Return the atom/rss feed of the blog
     * @return atom/rss string
     */
    public function rssFeed()
    {
        $feed = Feed::make();
        $feed->setCache(60, 'mtgalleryFeedKey');
        if (!$feed->isCached()) {
            $blogs = Blog::orderBy('created_at', 'desc')->get();
            $feed->title = env('APP_TITLE') . ' - Blog';
            $feed->description = env('BLOG_DESCRIPTION');
            $feed->link = route('blog.rss');
            $feed->setDateFormat('datetime');
            $feed->pubdate = $blogs[0]->created_at;
            $feed->lang = 'en';
            $feed->setShortening(true);
            $feed->setTextLimit(100);
            foreach ($blogs as $blog) {
                $feed->add($blog->title, 'Me', route('blog.view', ['slug' => $blog->slug]), $blog->created_at, $blog->body, $blog->body);
            }
        }
        return $feed->render('atom');
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
        $blog->slug = $blog->createSlug();
        $blog->save();
        return redirect()->route('admin.show_blog', $blog->id);
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
        $blog->slug = $blog->createSlug();
        $blog->save();
        return redirect()->route('admin.show_blog', $blog->id);
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
        $blog->removePictures();
        $blog->delete();
        return redirect()->route('admin.index_blogs');
    }
}
