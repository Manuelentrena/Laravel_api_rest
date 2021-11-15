<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\ArticleController;
use App\Http\Controllers\V1\UserController;

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

Route::group(['prefix' => 'v1','middleware' => ['jwt.verify']], function() {
    Route::apiResource('articles', ArticleController::class, ['as' => 'v1'])->except(['index']);
    Route::get('user', [UserController::class, 'getAuthenticatedUser'])->name('v1.getAuthenticatedUser');
});

Route::prefix('v1')->group(function () {
    Route::post('register', [UserController::class, 'register'])->name('v1.register');
    Route::post('login', [UserController::class, 'authenticate'])->name('v1.authenticate');
});

Route::get('v1/articles', [ArticleController::class, 'index'])->name('v1.articles.index');



