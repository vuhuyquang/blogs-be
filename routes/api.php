<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

Route::prefix('user')->group(function () {
  Route::get('', [UserController::class, 'getAll'])->name('user.getAll');
});

Route::prefix('blog')->group(function () {
  Route::get('', [BlogController::class, 'getAll'])->name('role');
});

Route::prefix('permission')->group(function () {
  Route::get('', [PermissionController::class, 'getAll'])->name('permission');
});

Route::prefix('role')->group(function () {
  Route::get('', [RoleController::class, 'getAll'])->name('role');
  Route::post('create', [RoleController::class, 'create'])->name('role.create');
  Route::post('update/{id}', [RoleController::class, 'update'])->name('role.update');
  Route::post('delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
});