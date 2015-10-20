<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminCanAddEditAndRemoveAPhotoTest extends TestCase
{
    use DatabaseTransactions;

    public function testViewListOfAllPhotos()
    {
        $user = factory(App\User::class)->make();
        $user->save();

        $this->actingAs($user)
             ->visit('/admin')
             ->click('Photographs')
             ->see('Index of All Photos');
    }

    public function testEditAPhoto()
    {
        $user = factory(App\User::class)->make();
        $user->save();
        $gallery = factory(App\Gallery::class)->make();
        $gallery->save();
        $photo = factory(App\Photo::class)->make();
        $photo->save();
        $input = [
            'name' => 'NEWNAME',
            'galleries' => [$gallery->id],
        ];
        $this->actingAs($user)
             ->visit('/admin')
             ->click('Photographs')
             ->see('Index of All Photos')
             ->click("photo_{$photo->id}")
             ->see('Edit Photo')
             ->see($photo->name)
             ->submitForm('Save Changes', $input)
             ->see('Index of All Photos')
             ->see('NEWNAME');
    }

    public function testDeleteAPhoto()
    {
        $user = factory(App\User::class)->make();
        $user->save();
        $gallery = factory(App\Gallery::class)->make();
        $gallery->save();
        $photo = factory(App\Photo::class)->make();
        $photo->save();
        $photo->galleries()->sync([$gallery->id]);
        $this->actingAs($user)
             ->visit('/admin')
             ->click('Photographs')
             ->see('Index of All Photos')
             ->see($photo->name)
             ->click("photo_{$photo->id}")
             ->see('Edit Photo')
             ->see($photo->name)
             ->press('Delete Photograph')
             ->see('Index of All Photos')
             ->dontSee($photo->name);
    }
}
