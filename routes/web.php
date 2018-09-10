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

Route::get('/', 'ArticleController@readArticles');
Route::get('/readArticles', 'ArticleController@readArticles');

Route::post('/createArticle', 'ArticleController@createArticle');
Route::get('/createArticle', 'ArticleController@createArticle');
Route::get('/readArticle/{articleId}', 'ArticleController@readArticle');
Route::post('/updateArticle/{articleId}', 'ArticleController@updateArticle');
Route::get('/updateArticle/{articleId}', 'ArticleController@updateArticle');
Route::post('/deleteArticle/{articleId}', 'ArticleController@deleteArticle');
Route::get('/sortArticles/{param}/{dir}', 'ArticleController@sortArticles');


Route::post('/createCategory', 'CategoryController@createCategory');
Route::get('/readCategories', 'CategoryController@readCategories');
Route::post('/updateCategory/{categoryID}', 'CategoryController@updateCategory');
Route::post('/deleteCategory/{categoryID}', 'CategoryController@deleteCategory');
Route::get('/sortCategories/{param}/{dir}', 'CategoryController@sortCategories');

Route::post('/searchArticles', 'SearchController@searchArticles');


