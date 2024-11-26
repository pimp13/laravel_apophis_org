<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.home');
})->name('admin.home');

Route::prefix('content')->group(function () {
    Route::resource('category', CategoryController::class)->except('show');
    Route::get('/category/{category}/change-status', [CategoryController::class, 'changeStatus'])->name('category.status');

    Route::resource('article', ArticleController::class)->except('show');
    Route::get('/article/{article}/change-status', [ArticleController::class, 'changeStatus'])->name('article.status');
});
