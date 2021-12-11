<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\ArticleController;
use App\Http\Controllers\V1\UserController;
use App\Http\Controllers\V1\CommentController;



// Private Routes
Route::group(['prefix' => 'v1','middleware' => ['jwt.verify']], function() {
  // User
  Route::get('user', [UserController::class, 'getAuthenticatedUser'])->name('v1.getAuthenticatedUser');
  Route::get('user_email/{article}', [ArticleController::class, 'getUserEmail'])->name('v1.getUserEmail');
  // Article
  Route::apiResource('articles', ArticleController::class, ['as' => 'v1'])->except(['index']);
  Route::get('articles/{article}/image', [ArticleController::class, 'image'])->name('v1.article.image');
  // Comments
  Route::get('articles/{article}/comments', [CommentController::class, 'index'])->name('v1.comments.index');
  Route::get('articles/{article}/comments/{id}', [CommentController::class, 'show'])->name('v1.comments.show');
  Route::post('articles/{article}/comments', [CommentController::class, 'store'])->name('v1.comments.store');
  Route::put('articles/{article}/comments/{comment}', [CommentController::class, 'update'])->name('v1.comments.update');
  Route::delete('articles/{article}/comments/{comment}', [CommentController::class, 'delete'])->name('v1.comments.delete');
});


// Public Routes
Route::prefix('v1')->group(function () {
    // User
    Route::post('register', [UserController::class, 'register'])->name('v1.register');
    Route::post('login', [UserController::class, 'authenticate'])->name('v1.authenticate');
    // Article
    Route::get('articles', [ArticleController::class, 'index'])->name('v1.articles.index');
});





