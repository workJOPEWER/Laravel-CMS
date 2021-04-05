<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\SendEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware( 'auth:api' )->get( '/user', function (Request $request) {
	return $request->user();
} );

Route::group( ['prefix' => 'admin', 'middleware' => 'api'], function () {

	Route::get( 'categories', ['as' => 'api.categories', 'uses' => 'App\Http\Controllers\API\Admin\CategoryController@index'] );
	Route::get( 'categories/{slug}', ['as' => 'api.category', 'uses' => 'App\Http\Controllers\API\Admin\CategoryController@showPosts'] );
	Route::get( 'categories/{slug}/{postId}', ['as' => 'api.categories.category', 'uses' => 'App\Http\Controllers\API\Admin\CategoryController@show'] );

	Route::get( 'about/categories', ['as' => 'api.about.categories', 'uses' => 'App\Http\Controllers\API\Admin\CategoryController@showAboutPage'] );
	Route::get( 'about/categories/{slug}', ['as' => 'api.about.category', 'uses' => 'App\Http\Controllers\API\Admin\CategoryController@showPosts'] );
	Route::get( 'about/categories/{slug}/{postId}', ['as' => 'api.about.categories.category', 'uses' => 'App\Http\Controllers\API\Admin\CategoryController@show'] );

	Route::get( 'info/categories', ['as' => 'api.info.categories', 'uses' => 'App\Http\Controllers\API\Admin\CategoryController@showInfoPage'] );
	Route::get( 'info/categories/{slug}', ['as' => 'api.info.category', 'uses' => 'App\Http\Controllers\API\Admin\CategoryController@showPosts'] );
	Route::get( 'info/categories/{slug}/{postId}', ['as' => 'api.info.categories.category', 'uses' => 'App\Http\Controllers\API\Admin\CategoryController@show'] );

	Route::get( 'news/categories', ['as' => 'api.news.categories', 'uses' => 'App\Http\Controllers\API\Admin\CategoryController@showNewsPage'] );
	Route::get( 'news/categories/{slug}', ['as' => 'api.news.category', 'uses' => 'App\Http\Controllers\API\Admin\CategoryController@showPosts'] );
	Route::get( 'news/categories/{slug}/{postId}', ['as' => 'api.news.categories.category', 'uses' => 'App\Http\Controllers\API\Admin\CategoryController@show'] );

	Route::get( 'galleries', ['as' => 'api.galleries', 'uses' => 'App\Http\Controllers\API\Admin\GalleryController@index'] );
	Route::get( 'galleries/{slug}', ['as' => 'api.gallery', 'uses' => 'App\Http\Controllers\API\Admin\GalleryController@show'] );

	Route::get( 'news', ['as' => 'api.news', 'uses' => 'App\Http\Controllers\API\Admin\NewsController@index'] );
	Route::get( 'news/{slug}', ['as' => 'api.newsItem', 'uses' => 'App\Http\Controllers\API\Admin\NewsController@show'] );

	Route::get( 'articles', ['as' => 'api.articles', 'uses' => 'App\Http\Controllers\API\Admin\ArticleController@index'] );
	Route::get( 'articles/{slug}', ['as' => 'api.article', 'uses' => 'App\Http\Controllers\API\Admin\ArticleController@show'] );

	Route::get( 'information', ['as' => 'api.information', 'uses' => 'App\Http\Controllers\API\Admin\InformationController@index'] );
	Route::get( 'information/{slug}', ['as' => 'api.info', 'uses' => 'App\Http\Controllers\API\Admin\InformationController@show'] );

} );


Route::group(['prefix' => 'mail'], function () {
	Route::post('send-mail', ['as' => 'api.mail', 'uses' => 'App\Http\Controllers\MailController@sendMail']);
});


