<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('posts.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Posts Routes
Route::group(['middleware' => ['auth:web']], function () {
    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::get('{id}/delete', ['as' => 'destroy', 'uses' => PostController::class.'@destroy']);
        Route::get('create', ['as' => 'create', 'uses' => PostController::class.'@create']);
        Route::post('store', ['as' => 'store', 'uses' => PostController::class.'@store']);
        Route::get('{id}/edit', ['as' => 'edit', 'uses' => PostController::class.'@edit']);
        Route::put('{id}/update', ['as' => 'update', 'uses' => PostController::class.'@update']);
        Route::get('{id}/publish', ['as' => 'publish', 'uses' => PostController::class.'@togglePublish']);
    });
    Route::resource('category', CategoryController::class);
});
Route::resource('posts', PostController::class)->only(['index', 'show']);

