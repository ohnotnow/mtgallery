<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PublicCanViewTheFrontFacingContentTest extends TestCase
{
    use DatabaseTransactions;

    public function testPublicCanViewTheHomepage()
    {
        $this->visit('/')
             ->see('Monkeytwizzle Photography')
             ->see('Blog')
             ->see('Glasgow');
    }

    public function testPublicCanViewTheBlog()
    {
        $blog = factory(App\Blog::class)->make();
        $blog->save();
        $this->visit('/')
             ->click('Blog')
             ->see($blog->title)
             ->click($blog->title)
             ->see($blog->title)
             ->see($blog->body);
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
