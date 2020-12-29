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
// 投稿一覧画面を表示
Route::get('/', 'PostController@showList')->name('posts');

// 新規投稿画面を表示
Route::get('/post/create', 'PostController@showCreate')->name('create');

// 新規投稿
Route::post('/post/store', 'PostController@exeStore')->name('store');

// 投稿詳細画面を表示
Route::get('/post/{id}', 'PostController@showDetail')->name('show');

// 投稿編集画面を表示
Route::get('/post/edit/{id}', 'PostController@showEdit')->name('edit');
// 投稿更新
Route::post('/post/update', 'PostController@exeUpdate')->name('update');
// 投稿削除
Route::post('/post/delete/{id}', 'PostController@exeDelete')->name('delete');

Route::resource('comment', 'CommentsController', ['only' => ['store']]);
