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
Auth::routes();

Route::get('/', function () {
    return view('index');
});

Route::resource('/messages', 'MessageController')->middleware('auth');
Route::get('/user', function () {
    return view('users');
})->name('allUsers')->middleware('auth');
Route::resource('/users', 'UserController')->middleware('auth');
Route::resource('/follow', 'FollowUserController')->middleware('auth');
Route::resource('/remessage', 'MessageRetweetController')->middleware('auth');
Route::resource('/reply', 'MessageReplieController')->middleware('auth');



Route::get('/home', 'HomeController@index')->name('home');
