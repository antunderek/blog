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

Route::put('article/deleted/{id}/restore', 'ArticleController@restore')->name('article.restore');
Route::resource('article', 'ArticleController')->except(['allArticles', 'userArticles']);

Route::resource('role', 'RoleController')->except(['index', 'default']);

Route::put('user/deleted/{id}/restore', 'UserController@restore')->name('user.restore');
Route::resource('user', 'UserController')->except(['index']);

Route::put('comment/{comment}/delete', 'CommentController@delete')->name('comment.delete');
Route::resource('comment', 'CommentController')->except(['index', 'create']);

Route::resource('gallery', 'GalleryController')->except(['index']);

Route::resource('avatar', 'AvatarController')->except(['index']);

Route::resource('menu', 'MenuController')->except(['index']);

Route::get('item/create/{menu}/{parent?}', 'MenuItemController@create')->name('item.create');
Route::resource('item', 'MenuItemController')->except(['create']);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/panel', 'PanelController@index')->name('panel.index');

Route::get('/panel/articles', 'ArticleController@allArticles')->name('panel.articles');

Route::get('/panel/articles/user', 'ArticleController@userArticles')->name('panel.articles.user');

Route::get('/panel/roles', 'RoleController@index')->name('panel.roles');

Route::get('/panel/users', 'UserController@index')->name('panel.users');

Route::get('/panel/comments', 'CommentController@index')->name('panel.comments');

Route::get('/panel/gallery', 'GalleryController@index')->name('panel.gallery');

Route::get('/panel/avatar', 'AvatarController@index')->name('panel.avatar');

Route::get('/panel/menu', 'MenuController@index')->name('panel.menu');

Route::get('/panel/role/default', 'DefaultRoleController@edit')->name('role.default');

Route::put('/panel/role/default', 'DefaultRoleController@update')->name('role.default.update');
