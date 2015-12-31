<?php

Route::get('/', function () {
    return view('home');
});

Route::get('/gallery', ['as' => 'gallery.default', 'uses' => 'GalleryController@showRecent']);
Route::get('/gallery/{slug}', ['as' => 'gallery.specific', 'uses' => 'GalleryController@showGallery']);

Route::get('/blog', ['as' => 'blog', 'uses' => 'BlogController@publicIndex']);
Route::get('/blog/feed', ['as' => 'blog.rss', 'uses' =>'BlogController@rssFeed']);
Route::get('/blog/{slug}', ['as' => 'blog.view', 'uses' => 'BlogController@publicShow']);

Route::group(['middleware' => 'web'], function () {
    Route::get('/auth/login', 'Auth\AuthController@getLogin');
    Route::post('/auth/login', 'Auth\AuthController@postLogin');
    Route::get('/auth/logout', 'Auth\AuthController@getLogout');

    Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
        Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'AdminController@dashboard']);

        Route::get('/gallery/add', ['as' => 'admin.add_gallery', 'uses' => 'GalleryController@create']);
        Route::post('/gallery/add', ['as' => 'admin.create_gallery', 'uses' => 'GalleryController@store']);
        Route::get('/gallery/{id}', ['as' => 'admin.show_gallery', 'uses' => 'GalleryController@show']);
        Route::get('/gallery/{id}/edit', ['as' => 'admin.edit_gallery', 'uses' => 'GalleryController@edit']);
        Route::post('/gallery/{id}/edit', ['as' => 'admin.update_gallery', 'uses' => 'GalleryController@update']);
        Route::delete('/gallery/{id}', ['as' => 'admin.delete_gallery', 'uses' => 'GalleryController@destroy']);

        Route::get('/photo', ['as' => 'admin.index_photos','uses' => 'PhotoController@index']);
        Route::post('/photo', ['as' => 'admin.create_photo', 'uses' => 'PhotoController@store']);
        Route::get('/photo/bulkedit', ['as' => 'admin.bulk_edit_photos', 'uses' => 'PhotoController@bulkEdit']);
        Route::post('/photo/bulkedit', ['as' => 'admin.bulk_update_photos', 'uses' => 'PhotoController@bulkUpdate']);
        Route::delete('/photo/{id}', ['as' => 'admin.delete_photo', 'uses' => 'PhotoController@destroy']);
        Route::get('/photo/{id}/edit', ['as' => 'admin.edit_photo', 'uses' => 'PhotoController@edit']);
        Route::post('/photo/{id}/edit', ['as' => 'admin.update_photo', 'uses' => 'PhotoController@update']);

        Route::get('/blog', ['as' => 'admin.index_blogs', 'uses' => 'BlogController@index']);
        Route::get('/blog/add', ['as' => 'admin.add_blog', 'uses' => 'BlogController@create']);
        Route::post('/blog/add', ['as' => 'admin.create_blog', 'uses' => 'BlogController@store']);
        Route::get('/blog/{id}', ['as' => 'admin.show_blog', 'uses' => 'BlogController@show']);
        Route::post('/blog/{id}/addphoto', ['as' => 'admin.add_photo_to_blog', 'uses' => 'BlogPictureController@store']);
        Route::get('/blog/{id}/deletephoto/{photo_id}', ['as' => 'admin.delete_photo_from_blog', 'uses' => 'BlogPictureController@destroy']);
        Route::get('/blog/{id}/edit', ['as' => 'admin.edit_blog', 'uses' => 'BlogController@edit']);
        Route::post('/blog/{id}/edit', ['as' => 'admin.update_blog', 'uses' => 'BlogController@update']);
        Route::get('/blog/{id}/delete', ['as' => 'admin.delete_blog', 'uses' => 'BlogController@destroy']);
    });
});

