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
Route::get('/', function () {
    return redirect('login');
});

// Route::get('/', 'HomeController@index');
//Route::get('/auth', 'Auth\AuthController@index');
Route::post('register/akun', 'Auth\RegisterController@create');


Route::get('/verifikasi', 'Auth\AuthController@verifikasi');
Route::get('/active', 'Auth\AuthController@active');
Route::get('/forgot', 'Auth\AuthController@forgot');

Route::post('/forgotSend', 'Auth\AuthController@forgotSend');


Route::get('/lupa', 'Auth\AuthController@lupa');
Route::post('/lupakirim','Auth\AuthController@lupakirim');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );



Route::group(['middleware' => ['web']], function () {
   
	Auth::routes();
    Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
	Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

	Route::get('/home', 'HomeController@index');

	Route::resource('themes', 'ThemesController');
	Route::resource('news', 'NewsController');
	Route::resource('fiture', 'FitureController');
	Route::resource('profile', 'ProfileController');
	Route::resource('contact', 'ContactController');
	Route::resource('users', 'UserController');

	Route::resource('members', 'MemberController');
	Route::resource('comments', 'CommentController');
	Route::get('/comment/publish/{id}','CommentController@publish');
	Route::get('/comment/unpublish/{id}','CommentController@unpublish');
	Route::resource('messages', 'MessagesController');

	Route::resource('slide', 'SlideController');
	
    
   
});

	

// Auth::routes();


























