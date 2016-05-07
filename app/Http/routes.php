<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
  Route::get('/', 'PagesController@getIndex');
  Route::get('/arquivo', 'PagesController@getArchives');
  Route::get('/perfil/{id}', ['as' => 'profile.show', 'uses' => 'ProfileController@showProfile']);
  Route::get('/pesquisar', 'PagesController@getPesquisar');
  Route::get('{year}/{month}/{slug}', ['as' => 'blog.publicacao', 'uses' => 'BlogController@getPublicacao'])->where('year', '[0-9]+');
  Route::get('arquivo/{year}/{month}', ['as' => 'blog.arquivo', 'uses' => 'BlogController@getArchive']);
  Route::get('tags/{tag}', ['as' => 'blog.tags', 'uses' => 'BlogController@getTag']);
  Route::resource('posts', 'PostController');
  Route::resource('comments', 'CommentsController');
  Route::get('results', ['as' => 'search.results', 'uses' => 'QueryController@getResults']);
  Route::auth();
  Route::get('register', ['middleware' => 'regOnOff', 'uses' => 'Auth\AuthController@showRegistrationForm']);
});
