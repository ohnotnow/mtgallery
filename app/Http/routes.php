<?php

Route::get('/', function () {
    return view('home');
});

Route::get('/gallery', 'GalleryController@showRecent');
Route::get('/gallery/{slug}', 'GalleryController@showGallery');

Route::get('/blog', 'BlogController@publicIndex');
Route::get('/blog/{slug}', 'BlogController@publicShow');

Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', ['as' => 'admin.dashboard', 'AdminController@dashboard']);

    Route::get('/gallery/add', ['as' => 'admin.add_gallery', 'GalleryController@create']);
    Route::post('/gallery/add', ['as' => 'admin.create_gallery', 'GalleryController@store']);
    Route::get('/gallery/{id}', ['as' => 'admin.show_gallery', 'GalleryController@show']);
    Route::get('/gallery/{id}/edit', ['as' => 'admin.edit_gallery', 'GalleryController@edit']);
    Route::post('/gallery/{id}/edit', ['as' => 'admin.update_gallery', 'GalleryController@update']);
    Route::delete('/gallery/{id}', ['as' => 'admin.delete_gallery', 'GalleryController@destroy']);

    Route::get('/photo', ['as' => 'admin.index_photos', 'PhotoController@index']);
    Route::post('/photo', ['as' => 'admin.create_photo', 'PhotoController@store']);
    Route::delete('/photo/{id}', ['as' => 'admin.delete_photo', 'PhotoController@destroy']);
    Route::get('/photo/{id}/edit', ['as' => 'admin.edit_photo', 'PhotoController@edit']);
    Route::post('/photo/{id}/edit', ['as' => 'admin.update_photo', 'PhotoController@update']);

    Route::get('/blog', ['as' => 'admin.index_blogs', 'BlogController@index']);
    Route::get('/blog/add', ['as' => 'admin.add_blog', 'BlogController@create']);
    Route::post('/blog/add', ['as' => 'admin.create_blog', 'BlogController@store']);
    Route::get('/blog/{id}', ['as' => 'admin.show_blog', 'BlogController@show']);
    Route::post('/blog/{id}/addphoto', ['as' => 'admin.add_photo_to_blog', 'BlogPictureController@store']);
    Route::get('/blog/{id}/deletephoto/{photo_id}', ['as' => 'admin.delete_photo_from_blog', 'BlogPictureController@destroy']);
    Route::get('/blog/{id}/edit', ['as' => 'admin.edit_blog', 'BlogController@edit']);
    Route::post('/blog/{id}/edit', ['as' => 'admin.update_blog', 'BlogController@update']);
    Route::get('/blog/{id}/delete', ['as' => 'admin.delete_blog', 'BlogController@destroy']);
});
