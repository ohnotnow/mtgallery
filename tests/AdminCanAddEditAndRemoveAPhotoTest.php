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

    public function testCanBulkUpdatePhotos()
    {
        $user = factory(App\User::class)->create();
        $gallery = factory(App\Gallery::class)->create();
        $gallery2 = factory(App\Gallery::class)->create();
        $photo = factory(App\Photo::class)->create();
        $photo->galleries()->sync([$gallery->id]);
        $newData = [
            'name' => [ $photo->id => 'QPQPQPQP' ],
            "galleries[{$photo->id}]" => [$gallery->id, $gallery2->id]
        ];
        var_dump($newData);
        $this->actingAs($user)
             ->visit('/admin')
             ->click('Photographs')
             ->see($photo->name)
             ->see($gallery->name)
             ->dontSee($gallery2->name)
             ->click('Bulk Edit')
             ->see('Bulk Edit Photographs')
             ->submitForm($newData)
             ->see('Photographs')
             ->see('QPQPQPQP')
             ->see($gallery->name)
             ->see($gallery2->name)
             ->dontSee($photo->name);
    }
}
