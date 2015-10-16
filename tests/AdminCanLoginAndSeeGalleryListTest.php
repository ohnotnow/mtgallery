<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminCanLoginAndSeeGalleryListTest extends TestCase
{
    use DatabaseTransactions;
    
    protected $testPassword = 'hello';

    public function testLogin()
    {
        $user = factory(App\User::class)->make();
        $user->password = Hash::make($this->testPassword);
        $user->save();
        $gallery = factory(App\Gallery::class)->make();
        $gallery->save();
        $this->visit('/admin')
             ->see('Login')
             ->type($user->email, 'email')
             ->type($this->testPassword, 'password')
             ->press('Login')
             ->see('Current Galleries')
             ->see($gallery->name);
    }
}
