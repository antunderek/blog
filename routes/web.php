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

Route::resource('article', 'ArticleController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/panel', 'PanelController@index')->name('panel.index');

Route::get('/panel/articles', 'PanelController@articles')->name('panel.articles');

Route::get('/panel/roles', 'PanelController@roles')->name('panel.roles');
