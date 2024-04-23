<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TaskMiddleware;

    Route::get('/usersTasks', [TaskController::class, 'userTasks']);
    Route::get('/getAlluserTasks/{id}', [TaskController::class, 'getAlluserTasks']);
    Route::get('/search', [TaskController::class, 'search']);
    Route::get('/myTasks', [TaskController::class, 'myTasks']);



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
    Route::get('users', [UserController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);


});


Route::group([
    'prefix' => 'tasks'

], function ($router) {
    Route::post('/assignUsers', [TaskController::class, 'assignUsers'])->middleware(TaskMiddleware::class);
    Route::post('/updateUserTasks/{id}', [TaskController::class, 'updateUserTasks'])->middleware(TaskMiddleware::class);
    Route::delete('/deleteUserTasks/{id}', [TaskController::class, 'deleteUserTasks'])->middleware(TaskMiddleware::class);
    Route::post('/storeScheduleTasks', [TaskController::class, 'storeScheduleTasks']);
    Route::post('/storeTask', [TaskController::class, 'storeTask']);
    Route::get('/details/{id}', [TaskController::class, 'taskDetails']);



});

Route::group([
    'prefix' => 'comment'

], function ($router) {
    Route::post('/storeComment', [TaskCommentController::class, 'storeComment']);
    Route::post('/editComment/{id}', [TaskCommentController::class, 'editComment']);
    Route::delete('/deleteComment/{id}', [TaskCommentController::class, 'deleteComment']);
});
