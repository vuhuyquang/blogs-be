<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

Route::prefix('user')->group(function () {
  Route::get('', [UserController::class, 'getAll'])->name('user.getAll');
  Route::post('create', [UserController::class, 'store'])->name('user.store');
  Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
  Route::post('delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::prefix('blog')->group(function () {
  Route::get('', [BlogController::class, 'getAll'])->name('user');
  Route::post('create', [BlogController::class, 'store'])->name('user.store');
  Route::post('update/{id}', [BlogController::class, 'update'])->name('user.update');
  Route::post('delete/{id}', [BlogController::class, 'destroy'])->name('user.destroy');
});