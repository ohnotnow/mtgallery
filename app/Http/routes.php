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
    Route::get('/', 'AdminController@dashboard');

    Route::get('/gallery/add', 'GalleryController@create');
    Route::post('/gallery/add', 'GalleryController@store');
    Route::get('/gallery/{id}', 'GalleryController@show');
    Route::get('/gallery/{id}/edit', 'GalleryController@edit');
    Route::post('/gallery/{id}/edit', 'GalleryController@update');
    Route::delete('/gallery/{id}', 'GalleryController@destroy');

    Route::get('/photo', 'PhotoController@index');
    Route::post('/photo', 'PhotoController@store');
    Route::delete('/photo/{id}', 'PhotoController@destroy');
    Route::get('/photo/{id}/edit', 'PhotoController@edit');
    Route::post('/photo/{id}/edit', 'PhotoController@update');

    Route::get('/blog', 'BlogController@index');
    Route::get('/blog/add', 'BlogController@create');
    Route::post('/blog/add', 'BlogController@store');
    Route::get('/blog/{id}', 'BlogController@show');
    Route::post('/blog/{id}/addphoto', 'BlogPictureController@store');
    Route::get('/blog/{id}/deletephoto/{photo_id}', 'BlogPictureController@destroy');
    Route::get('/blog/{id}/edit', 'BlogController@edit');
    Route::post('/blog/{id}/edit', 'BlogController@update');
    Route::get('/blog/{id}/delete', 'BlogController@destroy');
});
