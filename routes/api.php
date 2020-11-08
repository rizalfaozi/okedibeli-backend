<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 Route::post('user/login', 'UserController@login');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('homes/lists', 'HomeController@lists');

Route::get('users/lists', 'UserController@lists');
Route::post('users/postuser', 'UserController@postUser');
Route::get('users/edituser/{id}', 'UserController@editUser');
Route::get('users/search', 'UserController@search');
Route::put('users/updateuser/{id}', 'UserController@updateUser');
Route::get('users/deleteuser/{id}', 'UserController@deleteUser');

Route::get('members/lists', 'MemberController@lists');
Route::post('members/post', 'MemberController@post');
Route::get('members/edit/{id}', 'MemberController@edit');
Route::get('members/search', 'MemberController@search');
Route::put('members/update/{id}', 'MemberController@update');
Route::get('members/delete/{id}', 'MemberController@delete');
Route::post('members/active/{id}/{active}', 'MemberController@active');

Route::get('contact/lists', 'ContactController@lists');
Route::post('contact/post', 'ContactController@post');
Route::get('contact/edit/{id}', 'ContactController@edit');
Route::put('contact/update/{id}', 'ContactController@update');
Route::get('contact/search', 'ContactController@search');
Route::get('contact/delete/{id}', 'ContactController@delete');
Route::post('contact/active/{id}/{active}', 'ContactController@active');

Route::get('slide/lists', 'SlideController@lists');
Route::post('slide/postslide', 'SlideController@postSlide');
Route::get('slide/edit/{id}', 'SlideController@editSlide');
Route::put('slide/update/{id}', 'SlideController@updateSlide');
Route::get('slide/search', 'SlideController@searchSlide');
Route::get('slide/delete/{id}', 'SlideController@deleteSlide');

Route::get('fiture/lists', 'FitureController@lists');
Route::post('fiture/store', 'FitureController@store');
Route::get('fiture/edit/{id}', 'FitureController@edit');
Route::put('fiture/update/{id}', 'FitureController@update');
Route::get('fiture/search', 'FitureController@search');
Route::get('fiture/delete/{id}', 'FitureController@delete');

Route::get('themes/lists', 'ThemesController@lists');
Route::post('themes/post', 'ThemesController@post');
Route::get('themes/edit/{id}', 'ThemesController@edit');
Route::put('themes/update/{id}', 'ThemesController@update');
Route::get('themes/search', 'ThemesController@search');
Route::get('themes/delete/{id}', 'ThemesController@delete');
Route::post('themes/active/{id}/{active}', 'ThemesController@active');

Route::get('news/lists', 'NewsController@lists');
Route::post('news/post', 'NewsController@post');
Route::get('news/edit/{id}', 'NewsController@edit');
Route::put('news/update/{id}', 'NewsController@update');
Route::get('news/search', 'NewsController@search');
Route::get('news/delete/{id}', 'NewsController@delete');
Route::post('news/active/{id}/{active}', 'NewsController@active');


Route::get('profile/lists', 'ProfileController@index');
Route::post('profile/store', 'ProfileController@store');
Route::get('profile/edit/{id}', 'ProfileController@edit');
Route::put('profile/update/{id}', 'ProfileController@update');
Route::get('profile/search', 'ProfileController@search');
Route::get('profile/delete/{id}', 'ProfileController@delete');
Route::post('profile/active/{id}/{active}', 'ProfileController@active');


Route::get('messages/lists', 'MessagesController@lists');
Route::post('messages/store', 'MessagesController@store');
Route::get('messages/edit/{id}', 'MessagesController@edit');
Route::put('messages/update/{id}', 'MessagesController@update');
Route::get('messages/search', 'MessagesController@search');
Route::get('messages/delete/{id}', 'MessagesController@delete');
Route::post('messages/active/{id}/{active}', 'MessagesController@active');
Route::get('messages/send/{id}/{kode}', 'MessagesController@send');


Route::get('messages/merge', 'MessagesController@merge');
Route::get('messages/delredis', 'MessagesController@delredis');


// Route::post('members/register', 'MemberController@index');
// Route::post('members/login', 'MemberController@login');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user', 'AuthApiController@getAuthUser');
});