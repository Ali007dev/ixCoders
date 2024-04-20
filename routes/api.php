<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
    Route::get('users', [UserController::class, 'index']);


});


Route::group([
    'prefix' => 'task'
], function ($router) {


});
Route::post('/storeTask', [TaskController::class, 'storeTask']);
    Route::post('/assignUsers', [TaskController::class, 'assignUsers']);

    Route::post('/updateUserTasks/{id}', [TaskController::class, 'updateUserTasks']);

    Route::delete('/deleteUserTasks/{id}', [TaskController::class, 'deleteUserTasks']);
