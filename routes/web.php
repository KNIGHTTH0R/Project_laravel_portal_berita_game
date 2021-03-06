<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::get('/admin', function () {
    return view('auth.login');
});
/* Route::get('/', function () {
    return view('welcome');
}); */
//Route::get('/guests', 'GuestController@index');
Route::group(['prefix'=>'guest'], function(){

		Route::resource('home','GuestController');
	});



Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'admin','middleware'=>['auth','role:admin']], function(){

		Route::resource('categoris','CategoriController');
		Route::resource('beritas','BeritaController');
		Route::resource('home','AdminController');
	});
