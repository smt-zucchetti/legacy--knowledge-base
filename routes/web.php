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

Route::get('/', 'ArticleController@homePage');
Route::get('/articleList', 'ArticleController@articleList');
Route::get('/articleGUI', 'ArticleController@readArticleGUI');
Route::get('/articleGUI/{articleId}', 'ArticleController@readArticleGUI');
Route::get('/articleTree', 'ArticleController@readArticleTree');

Route::post('/createArticle', 'ArticleController@createArticle');
Route::get('/createArticle', 'ArticleController@createArticle');
Route::get('/readArticle/{articleId}', 'ArticleController@readArticle');
Route::post('/updateArticle/{articleId}', 'ArticleController@updateArticle');
Route::get('/updateArticle/{articleId}', 'ArticleController@updateArticle');

Route::post('/deleteArticle/{articleId}', 'ArticleController@deleteArticle');
Route::get('fullPageArticle/{articleId}', 'ArticleController@fullPageArticle');

Route::get('/readFolders', 'FolderController@readFolders');
Route::post('/createFolder', 'FolderController@createFolder');
Route::post('/deleteFolder/{folderID}', 'FolderController@deleteFolder');
Route::post('/updateFolder/{folderID}', 'FolderController@updateFolder');

Route::post('/createCategory', 'CategoryController@createCategory');
Route::get('/readCategories', 'CategoryController@readCategories');
Route::post('/updateCategory/{categoryID}', 'CategoryController@updateCategory');
Route::post('/deleteCategory/{categoryID}', 'CategoryController@deleteCategory');



Route::get('/searchArticles', 'ArticleController@searchArticles');

Route::get('/search', 'SearchController@search');
Route::post('/search', 'SearchController@search');



Route::get('/sortArticles/{param}/{dir}', 'ArticleController@sortArticles');
Route::get('/sortArticles/{param}/{dir}/{searchTerm}', 'ArticleController@sortArticles');
Route::get('/sortCategories/{param}/{dir}', 'CategoryController@readCategories');
Route::get('/sortFolders/{param}/{dir}', 'FolderController@readFolders');

Route::get('/uploadGDocZip', 'ArticleController@uploadGDocZip');
Route::post('/uploadGDocZip', 'ArticleController@uploadGDocZip');


Auth::routes();
/*
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
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

Route::get('/authLandingPage', 'HomeController@index')->name('home');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


