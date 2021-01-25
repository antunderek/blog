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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('article/search', 'ArticleController@searchIndex')->name('article.search');
Route::put('article/deleted/{id}/restore', 'ArticleController@restore')->name('article.restore');
Route::resource('article', 'ArticleController')->except(['index', 'allArticles', 'userArticles']);

Route::resource('role', 'RoleController')->except(['index', 'default']);

Route::put('user/deleted/{id}/restore', 'UserController@restore')->name('user.restore');
Route::resource('user', 'UserController')->except(['index']);

Route::put('comment/{comment}/delete', 'CommentController@delete')->name('comment.delete');
Route::resource('comment', 'CommentController')->except(['index', 'create']);

Route::resource('gallery', 'GalleryController')->except(['index']);

Route::resource('avatar', 'AvatarController')->except(['index']);

Route::resource('menu', 'MenuController')->except(['index']);

Route::get('item/create/{menu}/{parent?}', 'MenuItemController@create')->name('item.create');
Route::resource('item', 'MenuItemController')->except(['index', 'create']);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/panel', 'PanelController@index')->name('panel.index');


Route::get('/panel/articles/user', 'ArticleController@userArticles')->name('panel.articles.user');
Route::get('/panel/articles/user/search', 'ArticleController@searchUserArticles')->name('panel.articles.user.search');
Route::get('/panel/articles/search', 'ArticleController@searchAllArticles')->name('panel.articles.search');
Route::get('/panel/articles/{user?}', 'ArticleController@allArticles')->name('panel.articles');


Route::get('/panel/roles', 'RoleController@index')->name('panel.roles');
Route::get('/panel/roles/search', 'RoleController@searchRoles')->name('panel.roles.search');

Route::get('/panel/users', 'UserController@index')->name('panel.users');
Route::get('/panel/users/search', 'UserController@searchUsers')->name('panel.users.search');

Route::get('/panel/comments/user', 'CommentController@userComments')->name('panel.comments.user');
Route::get('/panel/comments/user/search', 'CommentController@searchUserComments')->name('panel.comments.user.search');
Route::get('/panel/comments/search', 'CommentController@searchComments')->name('panel.comments.search');
Route::get('/panel/comments/{user?}', 'CommentController@index')->name('panel.comments');

Route::get('/panel/gallery', 'GalleryController@index')->name('panel.gallery');
Route::get('/panel/gallery/search', 'GalleryController@searchGallery')->name('panel.gallery.search');

Route::get('/panel/avatar', 'AvatarController@index')->name('panel.avatar');
Route::get('/panel/avatar/search', 'AvatarController@searchAvatar')->name('panel.avatar.search');

Route::get('/panel/menu', 'MenuController@index')->name('panel.menu');
Route::get('/panel/menu/search', 'MenuController@searchMenus')->name('panel.menu.search');

Route::get('/panel/menuitem', 'MenuItemController@index')->name('panel.menuitem');
Route::get('/panel/menuitem/search', 'MenuItemController@searchMenuItems')->name('panel.menuitem.search');

Route::get('/panel/role/default', 'DefaultRoleController@edit')->name('role.default');
Route::put('/panel/role/default', 'DefaultRoleController@update')->name('role.default.update');

Route::get('/{user?}', 'ArticleController@index')->name('article.index');
