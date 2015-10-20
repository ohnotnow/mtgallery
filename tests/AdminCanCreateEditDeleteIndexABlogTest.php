<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminCanCreateEditDeleteIndexABlogTest extends TestCase
{
    use DatabaseTransactions;

    public function testAdminCanViewBlogList()
    {
        $user = factory(App\User::class)->make();
        $user->save();

        $this->actingAs($user)
             ->visit('/admin')
             ->click('Blogs')
             ->see('List of Blog Entries');
    }

    public function testAdminCanAddANewBlog()
    {
        $user = factory(App\User::class)->make();
        $user->save();

        $this->actingAs($user)
             ->visit('/admin')
             ->click('Blogs')
             ->see('List of Blog Entries')
             ->click('Add Blog')
             ->see('New Blog')
             ->type('TESTEROO', 'title')
             ->type('WHATEVAH', 'body')
             ->press('submit')
             ->see('List of Blog Entries')
             ->see('TESTEROO');
    }

    public function testAdminCanEditABlog()
    {
        $user = factory(App\User::class)->make();
        $user->save();
        $blog = factory(App\Blog::class)->make();
        $blog->save();

        $this->actingAs($user)
             ->visit('/admin')
             ->click('Blogs')
             ->see($blog->title)
             ->click($blog->title)
             ->see('Edit Blog')
             ->type('AHAHAHAHAH', 'title')
             ->type('WHATEVAH', 'body')
             ->press('submit')
             ->see('List of Blog Entries')
             ->see('AHAHAHAHAH')
             ->dontSee($blog->title);
    }

    public function testAdminCanDeleteABlog()
    {
        $user = factory(App\User::class)->make();
        $user->save();
        $blog = factory(App\Blog::class)->make();
        $blog->save();

        $this->actingAs($user)
             ->visit('/admin')
             ->click('Blogs')
             ->see($blog->title)
             ->click($blog->title)
             ->click('Delete Blog')
             ->dontSee($blog->title);
    }
}
