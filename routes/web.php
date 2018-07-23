<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'FrontEndController@home')->name('home');
Route::get('/mission', 'MissionController@home');
Route::get('/how', 'HowController@home');
Route::get('/what', 'WhatController@home');
Route::get('/test_rating',function (){
    return view('test_rating');
});
Route::get('/test_rat',function (){
    return view('test_rat');
});

Route::get('/event',function (){
    return view('event');
});
Route::get('/newcaro',function (){
    return view('newcaro');
});

Route::get('/yic',function (){
    return view('yic');
});
Route::get('/hp',function (){
    return view('hp');
});
Route::get('/new',function (){
    return view('new');
});
Route::get('/events1',function () {
    return view('events1'); 
});
Route::get('/eventsdate',function () {
    return view('eventsdate');

});Route::get('/news2',function (){
    return view('news2');
});Route::get('/news4',function (){
    return view('news4');
});
Route::get('/naya',function (){
    return view('naya');
});
Route::get('/test',function (){
    return view('test');
});
Route::get('/rating',function (){
    return view('rating');
});
Route::get('/ratingg',function (){
    return view('ratingg');
});
Route::get('/cih',function (){
    return view('cih');
});
Route::get('/youth',function (){    
    return view('partials.youth');
});


Route::get('/news',function (){
    return view('partials.news');
});

Route::get('news3', 'FrontEndController@news3');
Route::get('yic', 'FrontEndController@yic');

Auth::routes();

Route::get('{project}/show', 'ProjectController@show')->name('project.show');



Route::get('/home', 'HomeController@index')->name('home');
Route::group([ 'prefix' => 'backend', 'middleware' => 'auth' ], function () {
    /*
      |--------------------------------------------------------------------------
      | Settings Routes
      |--------------------------------------------------------------------------
      */
    Route::group([ 'as' => 'setting.', 'prefix' => 'setting' ], function () {
        Route::get('', 'SettingController@index')->name('index');
        Route::put('update', 'SettingController@update')->name('update');
    });

    /*
        |--------------------------------------------------------------------------
        | User CRUD Routes
        |--------------------------------------------------------------------------
        */

    Route::group([ 'prefix' => 'user', 'as' => 'user.' ], function () {
        Route::get('', 'UserController@index')->name('index');
        Route::get('create', 'UserController@create')->name('create');
        Route::post('', 'UserController@store')->name('store');
        Route::get('{user}', 'UserController@show')->name('show');
        Route::get('{user}/edit', 'UserController@edit')->name('edit');
        Route::put('{user}', 'UserController@update')->name('update');
        Route::delete('{user}', 'UserController@destroy')->name('destroy');

    });

    /*
        |--------------------------------------------------------------------------
        | Post CRUD Routes
        |--------------------------------------------------------------------------
        */

    Route::group([ 'as' => 'post.', 'prefix' => 'post' ], function () {
        Route::get('', 'PostController@index')->name('index');
        Route::get('create', 'PostController@create')->name('create');
        Route::post('store', 'PostController@store')->name('store');
        Route::get('{post}/edit', 'PostController@edit')->name('edit');
        Route::put('{post}', 'PostController@update')->name('update');
        Route::delete('{post}', 'PostController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Project CRUD Routes
    |--------------------------------------------------------------------------
    */

    Route::group([ 'as' => 'project.', 'prefix' => 'project' ], function () {
        Route::get('', 'ProjectController@index')->name('index');
        Route::get('create', 'ProjectController@create')->name('create');
        Route::post('', 'ProjectController@store')->name('store');
        Route::get('{project}/edit', 'ProjectController@edit')->name('edit');
        Route::put('{project}', 'ProjectController@update')->name('update');
        Route::delete('{project}', 'ProjectController@destroy')->name('destroy');

    });
    Route::group([ 'as' => 'news.', 'prefix' => 'news' ], function () {
        Route::get('{news}/show', 'ProjectController@show')->name('show');
    });

    Route::get('news2/{news}','FrontEndController@news2')->name('news2');


    Route::group([ 'as' => 'event.', 'prefix' => 'event' ], function () {
        Route::get('', 'EventController@index')->name('index');
        Route::get('create', 'EventController@create')->name('create');
        Route::post('', 'EventController@store')->name('store');
        Route::get('{event}/edit', 'EventController@edit')->name('edit');
        Route::put('{event}', 'EventController@update')->name('update');
        Route::delete('{event}', 'EventController@destroy')->name('destroy');
    });

    Route::group([ 'as' => 'gallery.', 'prefix' => 'gallery' ], function () {
        Route::get('', 'GalleryController@index')->name('index');
        Route::get('create', 'GalleryController@create')->name('create');
        Route::post('', 'GalleryController@store')->name('store');
        Route::get('{gallery}/edit', 'GalleryController@edit')->name('edit');
        Route::put('{gallery}', 'GalleryController@update')->name('update');
        Route::delete('{gallery}', 'GalleryController@destroy')->name('destroy');
    });
    Route::group([ 'as' => 'mission.', 'prefix' => 'mission' ], function () {
        Route::get('', 'MissionController@index')->name('index');
        Route::get('create', 'MissionController@create')->name('create');
        Route::post('', 'MissionController@store')->name('store');
        Route::get('{mission}/edit', 'MissionController@edit')->name('edit');
        Route::put('{mission}', 'MissionController@update')->name('update');
        Route::delete('{mission}', 'MissionController@destroy')->name('destroy');
        Route::get('{mission}/show','MissionController@show')->name('show');

    });

        Route::group([ 'as' => 'how.', 'prefix' => 'how' ], function () {
        Route::get('', 'HowController@index')->name('index');
        Route::get('create', 'HowController@create')->name('create');
        Route::post('', 'HowController@store')->name('store');
        Route::get('{how}/edit', 'HowController@edit')->name('edit');
        Route::put('{how}', 'HowController@update')->name('update');
        Route::delete('{how}', 'HowController@destroy')->name('destroy');
        Route::get('{how}/show','HowController@show')->name('show');

    });
         Route::group([ 'as' => 'what.', 'prefix' => 'what' ], function () {
        Route::get('', 'WhatController@index')->name('index');
        Route::get('create', 'WhatController@create')->name('create');
        Route::post('', 'WhatController@store')->name('store');
        Route::get('{what}/edit', 'WhatController@edit')->name('edit');
        Route::put('{what}', 'WhatController@update')->name('update');
        Route::delete('{what}', 'WhatController@destroy')->name('destroy');
        Route::get('{what}/show','WhatController@show')->name('show');

    });

    Route::group([ 'as' => 'mainproject.', 'prefix' => 'mainproject' ], function () {
        Route::get('', 'MainProjectController@index')->name('index');
        Route::get('create', 'MainProjectController@create')->name('create');
        Route::post('', 'MainProjectController@store')->name('store');
        Route::get('{mainproject}/edit', 'MainProjectController@edit')->name('edit');
        Route::put('{mainproject}', 'MainProjectController@update')->name('update');
        Route::delete('{mainproject}', 'MainProjectController@destroy')->name('destroy');
        Route::get('{mainproject}/show','MainProjectController@show')->name('show');

    });

});

//rating lai
//
//Route::post('/ratinggg',function (){
//    dd(1);
//});

Route::post('/ratinggg', 'RatingController@store')->name('ratinggg');
//Route::post('/rate', 'RatingController@store')->name('ratingyouth');
//Route::post('/rate', 'RatingController@store')->name('ratingyouth');


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');



