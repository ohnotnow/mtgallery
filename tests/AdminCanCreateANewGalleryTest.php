<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminCanCreateANewGalleryTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateGallery()
    {
        $user = factory(App\User::class)->make();
        $user->save();

        $this->actingAs($user)
             ->visit('/admin')
             ->see('Current Galleries')
             ->click('Add Gallery')
             ->see('New Gallery')
             ->type('TESTGALLERY', 'name')
             ->press('submit')
             ->see('Photographs in')
             ->see('TESTGALLERY');
    }

    public function testAdminCanViewAGallery()
    {
        $user = factory(App\User::class)->make();
        $user->save();
        $gallery = factory(App\Gallery::class)->make();
        $gallery->save();

        $this->actingAs($user)
             ->visit('/admin')
             ->see('Current Galleries')
             ->click($gallery->name)
             ->see('Photographs in')
             ->see($gallery->name);
    }

    public function testAdminCanEditAGallery()
    {
        $user = factory(App\User::class)->make();
        $user->save();
        $gallery = factory(App\Gallery::class)->make();
        $gallery->save();

        $this->actingAs($user)
             ->visit('/admin')
             ->see('Current Galleries')
             ->click($gallery->name)
             ->see('Photographs in')
             ->see($gallery->name)
             ->click($gallery->name)
             ->see('Edit Gallery')
             ->see($gallery->name)
             ->type('RENAMED GALLERY', 'name')
             ->press('submit')
             ->see('RENAMED GALLERY')
             ->see('Photographs in');
    }

    public function testAdminCanDeleteAGallery()
    {
        $user = factory(App\User::class)->make();
        $user->save();
        $gallery = factory(App\Gallery::class)->make();
        $gallery->save();

        $this->actingAs($user)
             ->visit('/admin')
             ->see('Current Galleries')
             ->see($gallery->name)
             ->click($gallery->name)
             ->see('Photographs in')
             ->see($gallery->name)
             ->click($gallery->name)
             ->press('Delete Gallery')
             ->see('Current Galleries')
             ->dontSee($gallery->name);
    }
}
