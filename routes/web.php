<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyQueryController;



Route::get('/', function () {
    return view('welcome');
});

// Group routes for DummyQueryController
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [DummyQueryController::class, 'retrieveData'])->name('retrieve');
    Route::get('/dist', [DummyQueryController::class, 'distinct'])->name('distinct');
    Route::get('/2', [DummyQueryController::class, 'wherePost2'])->name('id2');
    Route::get('/2/des', [DummyQueryController::class, 'id2Des'])->name('id2.des');
    Route::get('/pluck', [DummyQueryController::class, 'pluck'])->name('pluck');
});


// CRUD operations
Route::resource('/crud', CrudController::class);
