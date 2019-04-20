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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('pelajaran')->group(function () {
    Route::get('create', 'SubjectController@showCreate')->name('show_create_subject');
    Route::post('create', 'SubjectController@create')->name('create_subject');

    Route::get('edit/{id}', 'SubjectController@showEdit')->name('show_edit_subject');
    Route::post('edit', 'SubjectController@edit')->name('edit_subject');

    Route::post('delete', 'SubjectController@delete')->name('delete_subject');

    Route::get('details/{id}', 'SubjectController@details')->name('details_subject');

    Route::post('follow', 'SubjectController@follow')->name('follow_subject');
    Route::post('unfollow', 'SubjectController@unfollow')->name('unfollow_subject');

    Route::post('create/comment', 'SubjectController@createComment')->name('create_comment_subject');
});
