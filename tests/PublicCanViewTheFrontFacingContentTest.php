<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PublicCanViewTheFrontFacingContentTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function testPublicCanViewTheHomepage()
    {
        $this->visit('/')
             ->see(env('APP_TITLE'))
             ->see('Blog');
    }

    public function testPublicCanViewTheBlog()
    {
        $blog = factory(App\Blog::class)->make();
        $blog->save();
        $blog2 = factory(App\Blog::class)->create(['publish_at' => \Carbon\Carbon::now()->addYear()]);
        $this->visit('/')
             ->click('Blog')
             ->see($blog->title)
             ->dontSee($blog2->title)
             ->click($blog->title)
             ->see($blog->title)
             ->see($blog->body);
    }

    public function testPublicCanViewTheBlogRssFeed()
    {
        $blog = factory(App\Blog::class)->make();
        $blog->save();
        $blog2 = factory(App\Blog::class)->create(['publish_at' => \Carbon\Carbon::now()->addYear()]);
        $this->visit('/blog/feed')
             ->see($blog->title)
             ->dontSee($blog2->title);
    }

    public function testPublicCanViewThePhotographs()
    {
        $photo = factory(App\Photo::class)->make();
        $photo->save();

        $this->visit('/')
             ->click('Photographs')
             ->see($photo->name);
    }
}
