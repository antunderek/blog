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

Route::resource('article', 'ArticleController');

Route::resource('role', 'RoleController')->except(['index', 'default']);

Route::resource('user', 'UserController')->except(['index']);

Route::resource('comment', 'CommentController')->except(['index']);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/panel', 'PanelController@index')->name('panel.index');

Route::get('/panel/articles', 'PanelController@articles')->name('panel.articles');

Route::get('/panel/roles', 'RoleController@index')->name('panel.roles');

Route::get('/panel/users', 'UserController@index')->name('panel.users');

Route::get('/panel/comments', 'CommentController@index')->name('panel.comments');

Route::get('/panel/role/default', 'DefaultRoleController@edit')->name('role.default');

Route::put('/panel/role/default', 'DefaultRoleController@update')->name('role.default.update');
