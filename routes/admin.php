<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.home');
})->name('admin.home');

Route::prefix('content')->group(function () {
    Route::resource('category', CategoryController::class)->except('show');
});
