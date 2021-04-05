<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use \App\Http\Controllers\Admin\ArticleController;
use \App\Http\Controllers\Admin\NewsController;
use \App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\GalleryController;

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


Auth::routes();

Route::get( '/', [App\Http\Controllers\Admin\HomeController::class, 'index'] )->name( 'home' );

//Admin
Route::group( ['prefix' => 'admin', 'middleware' => 'auth'], function () {

	Route::resource( 'categories', CategoryController::class );
	Route::resource( 'articles', ArticleController::class );
	Route::resource( 'news', NewsController::class );
	Route::resource( 'information', InformationController::class );
	Route::resource( 'galleries', GalleryController::class );
} );


