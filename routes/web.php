<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->group(function () {
        require __DIR__ . '/admin.php';
    });

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
