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
Route::get('/sortArticles/{param}/{dir}/{searchTerm}', 'ArticleController@sortArticles');


Route::post('/createCategory', 'CategoryController@createCategory');
Route::get('/readCategories', 'CategoryController@readCategories');
Route::post('/updateCategory/{categoryID}', 'CategoryController@updateCategory');
Route::post('/deleteCategory/{categoryID}', 'CategoryController@deleteCategory');
Route::get('/sortCategories/{param}/{dir}', 'CategoryController@sortCategories');


Route::post('/searchArticles', 'SearchController@searchArticles');



Auth::routes();
// Authentication Routes...
/*$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');
*/

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

